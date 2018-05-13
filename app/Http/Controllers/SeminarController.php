<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeminarRequest;
use App\Mail\CreateSeminarMail;
use App\Models\Participant;
use App\Models\Seminar;
use App\Models\User;
use App\Repositories\Contracts\ParticipantRepositoryInterface;
use App\Repositories\Contracts\SeminarRepositoryInterface;
use App\Repositories\Contracts\MessageRepositoryInterface;
use App\Repositories\Contracts\ReportRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Lang;
use Auth;
use PDF;

class SeminarController extends Controller
{

    protected $seminarRepository, $participantRepository, $messageRepository, $reportRepository;


    public function __construct(ParticipantRepositoryInterface $participantRepository,
        SeminarRepositoryInterface $seminarRepository,
        MessageRepositoryInterface $messageRepository,
        ReportRepositoryInterface $reportRepository)
    {
        $this->middleware('auth');
        $this->participantRepository = $participantRepository;
        $this->seminarRepository = $seminarRepository;
        $this->messageRepository = $messageRepository;
        $this->reportRepository = $reportRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listActive = Seminar::listActive()->take(5)->get();
        $listEarly  = Seminar::listEarly()->take(5)->get();
        $listFinished = Seminar::listFinished()->take(5)->get();
        $countActive = Seminar::listActive()->count();
        $countEarly = Seminar::listEarly()->count();
        $countFinished = Seminar::listFinished()->count();

        $selectChairman = User::orderUser()->pluck('name', 'id');

        return view('seminar.index', compact(
            'listActive',
            'listEarly',
            'listFinished',
            'countActive',
            'countEarly',
            'countFinished',
            'selectChairman'
        ));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeminarRequest $request)
    {
        $start = $this->createDate($request->time, 0, 19); 
        $end = $this->createDate($request->time, 21, 30);
        $code = str_random(10);

        $data = $request->only('name', 'chairman', 'description');
        $data['start'] = $start;
        $data['end'] = $end;
        $data['code'] = $code;

        $seminar = $this->seminarRepository->store($data);

        foreach ($request->members as $member) {
            $dataMember['seminar_id'] = $seminar->id;
            $dataMember['user_id'] = $member;

            $this->participantRepository->store($dataMember);

            $email = User::find($dataMember['user_id'])->email;
            Mail::to($email)->send(new CreateSeminarMail($dataMember['seminar_id'], $dataMember['user_id']));
        }

        return response()->json([
            'status' => 1,
            'msg' => Lang::get('custom.add_seminar_success'),
            'id' => $seminar->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checkValidation = $this->participantRepository->checkValidation($id, Auth::id());
        $seminars = $this->seminarRepository->getAllWithUser();
        $seminarUser = $this->seminarRepository->getSeminarWithUser($id)->get(); 
        $messages = $this->seminarRepository->getMessages($id);
        $members = $this->seminarRepository->getAllMembers($id)->get();
        $checkPublished = $this->reportRepository->checkPublished($id);

        return view('seminar.show', compact(
            'id',
            'checkValidation',
            'seminars',
            'seminarUser',
            'messages',
            'members',
            'checkPublished'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getEditor($id)
    {
        $report = '';
        $messages = '';
        if (!$this->reportRepository->checkReported($id)) {
            $messages = $this->messageRepository->getAllMessages($id);
        } else {
            $report = $this->reportRepository->checkReported($id)->report;
        }
        $seminar = $this->seminarRepository->find($id);

        return view('seminar.editor', compact('id', 'messages', 'seminar', 'report'));
    }

    public function postEditor(Request $request, $id)
    {
        $data = $request->only('seminarId', 'report');
        $data['userId'] = Auth::id();
        $data['filename'] = time() . '-' . str_slug($this->seminarRepository->find($request->seminarId)->name, '-') . '.pdf';
        if (!$this->reportRepository->checkReported($id)) {
            $this->reportRepository->store($data);
        } else {
            $this->reportRepository->updateReport($id, $data);
        }

        return response()->json([
            'status' => 1,
            'msgTitle' => Lang::get('custom.success'),
            'msgContent' => Lang::get('custom.report_success'),
        ]);
    }

    public function getReport($id)
    {
        $report = $this->seminarRepository->getReportOfSemianr($id)->get();

        return view('seminar.report', compact('report'));
    }

    public function previewReport($id)
    {
        $pdf = PDF::loadHTML($this->reportRepository->checkReported($id)->report);

        return $pdf->stream();
    }

    public function postReport($id)
    {
        $this->reportRepository->publishReport($id);

        return response()->json([
            'status' => 1,
            'msgTitle' => Lang::get('custom.success'),
            'msgContent' => Lang::get('custom.publish_success'),
        ]);
    }

    public function downloadReport($id)
    {
        $report = $this->reportRepository->checkReported($id);
        $pdf = PDF::loadHTML($report->report);

        return $pdf->download($report->filename);
    }

    public function validateCode(Request $request, $id)
    {
        $checkParticipant = $this->participantRepository->checkParticipant($request->seminarId, Auth::id());
        if ($checkParticipant) {
            $checkCode = $this->seminarRepository->checkCode($request->seminarId, $request->inputCode);
            if ($checkCode) {
                $this->participantRepository->updateValidation($request->seminarId, Auth::id());

                return response()->json([
                    'status' => 1,
                    'msgTitle' => Lang::get('custom.success'),
                    'msgContent' => Lang::get('custom.validate_success'),
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'msgTitle' => Lang::get('custom.error'),
                    'msgContent' => Lang::get('custom.validate_error'),
                ]);
            }
        }
    }

    public function createDate($string, $start, $end)
    {
        $sub = substr((string) $string, $start, $end);
        $date = date('Y-m-d H:i:s', strtotime($sub));

        return $date;
    }
}

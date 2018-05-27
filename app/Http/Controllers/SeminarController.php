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
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Lang;
use Auth;
use PDF;

class SeminarController extends Controller
{

    protected $seminarRepository,
        $participantRepository,
        $messageRepository,
        $reportRepository,
        $userRepository,
        $notificationRepository;


    public function __construct(
        ParticipantRepositoryInterface $participantRepository,
        SeminarRepositoryInterface $seminarRepository,
        MessageRepositoryInterface $messageRepository,
        ReportRepositoryInterface $reportRepository,
        UserRepositoryInterface $userRepository,
        NotificationRepositoryInterface $notificationRepository)
    {
        $this->middleware('auth');
        $this->participantRepository = $participantRepository;
        $this->seminarRepository = $seminarRepository;
        $this->messageRepository = $messageRepository;
        $this->reportRepository = $reportRepository;
        $this->userRepository = $userRepository;
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listActive = $this->seminarRepository->listActive();
        $listEarly  = $this->seminarRepository->listEarly();
        $listFinished = $this->seminarRepository->listFinished();
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectChairman = User::orderUser()->pluck('name', 'id');

        return view('seminar.create', compact('selectChairman'));
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

            $dataNotification['user_send_id'] = $request->chairman;
            $dataNotification['user_receive_id'] = $member;
            $dataNotification['target_id'] = $member;
            $dataNotification['notification_type'] = config('custom.seminar');
            $dataNotification['notification_id'] = $seminar->id;
            $this->notificationRepository->store($dataNotification);
        }

        return redirect()->route('seminar.index')
            ->with('msg', Lang::get('custom.add_seminar_success'));
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
        $seminarUser = $this->seminarRepository->getSeminarWithUser($id);
        $messages = $this->seminarRepository->getMessages($id);
        $members = $this->seminarRepository->getAllMembers($id);
        $checkPublished = $this->reportRepository->checkPublished($id, config('custom.seminar'));
        $users = $this->userRepository->getNameAndId();

        return view('seminar.show', compact(
            'id',
            'checkValidation',
            'seminars',
            'seminarUser',
            'messages',
            'members',
            'checkPublished',
            'users'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seminar = $this->seminarRepository->find($id);
        $users = $this->userRepository->getNameAndId();
        $participants = $this->participantRepository->getMembersId($id);

        return view('seminar.edit', compact('seminar', 'users', 'participants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeminarRequest $request, $id)
    {
        $start = $this->createDate($request->time, 0, 19); 
        $end = $this->createDate($request->time, 21, 30);
        $data = $request->only('name', 'chairman', 'description');
        $data['id'] = $id;
        $data['start'] = $start;
        $data['end'] = $end;

        $this->seminarRepository->update($data);

        $currentParticipants = $this->participantRepository->getMembersId($id);
        $editParticipants = $request->members;

        foreach ($editParticipants as $value) {
            if (!in_array($value, $currentParticipants->toArray())) {
                $dataMember['seminar_id'] = $id;
                $dataMember['user_id'] = $value;

                $this->participantRepository->store($dataMember);
                $email = User::find($value)->email;
                Mail::to($email)->send(new CreateSeminarMail($id, $value));
            }
        }

        foreach ($currentParticipants as $value) {
            if (!in_array($value, $editParticipants)) {
                $this->participantRepository->deleteOneParticipant($id, $value);
            }
        }

        return redirect()->route('seminar.show', $id);
    }

    public function getEditor($id)
    {
        $report = '';
        $messages = '';
        $checkReported = $this->reportRepository->checkReported($id, config('custom.seminar'));
        if (!$checkReported) {
            $messages = $this->messageRepository->getAllMessages($id);
        } else {
            $report = $checkReported->report;
        }
        $seminar = $this->seminarRepository->getSeminarWithUser($id);
        $participants = $this->seminarRepository->getAllMembers($id);

        return view('seminar.editor', compact('id', 'messages', 'seminar', 'report', 'participants', 'checkReported'));
    }

    public function postEditor(Request $request, $id)
    {
        $data = $request->only('report');
        $data['reportId'] = $request->seminarId;
        $data['reportType'] = config('custom.seminar');
        $data['userId'] = Auth::id();
        $data['status'] = 0;
        $data['filename'] = time() . '-' . str_slug($this->seminarRepository->find($request->seminarId)->name, '-') . '.pdf';
        if (!$this->reportRepository->checkReported($id, $data['reportType'])) {
            $this->reportRepository->store($data);
        } else {
            $this->reportRepository->updateReport($id, $data['reportType'], $data);
        }

        return response()->json([
            'status' => 1,
            'msgTitle' => Lang::get('custom.success'),
            'msgContent' => Lang::get('custom.report_success'),
        ]);
    }

    public function getReport($id)
    {
        $report = $this->seminarRepository->getReportOfSeminar($id);
        $seminar = $this->seminarRepository->find($id);

        return view('seminar.report', compact('report', 'seminar'));
    }

    public function previewReport($id)
    {
        $pdf = PDF::loadHTML($this->reportRepository->checkReported($id, config('custom.seminar'))->report);

        return $pdf->stream();
    }

    public function postReport($id)
    {
        $this->reportRepository->publishReport($id, config('custom.seminar'));

        return response()->json([
            'status' => 1,
            'msgTitle' => Lang::get('custom.success'),
            'msgContent' => Lang::get('custom.publish_success'),
        ]);
    }

    public function downloadReport($id)
    {
        $report = $this->reportRepository->checkReported($id, $data['reportType']);
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

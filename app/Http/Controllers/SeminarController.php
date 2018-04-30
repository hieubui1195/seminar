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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Lang;

class SeminarController extends Controller
{

    protected $seminarRepository, $participantRepository;


    public function __construct(ParticipantRepositoryInterface $participantRepository,
        SeminarRepositoryInterface $seminarRepository)
    {
        $this->middleware('auth');
        $this->participantRepository = $participantRepository;
        $this->seminarRepository = $seminarRepository;
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
        $seminars = $this->seminarRepository->getAllWithUser();
        $seminarUser = $this->seminarRepository->getSeminarWithUser($id)->get(); 
        $messages = $this->seminarRepository->getMessages($id);

        return view('seminar.show', compact(
            'id',
            'seminars',
            'seminarUser',
            'messages'
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

    public function createDate($string, $start, $end)
    {
        $sub = substr((string) $string, $start, $end);
        $date = date('Y-m-d H:i:s', strtotime($sub));

        return $date;
    }
}

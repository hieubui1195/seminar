<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeminarRequest;
use App\Lang;
use App\Models\Participant;
use App\Models\Seminar;
use App\Models\User;
use App\Repositories\Contracts\ParticipantRepositoryInterface;
use App\Repositories\Contracts\SeminarRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateSeminarMail;

class SeminarController extends Controller
{

    protected $seminarRepository;


    public function __construct(SeminarRepositoryInterface $seminarRepository)
    {
        $this->seminarRepository = $seminarRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selectChairman = User::orderUser()->pluck('name', 'id');

        return view('seminar.index', compact('selectChairman'));
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

            Participant::create($dataMember);

            $email = User::find($dataMember['user_id'])->email;

            Mail::to($email)->send(new CreateSeminarMail($dataMember['seminar_id'], $dataMember['user_id']));
        }

        return response()->json([
            'status' => 1,
            'msg' => Lang::get('custom.add_seminar_success'),
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
        //
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

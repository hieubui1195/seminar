<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Events\NotifyCallEvent;
use Lang;
use Auth;

class UserController extends Controller
{
    
    protected $userRepository, $notificationRepository;

    public function __construct(UserRepositoryInterface $userRepository,
        NotificationRepositoryInterface $notificationRepository)
    {
        $this->middleware('auth');
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

        $users = $this->userRepository->all();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->only('email', 'name', 'level');
        $this->userRepository->store($data);

        return response()->json([
            'status' => 1,
            'msg' => Lang::get('custom.add_user_success'),
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
        $user = $this->userRepository->find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(UserRequest $request, $id)
    {
        $data = $request->only('id', 'name', 'password', 'phone');
        $this->userRepository->update($data);

        return response()->json([
            'status' => 1,
            'msg' => Lang::get('custom.update_profile_success'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->userRepository->delete($request->id);

        return response()->json([
            'status' => 1,
            'msg' => Lang::get('custom.delete_user_success'),
        ]);
    }

    public function callVideo($id)
    {
        $caller = Auth::user();
        $receiver = $this->userRepository->find($id);

        return view('user.video', compact('caller', 'receiver'));
    }

    public function notifyCall(Request $request)
    {
        $callerId = $request->callerId;
        $receiverId = $request->receiverId;
        $caller = $this->userRepository->find($callerId);
        event(new NotifyCallEvent($caller, $receiverId));

        $data['user_send_id'] = $callerId;
        $data['user_receive_id'] = $receiverId;
        $data['target_id'] = $receiverId;
        $data['type'] = 'call';
        $this->notificationRepository->store($data);

        return response()->json($request->all());
    }
}

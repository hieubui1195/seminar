<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Repositories\Contracts\CallRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Events\NotifyCallEvent;
use App\Models\Call;
use App\Models\Notification;
use Carbon\Carbon;
use Lang;
use Auth;

class UserController extends Controller
{
    
    protected $userRepository, $notificationRepository, $callRepository;

    public function __construct(UserRepositoryInterface $userRepository,
        NotificationRepositoryInterface $notificationRepository,
        CallRepositoryInterface $callRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->notificationRepository = $notificationRepository;
        $this->callRepository = $callRepository;
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
        return view('user.create');
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

        return redirect()->route('user.index')->with('msg', Lang::get('custom.add_user_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = $this->userRepository->find($id);

        if ($request->ajax()) {
            return response()->json($this->userRepository->find($id));
        }

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
        $user = $this->userRepository->find($id);

        return view('user.edit', compact('user'));
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
        $data = $request->only('name', 'password', 'phone', 'avatar');
        $data['id'] = $id;
        $this->userRepository->update($data);

        return redirect()->route('user.show', $id)
            ->with('msg', Lang::get('custom.update_profile_success'));
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
        $caller = $this->userRepository->find($request->callerId);

        $dataCall['callerId'] = $request->callerId;
        $dataCall['receiverId'] = $request->receiverId;
        $call = Call::create([
            'caller' => $request->callerId,
            'receiver' => $request->receiverId,
            'status' => 0,
            'start' => Carbon::now(),
        ]);

        event(new NotifyCallEvent($caller, $request->receiverId));

        $data['user_send_id'] = $request->callerId;
        $data['user_receive_id'] = $request->receiverId;
        $data['target_id'] = $request->receiverId;
        $data['notification_type'] = 'call';
        $data['notification_id'] = $call->id;
        $this->notificationRepository->store($data);

        return response()->json($request->all());
    }

    public function getNotifications()
    {
        $notifications = $this->notificationRepository->getNotifications(Auth::id());

        return view('user.notifications', compact('notifications'));
    }

    public function changeViewed(Request $request)
    {
        $this->notificationRepository->changeViewed($request->id);

        return response()->json($request->all());
    }

    public function markedAll(Request $request)
    {
        $this->notificationRepository->markedAll();
        $notifications = $this->notificationRepository->getNotifications(Auth::id());

        return view('partials.notifications', compact('notifications'));
    }

    public function changeRole($id, Request $request)
    {
        $this->userRepository->changeRole($id, $request->role);

        return response()->json($request->all());
    }
}

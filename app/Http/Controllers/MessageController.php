<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\MessageRepositoryInterface;
use App\Events\MessageSentEvent;
use Auth;

class MessageController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->middleware('auth');
        $this->messageRepository = $messageRepository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = [
            'user_id' => Auth::id(),
            'seminar_id' => $request->seminarId,
            'message' => $request->message,
        ];

        $message = $this->messageRepository->store($data);
        event(new MessageSentEvent($user, $message, $request->seminarId));
        
        return response()->json([
            'status' => 1,
            'id' => $message->id,
        ]);
    }

    public function show(Request $request)
    {
        return response()->json([
            $this->messageRepository
                ->getMessageWithUser($request->messageId)
                ->get()
        ]);
    }
}

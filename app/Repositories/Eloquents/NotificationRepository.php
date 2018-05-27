<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Notification;
use Auth;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{

    protected $model;
  
    public function __construct(Notification $notification)
    {
        $this->model = $notification;
    }

    public function store(array $data)
    {
        $this->model->create([
            'user_send_id' => $data['user_send_id'],
            'user_receive_id' => $data['user_receive_id'],
            'target_id' => $data['target_id'],
            'notification_type' => $data['notification_type'],
            'notification_id' => $data['notification_id'],
        ]);
    }

    public function update(array $data)
    {
    }

    public function getNotifications($receiverId)
    {
        return $this->model->where('user_receive_id', $receiverId)
            ->with(['notification', 'userSend'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function changeViewed($id)
    {
        return $this->model->find($id)->update(['viewed' => 1]);
    }

    public function markedAll()
    {
        return $this->model->where('user_receive_id', Auth::id())->update(['viewed' => 1]);
    }
}

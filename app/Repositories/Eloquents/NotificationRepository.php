<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Notification;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{

    protected $model;
  
    /**
     * ArticlesRepository constructor.
     * @param Article $article
     */
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
            'type' => $data['type'],
        ]);
    }

    public function update(array $data)
    {
    }
}

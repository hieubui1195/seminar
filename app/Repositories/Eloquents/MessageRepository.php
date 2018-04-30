<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\MessageRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Message;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{

    protected $model;
  
    /**
     * ArticlesRepository constructor.
     * @param Article $article
     */
    public function __construct(Message $message)
    {
        $this->model = $message;
    }

    public function store(array $data)
    {
        return $this->model->create([
            'seminar_id' => $data['seminar_id'],
            'user_id' => $data['user_id'],
            'message' => $data['message'],
            'status' => 0,
        ]);
    }

    public function update(array $data)
    {
        
    }

    public function getMessageWithUser($id)
    {
        return $this->model->getMessageWithUser($id);
    }
}

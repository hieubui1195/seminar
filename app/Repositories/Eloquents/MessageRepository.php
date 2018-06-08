<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\MessageRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Message;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{

    protected $model;
  
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

    public function getAllMessages($id)
    {
        return $this->model->where('seminar_id', $id)->get();
    }

    public function deleteUseSeminarId($seminarId)
    {
        return $this->model->where('seminar_id', $seminarId)->delete();
    }

    public function deleteUseUserId($userId)
    {
        return $this->model->where('user_id', $userId)->delete();
    }
}

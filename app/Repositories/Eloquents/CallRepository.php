<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\CallRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Call;

class CallRepository extends BaseRepository implements CallRepositoryInterface
{

    protected $model;
  
    public function __construct(Call $call)
    {
        $this->model = $call;
    }

    public function store(array $data)
    {
        return $this->model->create([
            'caller' => $data['callerId'],
            'receiver' => $data['receiverId'],
            'status' => 0,
        ]);
    }

    public function update(array $data)
    {
        return $this->model->find($data['id'])->update([
            'status' => 1,
        ]);
    }

    public function approveCall($callerId, $receiverId)
    {
        return $this->getCall($callerId, $receiverId)
            ->update(['status' => 1]);
    }

    public function getCall($callerId, $receiverId)
    {
        return $this->model->where('caller', $callerId)
            ->where('receiver', $receiverId)
            ->orderBy('created_at', 'desc')
            ->limit(1);
    }
}

<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\CallRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Call;
use Carbon\Carbon;

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
            'start' => Carbon::now(),
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
            ->latest()
            ->first();
    }

    public function finishCall($callerId, $receiverId)
    {
        return $this->getCall($callerId, $receiverId)
            ->update(['end' => Carbon::now()]);
    }

    public function createCall($callerId, $receiverId)
    {
        return $this->getCall($callerId, $receiverId)
            ->update(['start' => Carbon::now()]);
    }
}

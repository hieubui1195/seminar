<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\ParticipantRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Participant;

class ParticipantRepository extends BaseRepository implements ParticipantRepositoryInterface
{

    protected $model;
  
    /**
     * ArticlesRepository constructor.
     * @param Article $article
     */
    public function __construct(Participant $participant)
    {
        $this->model = $participant;
    }

    public function store(array $data)
    {
        return $this->model->create([
            'seminar_id' => $data['seminar_id'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function update(array $data)
    {
        
    }

    public function checkParticipant($seminarId, $userId)
    {
        return $this->model->where([
            ['seminar_id', '=', $seminarId],
            ['user_id', '=', $userId],
        ])->first();
    }

    public function checkValidation($seminarId, $userId)
    {
        $check = $this->model->where([
            ['seminar_id', '=', $seminarId],
            ['user_id', '=', $userId],
            ['status', '=', 1],
        ])->first();

        return $check;
    }

    public function updateValidation($seminarId, $userId)
    {
        return $this->model->where([
            ['seminar_id', '=', $seminarId],
            ['user_id', '=', $userId]
        ])->update([
            'status' => 1,
        ]);
    }
}

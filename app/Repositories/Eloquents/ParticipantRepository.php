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
}

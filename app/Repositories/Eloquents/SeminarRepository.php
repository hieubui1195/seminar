<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\SeminarRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Seminar;
use Illuminate\Support\Facades\DB;

class SeminarRepository extends BaseRepository implements SeminarRepositoryInterface
{

    protected $model;
  
    /**
     * ArticlesRepository constructor.
     * @param Article $article
     */
    public function __construct(Seminar $seminar)
    {
        $this->model = $seminar;
    }

    public function store(array $data)
    {
        return $this->model->create([
            'name' => $data['name'],
            'user_id' => $data['chairman'],
            'description' => $data['description'],
            'start' => $data['start'],
            'end' => $data['end'],
            'code' => $data['code'],
        ]);
    }

    public function update(array $data)
    {
        
    }

    public function listActive()
    {
        // return $this->model->;
    }

    public function listEarly()
    {
        # code...
    }

    public function listFinished()
    {
        # code...
    }

    public function getAllWithUser()
    {
        return $this->model->getAllWithUser();
    }

    public function getSeminarWithUser($id)
    {
        return $this->model->withUser($id);
    }

    public function getMessages($id)
    {
        return $this->model->find($id)->users;
    }
}

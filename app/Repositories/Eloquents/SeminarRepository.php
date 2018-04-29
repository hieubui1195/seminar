<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\SeminarRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Seminar;

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
}

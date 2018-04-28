<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    
    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function delete($id)
    {
     return $this->model->destroy($id);
    }
}

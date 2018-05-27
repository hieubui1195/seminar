<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    protected $model;
  
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(array $data)
    {
        return $this->model->create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => bcrypt(config('custom.defaultPassword')),
            'level' => $data['level'],
        ]);
    }

    public function update(array $data)
    {
        if ($data['password']) {
            $this->model->find($data['id'])->update([
                'password' => bcrypt($data['password']),
            ]);
        }

        // if ($data['avatar']) {
        //     User::find($data['id'])->update([
        //         'avatar' => bcrypt($data['avatar']),
        //     ]);
        // }
        // 
        if ($data['phone']) {
            $this->model->find($data['id'])->update([
                'phone' => $data['phone'],
            ]);
        }

        return $this->model->find($data['id'])->update([
            'name' => $data['name'],
            //'phone' => $data['phone'],
        ]);
    }

    public function getNameAndId()
    {
        return $this->model->pluck('name', 'id');
    }
}

<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface SeminarRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);

    public function update(array $data);

    public function listActive();

    public function listEarly();

    public function listFinished();

    public function getAllWithUser();

    public function getSeminarWithUser($id);

    public function getMessages($id);
}

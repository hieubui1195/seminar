<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface SeminarRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);

    public function update(array $data);
}

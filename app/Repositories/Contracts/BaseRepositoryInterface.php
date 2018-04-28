<?php
namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function store(array $data);

    public function update(array $data);
}

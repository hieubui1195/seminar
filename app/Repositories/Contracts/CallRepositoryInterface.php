<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface CallRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);

    public function update(array $data);

    public function approveCall($callerId, $receiverId);

    public function getCall($callerId, $receiverId);

    public function finishCall($callerId, $receiverId);

   public function createCall($callerId, $receiverId);

   public function deleteUseUserId($userId);
}

<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface MessageRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);

    public function update(array $data);

    public function getMessageWithUser($id);

    public function getAllMessages($id);

    public function deleteUseSeminarId($seminarId);

    public function deleteUseUserId($userId);
}

<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface ParticipantRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);

    public function update(array $data);

    public function checkParticipant($seminarId, $userId);

    public function checkValidation($seminarId, $userId);

    public function updateValidation($seminarId, $userId);

    public function getMembersId($seminarId);

    public function deleteOneParticipant($seminarId, $userId);
}

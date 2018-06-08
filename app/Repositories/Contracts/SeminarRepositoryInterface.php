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

    public function getAllMembers($id);

    public function getReportOfSeminar($id);

    public function checkCode($id, $inputCode);

    public function checkChairman($id, $userId);

    public function newSeminar();

    public function latestSeminar();

    public function deleteUseUserId($userId);

    public function delete($id);
}

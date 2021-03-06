<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface NotificationRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);

    public function update(array $data);

    public function getNotifications($receiveId);

    public function changeViewed($id);

    public function markedAll();

    public function deleteNotificationsOfUser($userId);

    public function deleteNotificationsOfSeminar($seminarId);
}

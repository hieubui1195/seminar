<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface ReportRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);

    public function update(array $data);

    public function updateReport($id, array $data);

    public function checkReported($reportId);
}

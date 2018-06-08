<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface ReportRepositoryInterface extends BaseRepositoryInterface
{
    public function store(array $data);

    public function update(array $data);

    public function updateReport($id, $reportType, array $data);

    public function checkReported($reportId, $reportType);

    public function publishReport($reportId, $reportType);

    public function checkPublished($reportId, $reportType);

    public function getAllReports();

    public function getReportByReportId($reportId);

    public function newReport();

    public function deleteUseSeminarId($seminarId);
}

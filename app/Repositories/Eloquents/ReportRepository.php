<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Report;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{

    protected $model;
  
    public function __construct(Report $report)
    {
        $this->model = $report;
    }

    public function store(array $data)
    {
        return $this->model->create([
            'user_id' => $data['userId'],
            'report_id' => $data['reportId'],
            'report_type' => $data['reportType'],
            'report' => $data['report'],
            'filename' => $data['filename'],
            'status' => $data['status'],
        ]);
    }

    public function update(array $data)
    {
        # code...
    }

    public function updateReport($id, $reportType, array $data)
    {
        return $this->model->where('report_id', $id)
            ->where('report_type', $reportType)->update([
                'user_id' => $data['userId'],
                'report' => $data['report'],
                'filename' => $data['filename'],
            ]);
    }

    public function checkReported($reportId, $reportType)
    {
        return $this->model->where('report_id', $reportId)
            ->where('report_type', $reportType)
            ->first();
    }

    public function publishReport($reportId, $reportType)
    {
        return $this->model->where('report_id', $reportId)
            ->where('report_type', $reportType)
            ->update(['status' => 1]);
    }

    public function checkPublished($reportId, $reportType)
    {
        return $this->model->where([
            ['report_id', '=', $reportId],
            ['report_type', '=', $reportType],
            ['status', '=', 1],
        ])->first();
    }

    public function getAllReports()
    {
        return $this->model->where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->with('user')
            ->get();
    }

    public function getReportByReportId($reportId)
    {
        return $this->model->where('id', $reportId)
            ->where('status', 1)
            ->first();
    }

    public function newReport()
    {
        return $this->model->where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->take(4)
            ->get();
    }

    public function deleteUseSeminarId($seminarId)
    {
        return $this->model->where([
            ['report_id', $seminarId],
            ['report_type', config('custom.seminar')]
        ])->delete();
    }
}

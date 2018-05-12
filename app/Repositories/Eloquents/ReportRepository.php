<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Report;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{

    protected $model;
  
    /**
     * ArticlesRepository constructor.
     * @param Article $article
     */
    public function __construct(Report $report)
    {
        $this->model = $report;
    }

    public function store(array $data)
    {
        return $this->model->create([
            'user_id' => $data['userId'],
            'seminar_id' => $data['seminarId'],
            'report' => $data['report'],
        ]);
    }

    public function update(array $data)
    {
        # code...
    }

    public function updateReport($id, array $data)
    {
        return $this->model->find($id)->update([
            'user_id' => $data['userId'],
            'report' => $data['report'],
        ]);
    }

    public function checkReported($reportId)
    {
        $check = $this->model->find($reportId);

        return $check;
    }
}

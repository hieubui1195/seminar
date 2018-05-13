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
            'filename' => $data['filename'],
        ]);
    }

    public function update(array $data)
    {
        # code...
    }

    public function updateReport($id, array $data)
    {
        return $this->model->where('seminar_id', $id)->update([
            'user_id' => $data['userId'],
            'report' => $data['report'],
            'filename' => $data['filename'],
        ]);
    }

    public function checkReported($seminarId)
    {
        $check = $this->model->where('seminar_id', $seminarId)->first();

        return $check;
    }

    public function publishReport($seminarId)
    {
        return $this->model->where('seminar_id', $seminarId)->update([
            'status' => 1,
        ]);
    }

    public function checkPublished($seminarId)
    {
        $check = $this->model->where([
            ['seminar_id', '=', $seminarId],
            ['status', '=', 1],
        ])->first();

        return $check;
    }
}

<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\SeminarRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use App\Models\Seminar;
use App\Models\Participant;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeminarRepository extends BaseRepository implements SeminarRepositoryInterface
{

    protected $model, $participantModel, $reportModel;
  
    public function __construct(Seminar $seminar, Participant $participant, Report $reportModel)
    {
        $this->model = $seminar;
        $this->participantModel = $participant;
        $this->reportModel = $reportModel;
    }

    public function store(array $data)
    {
        return $this->model->create([
            'name' => $data['name'],
            'user_id' => $data['chairman'],
            'description' => $data['description'],
            'start' => $data['start'],
            'end' => $data['end'],
            'code' => $data['code'],
        ]);
    }

    public function update(array $data)
    {
        return $this->model->find($data['id'])->update([
            'name' => $data['name'],
            'user_id' => $data['chairman'],
            'description' => $data['description'],
            'start' => $data['start'],
            'end' => $data['end'],
        ]);
    }

    public function listActive()
    {
        return $this->model->listActive()->take(5)->get();
    }

    public function listEarly()
    {
        return $this->model->listEarly()->take(5)->get();
    }

    public function listFinished()
    {
        return $this->model->listFinished()->take(5)->get();
    }

    public function getAllWithUser()
    {
        return $this->model->getAllWithUser();
    }

    public function getSeminarWithUser($id)
    {
        return $this->model->where('id', $id)->withUser($id)->first();
    }

    public function getMessages($id)
    {
        return $this->model->find($id)->users;
    }

    public function getAllMembers($id)
    {
        return $this->participantModel->getMembersInSeminar($id)->get();
    }

    public function getReportOfSeminar($id)
    {
        return $this->reportModel->where([
            ['report_id', $id],
            ['report_type', config('custom.seminar')]
        ])->first();
    }

    public function checkCode($id, $inputCode)
    {
        return $this->model->where([
            ['id', '=', $id],
            ['code', '=', $inputCode],
        ])->first();
    }

    public function checkChairman($id, $userId)
    {
        return $this->model->where([
            ['id', $id],
            ['user_id', $userId]
        ])->first();
    }
}

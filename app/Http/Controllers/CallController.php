<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CallRepositoryInterface;
use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Models\Call;
use Auth;

class CallController extends Controller
{
    protected $repository;

    public function __construct(CallRepositoryInterface $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    public function createCall(Request $request)
    {
        $data = $request->only('callerId', 'receiverId');

        $callInfo = $this->repository->store($data);

        return response()->json($callInfo);
    }

    public function updateCall(Request $request)
    {
        $callerId = $request->callerId;
        $receiverId = $request->receiverId;
        
        $this->repository->approveCall($callerId, $receiverId);
    }

    public function getCall(Request $request)
    {
        $dataCall = $this->repository->getCall($request->callerId, $request->receiverId);

        return response()->json($dataCall);
    }

    public function publishReport(Request $request, ReportRepositoryInterface $reportRepository)
    {
        $data['report_id'] = $request->reportId;
        $data['report_type'] = config('custom.call');
        $data['user_id'] = Auth::id();
        $data['report'] = $request->report;
        $data['filename'] = time() . '-call-' . $request->reportId . '.pdf';

        if (!$this->reportRepository->checkReported($id, $data['reportType'])) {
            $this->reportRepository->store($data);
        } else {
            $this->reportRepository->updateReport($id, $data['reportType'], $data);
        }
    }
}

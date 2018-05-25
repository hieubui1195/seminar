<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CallRepositoryInterface;
use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Models\Call;
use Auth;

class CallController extends Controller
{
    protected $repository, $reportRepository;

    public function __construct(CallRepositoryInterface $repository,
        ReportRepositoryInterface $reportRepository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->reportRepository = $reportRepository;

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

    public function publishReport(Request $request)
    {
        $data['reportId'] = $request->reportId;
        $data['reportType'] = config('custom.call');
        $data['userId'] = Auth::id();
        $data['report'] = $request->report;
        $data['filename'] = time() . '-call-' . $request->reportId . '.pdf';
        $data['status'] = 1;

        $checkReported = $this->reportRepository->checkReported($request->reportId, $data['reportType']);
        if (!$checkReported) {
            $this->reportRepository->store($data);
        } else {
            $this->reportRepository->updateReport($request->reportId, $data['reportType'], $data);
        }

        return response()->json([
            'status' => 1,
            'msgTitle' => Lang::get('custom.success'),
            'msgContent' => Lang::get('custom.publish_success'),
        ]);
    }
}

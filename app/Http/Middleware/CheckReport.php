<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\Contracts\ReportRepositoryInterface;

class CheckReport
{
    protected $reportRepository;

    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->reportRepository->checkReported($request->id)) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}

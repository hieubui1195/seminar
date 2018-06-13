<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\Contracts\ReportRepositoryInterface;

class CheckPublished
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
        if ($this->reportRepository->checkPublished($request->id, config('custom.seminar'))) {
            return $next($request);
        } else {
            return redirect()->back();
        }
        
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\Contracts\SeminarRepositoryInterface;
use Auth;

class CheckChairman
{

    protected $seminarRepository;

    public function __construct(SeminarRepositoryInterface $seminarRepository)
    {
        $this->seminarRepository = $seminarRepository;
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
        if ($this->seminarRepository->checkChairman($request->id, Auth::id())) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}

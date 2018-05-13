<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Repositories\Contracts\ParticipantRepositoryInterface;

class CheckValidation
{
    protected $participantRepository;

    public function __construct(ParticipantRepositoryInterface $participantRepository)
    {
        $this->participantRepository = $participantRepository;
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
        if ($this->participantRepository->checkValidation($request->seminarId, Auth::id())) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}

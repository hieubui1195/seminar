<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\MessageRepositoryInterface;
use App\Repositories\Eloquents\MessageRepository;
use App\Repositories\Contracts\ParticipantRepositoryInterface;
use App\Repositories\Eloquents\ParticipantRepository;
use App\Repositories\Contracts\SeminarRepositoryInterface;
use App\Repositories\Eloquents\SeminarRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquents\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected static $reporitories = [
        'message' => [
            MessageRepositoryInterface::class,
            MessageRepository::class,
        ],
        'participant' => [
            ParticipantRepositoryInterface::class,
            ParticipantRepository::class,
        ],
        'seminar' => [
            SeminarRepositoryInterface::class,
            SeminarRepository::class,
        ],
        'user' => [
            UserRepositoryInterface::class,
            UserRepository::class,
        ],
    ];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$reporitories as $reporitory) {
            $this->app->singleton(
                $reporitory[0],
                $reporitory[1]
            );
        }
    }
}

<?php

namespace App\Providers;

use App\Contract\Repository\EloquentRepositoryInterface;
use App\Contract\Repository\InviteCodeRepositoryInterface;
use App\Contract\Repository\UserRepositoryInterface;
use App\Contract\Repository\WalletRepositoryInterface;
use App\Contract\Service\UserServiceInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\InviteCodeRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\WalletRepository;
use App\Service\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(InviteCodeRepositoryInterface::class, InviteCodeRepository::class);
        $this->app->bind(WalletRepositoryInterface::class, WalletRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

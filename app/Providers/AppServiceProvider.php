<?php

namespace App\Providers;

use App\Repositories\Setting\SettingRepository;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Repositories\TimekeepingRepository\TimekeepingRepository;
use App\Repositories\TimekeepingRepository\TimekeepingRepositoryInterface;
use App\Repositories\TotalKeeping\TotalKeepingRepository;
use App\Repositories\TotalKeeping\TotalKeepingRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            SettingRepositoryInterface::class,
            SettingRepository::class
        );

        $this->app->singleton(
            TimekeepingRepositoryInterface::class,
            TimekeepingRepository::class
        );

        $this->app->singleton(
            TotalKeepingRepositoryInterface::class,
            TotalKeepingRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

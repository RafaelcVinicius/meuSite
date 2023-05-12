<?php

namespace App\Providers;

use App\Repositories\BcbSgsRepository;
use App\Repositories\Contracts\BcbSgsRepositoryInterface;
use App\Repositories\Contracts\WalletRepositoryInterface;
use App\Repositories\WalletRepository;
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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            WalletRepositoryInterface::class,
            WalletRepository::class
        );

        $this->app->bind(
            BcbSgsRepositoryInterface::class,
            BcbSgsRepository::class
        );
    }
}

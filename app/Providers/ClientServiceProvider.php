<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Client;

class ClientServiceProvider extends AppServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        return $this->app->singleton(
            Client::class,
            function ($app) {
                return new Client();
            }
        );
    }

    /**
     * Provide services.
     *
     * @return void
     */
    public function provides()
    {
        return [
            Client::class,
        ];
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

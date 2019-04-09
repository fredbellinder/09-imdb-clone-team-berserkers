<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // \App::singleton('GuzzleHttp\Client', function () {
        //     return new \GuzzleHttp\Client();
        // });

        $this->app->singleton(
            'GuzzleHttp\Client', function () {
                return new \GuzzleHttp\Client();
            }
        );
    }
}

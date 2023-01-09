<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\StatisticsKeytaroService;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(StatisticsKeytaroService::class, function ($app){
        //     return new StatisticsKeytaroService();
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Paginator::useBootstrap();
    }
}

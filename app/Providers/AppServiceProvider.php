<?php

namespace App\Providers;

use App\Models\Series;
use Illuminate\Support\ServiceProvider;
use App\Observers\videoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Series::observe(videoObserver::class);
    }
}

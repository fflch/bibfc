<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema; // fix boot()

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
        // Fix para MariaDB ao rodar migrations
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        if (\App::environment('production')) {
            \URL::forceScheme('https');
          }
    }
}

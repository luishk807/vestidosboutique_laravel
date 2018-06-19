<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//****What that will do is actually change the default maximum field length in the database and actually shorten your maximum string length from 255 to maximum of 191 characters
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
        //from Schema use
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

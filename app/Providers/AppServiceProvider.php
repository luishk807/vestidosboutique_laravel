<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//****What that will do is actually change the default maximum field length in the database and actually shorten your maximum string length from 255 to maximum of 191 characters
use Illuminate\Support\Facades\Schema;
use App\vestidosCategories as Categories;
use App\vestidosStyles as Styles;
use App\vestidosStatus as Statuses;
use App\vestidosCountries as Countries;
use App\vestidosBrands as Brands;

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
        \Braintree\Configuration::environment(env('BRAINTREE_ENV'));
        \Braintree\Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        \Braintree\Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        \Braintree\Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
        view()->share('categories', Categories::all());
        view()->share('vestidos_styles', Styles::all());
        view()->share('statuses', Statuses::all());
        view()->share('brands', Brands::all());
        view()->share('countries', Countries::all());
        $this->app->singleton('countries', function () {
            return Countries::all();
        });
        $this->app->singleton('brands', function () {
            return Brands::all();
        });
        $this->app->singleton('statuses', function () {
            return Statuses::all();
        });
        $this->app->singleton('vestidos_styles', function () {
            return Styles::all();
        });
        $this->app->singleton('categories', function () {
            return Categories::all();
        });
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

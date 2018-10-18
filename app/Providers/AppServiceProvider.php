<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//****What that will do is actually change the default maximum field length in the database and actually shorten your maximum string length from 255 to maximum of 191 characters
use Illuminate\Support\Facades\Schema;
use App\vestidosSubCategories as SubCategories;
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
        view()->share('subcategories', SubCategories::all());
        view()->share('categories', Categories::all());
        view()->share('vestidos_styles', Styles::all());
        view()->share('statuses', Statuses::all());
        view()->share('brands', Brands::all());
        view()->share('countries', Countries::all());
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

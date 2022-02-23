<?php

namespace App\Providers;

use Braintree;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Braintree\Configuration::environment(env('BT_ENVIRONMENT'));
        Braintree\Configuration::merchantId(env('BT_MERCHANT_ID'));
        Braintree\Configuration::publicKey(env('BT_PUBLIC_KEY'));
        Braintree\Configuration::privateKey(env('BT_PRIVATE_KEY'));
    }
}

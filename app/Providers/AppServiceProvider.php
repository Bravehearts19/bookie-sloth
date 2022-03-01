<?php

namespace App\Providers;

use Braintree;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        DB::table('apartment_sponsor')
            ->where('expires_at', '<=', Carbon::now()->addHours(1)->toDateTimeString())
            ->update(['sponsor_id' => 1]);

        Braintree\Configuration::environment(env('BT_ENVIRONMENT'));
        Braintree\Configuration::merchantId(env('BT_MERCHANT_ID'));
        Braintree\Configuration::publicKey(env('BT_PUBLIC_KEY'));
        Braintree\Configuration::privateKey(env('BT_PRIVATE_KEY'));
    }
}

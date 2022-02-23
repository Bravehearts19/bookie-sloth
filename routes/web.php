<?php

use App\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

/* Route::get(
    return '/user/{id}/show';
    ) */

Route::namespace("User")
    ->prefix("user")
    ->name("user.")
    ->middleware("auth")
    ->group(function () {
        Route::get('/', 'UserController@show')->name('dashboard');

        Route::resource('apartment', 'Apartment\ApartmentController');

        Route::get('/{user}/messages', 'Apartment\MessageController@showUserMessages')->name('messages');
        Route::resource('/{apartment}/message', 'Apartment\MessageController');

        Route::get('/apartment/statistics', 'Apartment\ViewController@index');

        Route::get('/apartment/sponsor', 'Apartment\SponsorController@index');

        Route::get('apartment/{apartment}/sponsors', function(Apartment $apartment) {
            $gateway = new Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey')
            ]);
            $baseUrl = stripslashes(dirname($_SERVER['SCRIPT_NAME']));
            $baseUrl = $baseUrl == '/' ? $baseUrl : $baseUrl . '/';
        
            $token = $gateway->ClientToken()->generate();
            return view('user\apartment\sponsors\checkout', [
                'token' => $token, 
                'apartment_id' => $apartment->id
            ]);
        })->name('apartment.{apartment}.sponsors');
        
        Route::post('apartment/{apartment}/sponsors', function(Request $request) {
            $gateway = new Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey')
            ]);
            $baseUrl = stripslashes(dirname($_SERVER['SCRIPT_NAME']));
            $baseUrl = $baseUrl == '/' ? $baseUrl : $baseUrl . '/';
        
        
            $amount = $request->amount;
            $nonce = $request->payment_method_nonce;
        
            $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
        
            if ($result->success) {
                $transaction = $result->transaction;
                // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
                return redirect()->route('user.apartment.index')->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
            } else {
                $errorString = "";
        
                foreach($result->errors->deepAll() as $error) {
                    $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                }
        
                // $_SESSION["errors"] = $errorString;
                // header("Location: " . $baseUrl . "index.php");
                return redirect()->route('user.apartment.index')->withErrors('An error occurred with the message:'. $result->message);
                
            }
        })->name('apartment.{apartment}.checkout');

        
    });
Route::get('{any?}', function () {
    return view('welcome');
})->where('any', '.*');

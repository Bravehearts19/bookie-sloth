

<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Apartment;
use App\Service;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/**
 * @description get 10 paginated hotel filtered by searchstring
 * @param ?searchString={{pagination}}
 */
/* Route::get('/hotel/search', function (Request $request) {
    $searchString = $request->query('searchString');
    $apartments = DB::table('apartments')
        ->where('name', 'like', ('%' . $searchString . '%'))
        ->paginate(10);
    return json_encode($apartments);
}); */
/**
 * @description get 10 paginated hotel filtered by location
 * @param ?searchString={{pagination}}
 */
/* Route::get('hotel/search/location', function (Request $request) {
    $searchString = $request->query('searchString');
    $apartments = DB::table('apartments')
        ->where('location', 'like', ('%' . $searchString . '%'))
        ->paginate(10);
    return json_encode($apartments);
}); */
/**
 * @description get 10 paginated hotel
 * @param ?page={{pagination}}
 */
//Route::get('/hotel/index', function (Request $request) {
//    $searchString = $request->query('searchString');
//    if (!$searchString) {
//        $apartments = DB::table('apartments')->get();
//    } else {
//        $apartments = Apartment::where('location', $searchString)->with('services')
//            ->with('sponsors')
//            ->with('views')
//            ->with('user')
//            ->with('images')
//            ->get();
//    }
//    return json_encode($apartments);
//});

/**
 * @description get 10 paginated hotel
 * @param ?page={{pagination}}
 */
Route::get('/hotel/index', function (Request $request) {
    $apartments = Apartment::with('services')->paginate(10);

    return json_encode($apartments);
});

Route::get('/hotel/count', function () {
    $apartments = DB::table('apartments')->paginate(10);

    return $apartments->lastPage();
});


Route::get('/hotel/{id}', function ($id) {
    $apartment = Apartment::with('services')
        ->with('sponsors')
        ->with('views')
        ->with('user')
        ->with('images')
        ->get()
        ->where('id', $id);
    return json_encode($apartment);
});
/* chiamata per prendere i servizi */
Route::get('/services/index', function (Request $request) {
    $apartments = DB::table('services')->get();
    return json_encode($apartments);
});
// nMinStanze
// nMinPersone
//
/**
 * @description get 10 paginated hotel filtered by badge type
 * @param ?searchString={{ bronze | silver | gold}}
 */
//Route::get('hotel/search/badge', function(Request $request){
//
//    //get query string
//    $badge = $request->query('badge');
//
//    $apartments = Apartment::with('sponsors')
//        ->where('level', 'like', ('%' . $badge . '%') )
//        ->paginate(10);
//
//    return json_encode($apartments);
//});
Route::get('/destinationID', function (Request $request) {
    $curl = curl_init();
    $queryLocation = $request->query('location');
    //set request headers
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://hotels4.p.rapidapi.com/locations/v2/search?query=" . $queryLocation . "&locale=en_US&currency=USD",
        //set request to return data
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //http request method
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: hotels4.p.rapidapi.com",
            "x-rapidapi-key: fba3950aeemsh42fd429bb466e26p12aec1jsn997c6b9eb25d"
        ],
        #SSL ERROR FIX
        CURLOPT_SSL_VERIFYPEER => false
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $data = json_decode($response, true);
    return json_decode($response, true);
});
//
//$locations = ["mialno","roma", "napoli"]
//
//foreache($locations){
//
//}
//// api https://rapidapi.com/apidojo/api/hotels4/
Route::get('/hotel', function (Request $request) {
    //get query param location
    $queryDestinationID = $request->query('destinationID');
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://hotels4.p.rapidapi.com/properties/list?destinationId=" . $queryDestinationID . "&pageNumber=1&pageSize=35&checkIn=2020-01-08&checkOut=2020-01-15&adults1=1&sortOrder=PRICE&locale=en_US&currency=USD",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: hotels4.p.rapidapi.com",
            "x-rapidapi-key: d3f68a044dmsh8a0d3f9001919b6p10f4f0jsn3a25ed140441"
        ],
        #SSL ERROR FIX
        CURLOPT_SSL_VERIFYPEER => false
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $data = json_decode($response, true);
    return json_decode($response, true);
    //return json_encode($results);
});
Route::get('/hotelImage', function (Request $request) {
    $curl = curl_init();
    $hotelID = $request->query('hotelID');
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://hotels4.p.rapidapi.com/properties/get-hotel-photos?id=" . $hotelID,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: hotels4.p.rapidapi.com",
            "x-rapidapi-key: 0ba8cf1047mshc584c389c1d79d9p102b82jsn92316cd8eeab"
        ],
        #SSL ERROR FIX
        CURLOPT_SSL_VERIFYPEER => false
    ]);
    $imgUrl = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo $err;
    }
    $imgUrl = json_decode($imgUrl, true);
    //var_dump();
    $imgUrl = str_replace('{size}', 'z', $imgUrl["hotelImages"][0]["baseUrl"]);
    return $imgUrl;
});
Route::get("/search/filters", function (Request $request) {
    //get query param location
    $locationName = $request->query('locationName');
    $locationName = Apartment::where('location', 'LIKE', $locationName . '%')->first()->location;
    $radius = $request->query('radius');
    $rooms = $request->query('rooms');
    $beds = $request->query('beds');
    $servicesToFilter = $request->query('services');

    $hotels = Apartment::with('services')
        ->with('sponsors')
        ->with('views')
        ->with('user')
        ->with('images')
        ->where('n_rooms', '>', $rooms)
        ->where('n_guests', '>', $beds)
        ->get()
        ->toArray();
    if ($servicesToFilter) {
        $hotels = array_filter($hotels, function ($hotel) use ($servicesToFilter) {
            $resultIncrement = 0;

            foreach ($hotel["services"] as $hotelService) {
                if (in_array($hotelService["id"], $servicesToFilter)) {
                    $resultIncrement++;
                }
            }
            if ($resultIncrement == count($servicesToFilter)) {
                return true;
            }
        });

Route::get('/sponsors', function() {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);
    $baseUrl = stripslashes(dirname($_SERVER['SCRIPT_NAME']));
    $baseUrl = $baseUrl == '/' ? $baseUrl : $baseUrl . '/';

    $token = $gateway->ClientToken()->generate();
    return view('checkout', [
        'token' => $token
    ]);
});

Route::post('/checkout', function(Request $request) {
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
        return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: " . $baseUrl . "index.php");
        return back()->withErrors('An error occurred with the message:'. $result->message);
        
    }
});
















//echo "type: ". var_dump($data["suggestions"][0]["entities"]);
//
    //foreach($data["suggestions"][0]["entities"] as $hotel){
    //    echo "<table>";
    //    echo "<thead>";
    //    echo "<tr>";
    //    echo "<th>geoId</th>";
    //    echo "<th>destinationId</th>";
    //    echo "<th>city</th>";
    //    echo "<th>longitude</th>";
    //    echo "<th>latitude</th>";
    //    echo "<th>caption</th>";
    //    echo "<th>name</th>";
    //    echo "</tr>";
    //    echo "</thead>";
    //    echo "<tbody>";
    //    echo "<tr>";
    //    echo "<td>" . $hotel["geoId"] ."</td>";
    //    echo "<td>" . $hotel["destinationId"] ."</td>";
    //    //echo "<td>" . $hotel["city"] ."</td>";
    //    echo "<td>" . $hotel["longitude"] ."</td>";
    //    echo "<td>" . $hotel["latitude"] ."</td>";
    //    echo "<td>" . $hotel["caption"] ."</td>";
    //    echo "<td>" . $hotel["name"] ."</td>";
    //    echo "</tr>";
    //    echo "</tbody>";
    //}
    /*
    $apiKey = 'mqAzGfNws1URAH5wd6tY0kG3KacZiaN8';
    $apiSecret = '6KVeWlre2OT3cZGZ';

    $auth_data = array(
        'client_id' 		=> $apiKey,
        'client_secret' 	=> $apiSecret,
        'grant_type' 		=> 'client_credentials'
    );


    //////////////////////////////
    // BEARER TOKEN API CALL    //
    //////////////////////////////


    # create curl resource
    $curls = curl_init();


    #set curl endpoint
    #curl_setopt($curls, CURLOPT_URL, 'https://test.api.amadeus.com/v1/security/oauth2/token');
    curl_setopt($curls, CURLOPT_URL, 'https://hotels.cloudbeds.com/api/v1.1/access_token');

    #set http request to POST
    curl_setopt($curls, CURLOPT_POST, true);

    #set http header with API key and API secret provided by Amadeus API
    #curl_setopt($curls, CURLOPT_POSTFIELDS, "grant_type=client_credentials&client_id=" . $apiKey . "&client_secret=" . $apiSecret );

    #set http header Content-Type
    #curl_setopt($curls, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

    #Set http request to return content
    curl_setopt($curls, CURLOPT_RETURNTRANSFER, true);

    #SSL ERROR FIX
    curl_setopt($curls, CURLOPT_SSL_VERIFYPEER, false);


    #get request response
    $token = curl_exec($curls);


    #if request fails, throw exception
    if(!$token){
        throw new Exception(curl_error($curls), curl_errno($curls));
    }

    //var_dump($token);
    #get data associative strings array
    $data = json_decode($token, true);

    var_dump($data);

    curl_close ($curls);


    #token output
    //echo "token is ". var_dump($data) . '<br>';


    //////////////////////
    // DATA API CALL    //
    //////////////////////

    /*$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://test.api.amadeus.com/v3/shopping/hotel-offers?hotelIds=HLLON101&adults=2');
    //curl_setopt($ch, CURLOPT_URL, 'https://test.api.amadeus.com/v1/shopping/flight-destinations?origin=PAR&maxPrice=200');
    //curl_setopt($ch, CURLOPT_POST, false);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$data['access_token'],
        'Content-Type: application/json'
    ));

    #Set http request to return content
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    #SSL ERROR FIX
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);



    $results = json_decode(curl_exec($ch), true);

    //echo 'seconda chiamata';

    if ($results === false) {
        throw new Exception(curl_error($ch), curl_errno($ch));
    }


    $locationName = str_replace(' ', "%20", $locationName);
    $locationName = str_replace('/', '%2f', $locationName);
    $locationName = $locationName . "%20Italy";
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://api.tomtom.com/search/2/geocode/" . $locationName . ".json?key=onx0t6tyRKJCe8Q2JIAWTMwu3Opxi7wH",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYPEER => false
    ]);
    $addressData = curl_exec($ch);
    curl_close($ch);
    $addressData = json_decode($addressData, true);
    $searchCoordinates = $addressData["results"][0]["position"];
    $hotels = array_filter($hotels, function ($hotel) use ($searchCoordinates, $radius) {
        $distance = 6372.95477598 * acos(sin($searchCoordinates["lat"] * pi() / 180) * sin($hotel["y_coordinate"] * pi() / 180) + cos($searchCoordinates["lat"] * pi() / 180) * cos($hotel["y_coordinate"] * pi() / 180) * cos($searchCoordinates["lon"] * pi() / 180 - $hotel["x_coordinate"] * pi() / 180));
        if ($distance <= $radius) {
            return true;
        } else {
            return false;
        }
    });
    return $hotels;
    //return json_encode($results);
});

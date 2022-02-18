<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Apartment;
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
 * @description get 10 paginated hotel
 * @param ?page={{pagination}}
 */
Route::get('/hotel/index', function(Request $request){
    $apartments = DB::table('apartments')->paginate(10);

    return json_encode($apartments);
});

/**
 * @description get 10 paginated hotel filtered by searchstring
 * @param ?searchString={{pagination}}
 */
Route::get('/hotel/search', function(Request $request){
    $searchString = $request->query('searchString');

    $apartments = DB::table('apartments')
        ->where('name', 'like', ('%' . $searchString . '%') )
        ->paginate(10);

    return json_encode($apartments);
});

/**
 * @description get 10 paginated hotel filtered by location
 * @param ?searchString={{pagination}}
 */
Route::get('hotel/search/location', function(Request $request){
    $searchString = $request->query('searchString');

    $apartments = DB::table('apartments')
        ->where('location', 'like', ('%' . $searchString . '%') )
        ->paginate(10);

    return json_encode($apartments);
});

/**
 * @description get 10 paginated hotel
 * @param ?page={{pagination}}
 */
Route::get('/hotel/index', function(Request $request){
    $apartments = DB::table('apartments')->paginate(10);

    return json_encode($apartments);
});

Route::get('/hotel/{id}', function($id){
    $apartment = Apartment::all()->where('id', $id);

    return json_encode($apartment);
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









Route::get('/destinationID', function(Request $request){
    $curl = curl_init();
    $queryLocation = $request->query('location');
    //set request headers
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://hotels4.p.rapidapi.com/locations/v2/search?query=". $queryLocation ."&locale=en_US&currency=USD",
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
Route::get('/hotel', function(Request $request){

    //get query param location
    $queryDestinationID = $request->query('destinationID');

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://hotels4.p.rapidapi.com/properties/list?destinationId=". $queryDestinationID ."&pageNumber=1&pageSize=35&checkIn=2020-01-08&checkOut=2020-01-15&adults1=1&sortOrder=PRICE&locale=en_US&currency=USD",
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



Route::get('/hotelImage', function(Request $request){
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

    $imgUrl = str_replace('{size}','z', $imgUrl["hotelImages"][0]["baseUrl"]);

    return $imgUrl;
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

    curl_close ($ch);

    echo '<pre>';
    var_dump($results);
    echo '</pre>';
*/

<?php

use App\Apartment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;



function getHotelImage($hotelID){
    $ch = curl_init();

    sleep(3);

    curl_setopt_array($ch, [
        CURLOPT_URL => "http://localhost:8000/api/hotelImage?hotelID=" . $hotelID,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
    ]);
    //sleep(2);

    $imgUrl = curl_exec($ch);

    curl_close($ch);

    return $imgUrl;
}

function getHotelData($destinationID){
    // create curl resource
    $ch = curl_init();

    sleep(1);

    curl_setopt_array($ch, [
        CURLOPT_URL => "http://localhost:8000/api/hotel?destinationID=" . $destinationID,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
    ]);
    //sleep(2);

    $hotelData = curl_exec($ch);

    $hotelData = json_decode($hotelData,true);

    curl_close($ch);

    //$hotelImgUrl = getHotelImage($hotelID);
//
    ////dobbiamo trovare l'id dell'array avendo il destinationID
    //$hotelData = array_search()
    ////aggiungere il campo cover_img tra i campi di hotel data
//
    //output di 1 solo hotel
    return $hotelData["data"]["body"]["searchResults"]["results"];
}
class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $destinationArray = config('destinationID');

        $hotelArray = [];

        foreach($destinationArray as $destinationID ){
            // create curl resource
            /*$ch = curl_init();

            sleep(3);

            curl_setopt_array($ch, [
                CURLOPT_URL => "http://localhost:8000/api/hotel?destinationID=" . $destinationID,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "GET",
            ]);
            //sleep(2);

            $output = curl_exec($ch);

            curl_close($ch);*/

            $hotelArray = getHotelData($destinationID);


            //foreach($hotelArray as $hotel){
            //    $newApartment = new Apartment();
            //    $newApartment->name =  $hotel["name"];
            //    $newApartment->n_guests = $faker->numberBetween(0, 127);
            //    $newApartment->n_rooms = $faker->numberBetween(0, 320);
            //    $newApartment->n_bathrooms = $faker->numberBetween(0, 400);
            //    $newApartment->size = $faker->numberBetween(0, 32767);
            //    $newApartment->price = $faker->randomFloat(1, 20, 30);
            //    $newApartment->x_coordinate = $hotel["coordinate"]["lon"];
            //    $newApartment->y_coordinate = $hotel["coordinate"]["lat"];
            //    $newApartment->cover_img = getHotelImage($hotel["id"]);
            //    $newApartment->visible = true;
            //    $newApartment->address = $hotel["address"]["streetAddress"];
            //    $newApartment->location = $hotel["address"]["locality"];
            //    $newApartment->cap = $hotel["address"]["postalCode"];
            //}


            foreach($hotelArray as $hotel){
                if(isset($hotel["name"])){

                    echo $hotel["name"] . PHP_EOL;
                }
                echo $faker->numberBetween(0, 127) . PHP_EOL;
                echo $faker->numberBetween(0, 320) . PHP_EOL;
                echo $faker->numberBetween(0, 400) . PHP_EOL;
                echo $faker->numberBetween(0, 32767) . PHP_EOL;
                echo $faker->randomFloat(1, 20, 30) . PHP_EOL;
                if(isset($hotel["coordinate"]["lon"])){
                    echo $hotel["coordinate"]["lon"] . PHP_EOL;
                }
                if(isset($hotel["coordinate"]["lat"])){
                    echo $hotel["coordinate"]["lat"] . PHP_EOL;
                }
                if(isset($hotel["id"])){
                    echo getHotelImage($hotel["id"]) . PHP_EOL;
                }
                if(isset($hotel["address"]["streetAddress"])){
                    echo $hotel["address"]["streetAddress"] . PHP_EOL;
                }
                if(isset($hotel["address"]["locality"])){
                    echo $hotel["address"]["locality"] . PHP_EOL;
                }
                if(isset($hotel["address"]["postalCode"])){
                    echo $hotel["address"]["postalCode"] . PHP_EOL;
                }

            }








            //foreach($hotelArray as $hotel){
            //    echo PHP_EOL . " -------------------------------------------------- " . PHP_EOL;
            //    echo "name: " . $hotel["name"] . PHP_EOL;
            //    echo "address:" . $hotel["address"]["streetAddress"] . $hotel["address"]["locality"] . $hotel["address"]["postalCode"] . PHP_EOL;
            //    echo "rating: " . $hotel["guestReviews"]["unformattedRating"] . "|" . $hotel["guestReviews"]["total"] . PHP_EOL;
            //   // echo "badge: " . $hotel["guestReviews"]["badgeText"] . PHP_EOL;
            //    foreach($hotel["landmarks"] as $landmark){
            //        echo "landmarks: " . $landmark["label"] . " distance: " . $landmark["distance"] . PHP_EOL;
            //    }
            //    echo "price: " . $hotel["ratePlan"]["price"]["exactCurrent"] . PHP_EOL;
            //    echo "coordinates x: " . $hotel["coordinate"]["lon"] . " y: " . $hotel["coordinate"]["lat"] . PHP_EOL;
            //    //n ospiti
            //    //n letti
            //    //n stanze
            //    //n bagni
            //    //size
            //    //cover img
            //}
//
            //array_push($hotelArray, $output);

        }

    }
}

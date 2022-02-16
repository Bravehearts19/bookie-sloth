<?php

use App\Apartment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

/* ha saltato gli apartment con id 74 e 176 */

function getHotelImage($hotelID){
    $ch = curl_init();


    curl_setopt_array($ch, [
        CURLOPT_URL => "http://localhost:8000/api/hotelImage?hotelID=" . $hotelID,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
    ]);

    $imgUrl = curl_exec($ch);

    curl_close($ch);

    return $imgUrl;
}

function getHotelData($destinationID){
    // create curl resource
    $ch = curl_init();


    curl_setopt_array($ch, [
        CURLOPT_URL => "http://localhost:8000/api/hotel?destinationID=" . $destinationID,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
    ]);
    //sleep(2);

    $hotelData = curl_exec($ch);

    $hotelData = json_decode($hotelData,true);

    curl_close($ch);


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

            $hotelArray = getHotelData($destinationID);
            sleep(1);

            foreach($hotelArray as $hotel){
                $newApartment = new Apartment();
                if(isset($hotel["name"])){
                    $newApartment->name =  $hotel["name"];
                }else{
                    $newApartment->name = $faker->words(3);
                }
                $newApartment->n_guests = $faker->numberBetween(0, 127);
                $newApartment->n_rooms = $faker->numberBetween(0, 127);
                $newApartment->n_bathrooms = $faker->numberBetween(0, 127);
                $newApartment->size = $faker->numberBetween(0, 32767);
                $newApartment->price = $faker->randomFloat(1, 20, 30);
                $newApartment->x_coordinate = $hotel["coordinate"]["lon"];
                $newApartment->y_coordinate = $hotel["coordinate"]["lat"];
                if(isset($hotel["id"])){
                    $newApartment->cover_img = getHotelImage($hotel["id"]);
                }else{
                    $newApartment->cover_img = '/404icon.png';
                }

                $newApartment->visible = true;
                if(isset($hotel["address"]["streetAddress"])){
                    $newApartment->address = $hotel["address"]["streetAddress"];
                }else{
                    $newApartment->address = $faker->streetAddress();
                }
                if(isset($hotel["address"]["locality"])){
                    $newApartment->location = $hotel["address"]["locality"];
                }else{
                    $newApartment->location = $faker->streetAddress();
                }
                if(isset($hotel["address"]["postalCode"])){
                    $newApartment->cap = $hotel["address"]["postalCode"];
                }else{
                    $newApartment->cap = $faker->streetAddress();
                }
                $newApartment->user_id = $faker->numberBetween(0, 300);

                $newApartment->save();

                echo "added: " . $hotel["name"] . PHP_EOL;
            }

//
            //foreach($hotelArray as $hotel){
            //    if(isset($hotel["name"])){
//
            //        echo $hotel["name"] . PHP_EOL;
            //    }
            //    echo $faker->numberBetween(0, 127) . PHP_EOL;
            //    echo $faker->numberBetween(0, 320) . PHP_EOL;
            //    echo $faker->numberBetween(0, 400) . PHP_EOL;
            //    echo $faker->numberBetween(0, 32767) . PHP_EOL;
            //    echo $faker->randomFloat(1, 20, 30) . PHP_EOL;
            //    if(isset($hotel["coordinate"]["lon"])){
            //        echo $hotel["coordinate"]["lon"] . PHP_EOL;
            //    }
            //    if(isset($hotel["coordinate"]["lat"])){
            //        echo $hotel["coordinate"]["lat"] . PHP_EOL;
            //    }
            //    if(isset($hotel["id"])){
            //        echo getHotelImage($hotel["id"]) . PHP_EOL;
            //    }
            //    if(isset($hotel["address"]["streetAddress"])){
            //        echo $hotel["address"]["streetAddress"] . PHP_EOL;
            //    }
            //    if(isset($hotel["address"]["locality"])){
            //        echo $hotel["address"]["locality"] . PHP_EOL;
            //    }
            //    if(isset($hotel["address"]["postalCode"])){
            //        echo $hotel["address"]["postalCode"] . PHP_EOL;
            //    }
//
            //}
        }

    }
}

<?php

use Illuminate\Database\Seeder;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinationArray = config('destinationID');

        $hotelArray = [];

        foreach($destinationArray as $destinationID ){
            // create curl resource
            $ch = curl_init();

            sleep(3);

            curl_setopt_array($ch, [
                CURLOPT_URL => "http://localhost:8000/api/hotel?destinationID=" . $destinationID,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "GET",
            ]);
            //sleep(2);

            $output = curl_exec($ch);

            curl_close($ch);



            $output = json_decode($output, true);

            $hotelArray = $output["data"]["body"]["searchResults"]["results"];

            foreach($hotelArray as $hotel){
                echo PHP_EOL . " -------------------------------------------------- " . PHP_EOL;
                echo "name: " . $hotel["name"] . PHP_EOL;
                echo "address:" . $hotel["address"]["streetAddress"] . $hotel["address"]["locality"] . $hotel["address"]["postalCode"] . PHP_EOL;
                echo "rating: " . $hotel["guestReviews"]["unformattedRating"] . "|" . $hotel["guestReviews"]["total"] . PHP_EOL;
               // echo "badge: " . $hotel["guestReviews"]["badgeText"] . PHP_EOL;
                foreach($hotel["landmarks"] as $landmark){
                    echo "landmarks: " . $landmark["label"] . " distance: " . $landmark["distance"] . PHP_EOL;
                }
                echo "price: " . $hotel["ratePlan"]["price"]["exactCurrent"] . PHP_EOL;
                echo "coordinates x: " . $hotel["coordinate"]["lon"] . " y: " . $hotel["coordinate"]["lat"] . PHP_EOL;
                //n ospiti
                //n letti
                //n stanze
                //n bagni
                //size
                //cover img
            }
            //var_dump($output);

            //echo $output["result"];
            array_push($hotelArray, $output);
            // close curl resource to free up system resources

        }



        //echo "<pre>";
        //var_dump($hotelArray);
        //echo "</pre>";
        //foreach($hotelArray as $hotel){
        //    var_dump($hotel);
        //}

        //foreach($output as $hotel){
//
        //}


    }
}

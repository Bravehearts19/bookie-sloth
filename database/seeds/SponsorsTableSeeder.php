<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorArray = config('sponsorsDB');

        for($i = 0; $i<count($sponsorArray);$i++){
            $newSponsor = new Sponsor();
            $newSponsor->level = $sponsorArray[$i]["level"];
            $newSponsor->price = $sponsorArray[$i]["price"];
            $newSponsor->duration = $sponsorArray[$i]["duration"];

            $newSponsor->save();
        }
    }
}

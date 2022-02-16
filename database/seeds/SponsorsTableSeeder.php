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
    public function run(Faker $faker)
    {
        $sponsorLevelArray = ['bronze','silver','gold'];
        $newSponsor = new Sponsor();
        $newSponsor->level = $sponsorLevelArray[rand(0, count($sponsorLevelArray))];
        $newSponsor->price = $faker->randomFloat();
        $newSponsor->duration = $faker->time();

        $newSponsor->save();
    }
}

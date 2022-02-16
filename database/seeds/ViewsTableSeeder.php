<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\View;


class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $newView = new View();
        $newView->ip = $faker->ipv4();
        $newView->save();

        //fk????
    }
}

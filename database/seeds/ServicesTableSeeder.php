<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Service;


class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serviceArray = config('servicesDB');

        for($i = 0; $i<count($serviceArray); $i++){
            $newService = new Service();
            $newService->name = $serviceArray[$i]["name"];
            $newService->icon = $serviceArray[$i]["source"];
            $newService->description = $serviceArray[$i]["description"];

            $newService->save();
        }

    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* $this->call(UsersTableSeeder::class); */     /* DA FARE PRIMA SINGOLARMENTE */
        /* $this->call(ApartmentsTableSeeder::class); */    /* DA IMPORTARE CON IL FILE .sql */
        $this->call(ServicesTableSeeder::class);
        $this->call(SponsorsTableSeeder::class);
        $this->call(ApartmentServiceTableSeeder::class);
        $this->call(ApartmentSponsorTableSeeder::class);
    }
}

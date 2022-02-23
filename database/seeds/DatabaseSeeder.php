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
        // $this->call(UsersTableSeeder::class); da fare prima
        // import da phpmyadmin dell'apartment.sql
        $this->call(ServicesTableSeeder::class);
        $this->call(SponsorsTableSeeder::class);
        // $this->call(ViewsTableSeeder::class); not working
        $this->call(ApartmentServiceTableSeeder::class);
        $this->call(ApartmentSponsorTableSeeder::class);
    }
}

<?php

use App\Apartment;
use App\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::all();  /* recuperiamo tutti gli appartamenti */
        $services = Service::pluck("id");   /* recuperiamo tutti i servizi per id */
        foreach ($apartments as $apartment) {   /* cicliamo sugli appartamenti */
            $randomServiceNumber = rand(1, 5 /* count($services) */);  /* assegnamo un numero random di servizi compreso tra 1 ed il numero totale di servizi */
            $shuffleServices = $services->shuffle();  /* creiamo un array dove mescoliamo tutti i servizi */
            $apartmentServices= $shuffleServices->slice(0, $randomServiceNumber); /* recuperiamo un numero random di servizi tramite lo slice e lo assegniamo ad una variabile */
            $apartment->services()->attach($apartmentServices);  /* li aggiungiamo al relativo appartamento */
        }
    }
}


<?php

use App\Apartment;
use App\Sponsor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentSponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::all();  /* recuperiamo tutti gli appartamenti */
        $sponsors = Sponsor::pluck("id");   /* recuperiamo tutti i servizi per id */
        foreach ($apartments as $apartment) {   /* cicliamo sugli appartamenti */
            $randomSponsorNumber = rand(1, 1);  /* assegnamo un numero random di servizi compreso tra 1 ed il numero totale di servizi */
            $shuffleSponsors = $sponsors->shuffle();  /* creiamo un array dove mescoliamo tutti i servizi */
            $apartmentSponsor = $shuffleSponsors->slice(0, $randomSponsorNumber); /* recuperiamo un numero random di servizi tramite lo slice e lo assegniamo ad una variabile */
            $apartment->sponsors()->attach($apartmentSponsor);  /* li aggiungiamo al relativo appartamento */

            $apartment->sponsors()->attach($apartment->id, ['expires_at' => ApartmentSponsorTableSeeder::expiresAt($apartmentSponsor)]);
            dd(ApartmentSponsorTableSeeder::expiresAt($apartmentSponsor));
        }
    }

    static function expiresAt($apartmentSponsor) {
        $apartmentSponsor = DB::table('sponsors')->where('id', $apartmentSponsor)->first();
        
        dump($apartmentSponsor);
        
        $now = Carbon::now();
        
        if(!$apartmentSponsor || $apartmentSponsor->level === 'no_sponsor') {
            $now = $now;
        } else {
            $now = $now->addHours($apartmentSponsor->duration);
        }
        return $now;
    }
}

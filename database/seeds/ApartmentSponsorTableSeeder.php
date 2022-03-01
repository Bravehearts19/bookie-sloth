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
        $sponsor = Sponsor::where("id", 1)->pluck("id")->first();   /* recuperiamo tutti i servizi per id */
        foreach ($apartments as $apartment) {   /* cicliamo sugli appartamenti */
            $apartment->sponsors()->attach($sponsor, ['expires_at' => ApartmentSponsorTableSeeder::expiresAt($sponsor)]); /* li aggiungiamo al relativo appartamento */
        }
    }

    static function expiresAt($sponsor) {
        $sponsor = DB::table('sponsors')->where('id', $sponsor)->first();

        $now = Carbon::now()->addHour(1);

        if(!$sponsor || $sponsor->level === 'no_sponsor') {
            $now = $now->toDateTimeString();
        } else {
            $now = $now->addHours($sponsor->duration)->toDateTimeString();
        }
        return $now;
    }
}

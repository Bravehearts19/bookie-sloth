<?php

namespace App\Http\Controllers\User\Apartment;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Sponsor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SponsorController extends Controller
{
    public function index(Apartment $apartment)
    {
        if ($apartment->sponsors->first()->level != 'no_sponsor') {
            return redirect()->route('user.apartment.index');
        } else {
            $sponsors = Sponsor::all();

            return view('user.apartment.sponsors.index', ['sponsors' => $sponsors, 'apartment' => $apartment]);
        }
    }

    public function store(Request $request, Apartment $apartment)
    {
        $data = $request->all();
        $sponsorToApply = Sponsor::where('id', $data["sponsor"])->first();
        $apartmentSponsor = DB::table('apartment_sponsor')->where('apartment_id', $apartment->id)->get()->toArray();

        $expireDate = "";
        if (empty($allSponsors)) {
            $expireDate = Carbon::now()->addHours($sponsorToApply["duration"] + 1)->toDateTimeString();
        } else {
            $expireDate = Carbon::parse(end($apartmentSponsor)->expires_at)->addHours($sponsorToApply["duration"])->toDateTimeString();
        }

        DB::table('apartment_sponsor')
            ->where('apartment_id', $apartment->id)
            ->update(['sponsor_id' => $sponsorToApply['id'], 'expires_at' => $expireDate, 'created_at' => Carbon::now()->addHours(1)]);

        return redirect()->route('user.apartment.index')->with('msg', 'Sponsor applicato!');
    }
}

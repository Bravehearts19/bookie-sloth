<?php

namespace App\Http\Controllers\User\Apartment;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index(Apartment $apartment)
    {
        $sponsors = Sponsor::all();

        return view('user.apartment.sponsors.index', ['sponsors' => $sponsors, 'apartment' => $apartment]);
    }

    public function store(Request $request, Apartment $apartment)
    {
        $data = $request->all();
        $sponsorToApply = Sponsor::where('id', $data["sponsor"])->first();
        $apartment->sponsors()->attach($sponsorToApply->id);

        return redirect()->route('user.apartment.index')->with('msg', 'Sponsor applicato!');
    }
}

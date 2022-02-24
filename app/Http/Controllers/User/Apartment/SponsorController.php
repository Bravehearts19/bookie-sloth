<?php

namespace App\Http\Controllers\User\Apartment;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index(Apartment $apartment) {
        $sponsors = Sponsor::all();

        return view('user.apartment.sponsors.index', ['sponsors' => $sponsors, 'apartment' => $apartment]);
    }

    public function store(Request $request) {
        $data = $request->all();
        
        $apartment->sponsors()->attach($data);

        return redirect()->route('user.apartment.index');  
    }
}

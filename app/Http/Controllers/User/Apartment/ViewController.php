<?php

namespace App\Http\Controllers\User\Apartment;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function index(Apartment $apartment) {
        $apartmentId = $apartment->id;
        $views = DB::table('views')->where('apartment_id', $apartmentId)->get();

        return view('user.apartment.views.index', ['views' => $views, 'apartment' => $apartment]);
    }
}

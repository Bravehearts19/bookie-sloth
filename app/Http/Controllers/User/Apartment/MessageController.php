<?php

namespace App\Http\Controllers\User\Apartment;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index(Apartment $apartment) {
        $apartmentId = $apartment->id;
        $messages = DB::table('messages')->where('apartment_id', $apartmentId)->get();

        return view('user.apartment.messages.index', ['messages' => $messages, 'apartment' => $apartment]);
    }
}

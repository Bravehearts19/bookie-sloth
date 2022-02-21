<?php

namespace App\Http\Controllers\User\Apartment;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Apartment $apartment)
    {
        $messages = Message::where('apartment_id', $apartment->id)->with('apartment')->get();

        return view('user.apartment.messages.index', compact("messages"));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($apartmentId, $messageId)
    {
        $message = Message::where('id', $messageId)
            ->where('apartment_id', $apartmentId)
            ->with('apartment')
            ->first();
        return view('user.apartment.messages.show', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment, Message $message)
    {
        $messageToDelete = Message::where('id', $message->id)
            ->where('apartment_id', $apartment->id)
            ->first();
        Message::softDelete($messageToDelete->id);

        return redirect()->route('user.message.index', $apartment->id);
    }
}

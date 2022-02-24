<?php

namespace App\Http\Controllers\User\Apartment;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //show all messages for an apartment
    public function index(Apartment $apartment)
    {
        $messages = Message::where('apartment_id', $apartment->id)->with('apartment')->get();

        return view('user.apartment.messages.index', [
            "messages" => $messages,
            "showAll" => false
        ]);
    }

    //show all user messages
    public function showUserMessages(User $user)
    {
        $messages = Message::all();
        $apartmentsIds = $user->apartments()->pluck('id')->toArray();
        // dd($user->apartments()->pluck('id'), $messages);
        $userMessages = [];
        foreach ($messages as $message) {
            if (in_array($message->apartment_id, $apartmentsIds)) {
                array_push($userMessages, $message);
            }
        }
        return view('user.apartment.messages.index', [
            "messages" => $userMessages,
            "showAll" => true
        ]);
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
        $data = $request->all();
        $newMessage = new Message;
        $newMessage->name = $data["name"];
        $newMessage->email = $data["email"];
        $newMessage->message = $data["message"];
        $newMessage->apartment_id = $data["apartmentId"];

        $newMessage->save();
        return redirect('/apartment/' . $data["apartmentId"])->with("msg", "Messaggio inviato correttamente");
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
        Message::destroy($messageToDelete->id);

        return redirect()->route('user.message.index', $apartment->id);
    }
}

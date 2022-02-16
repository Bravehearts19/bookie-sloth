<?php

namespace App\Http\Controllers\User\Apartment;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userApartments = Auth::user()->apartments->all();

        return view('user.apartment.index', compact('userApartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.apartment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|regex:/[\d]{6},[\d]{2}/',
            'image' => 'required|file',
            'size' => 'integer|between:0,32.767',
            'address' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'n_guests' => 'required|integer|between:0,255',
            'n_rooms' => 'required|integer|between:0,255',
            'n_bathrooms' => 'integer|between:0,255'
        ]);

        $data = $request->all();

        $newApartment = new Apartment;
        $newApartment->fill($data);
        $newApartment->user_id = Auth::user()->id;

        $newApartment->save();

        return redirect()->route('user.apartment.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // SHOW UTILIZZATO CON UN BUTTON ALL'INTERNO DELL'INDEX DEGLI APARTMENT, RIMANDA A VUE
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('user.apartment.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $data = $request->all();

        $apartment->update($data);

        $apartmentId = $apartment->id;

        return redirect()->route('apartment/' . $apartmentId);  // **********  DA RICONTROLLARE  ***************
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('user.apartment.index');
    }
}

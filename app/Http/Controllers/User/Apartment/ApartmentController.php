<?php

namespace App\Http\Controllers\User\Apartment;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Service;

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
        $services = Service::all();


        return view('user.apartment.create', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //regex:/[\d]{6},[\d]{2}/'

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0|max:32767',
            'cover_img' => 'file|required',
            'size' => 'required|integer|between:0,32767',
            'address' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'n_guests' => 'required|integer|between:0,255',
            'n_rooms' => 'required|integer|between:0,255',
            'n_bathrooms' => 'integer|between:0,255',
            'services' => 'required'
        ]);

        $data = $request->all();
        $data["services"] = explode(',', $data["services"]);

        $address = str_replace(' ', "%20", $data['address']);
        $address = str_replace('/', '%2f', $address);

        $city = str_replace(' ', "%20", $data['location']);
        $fullAddress = $address . '%20' . $city;

        $ch = curl_init();


        curl_setopt_array($ch, [
            CURLOPT_URL => "https://api.tomtom.com/search/2/geocode/" . $fullAddress . ".json?key=onx0t6tyRKJCe8Q2JIAWTMwu3Opxi7wH",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false


        ]);

        $addressData = curl_exec($ch);

        $addressData = json_decode($addressData, true);

        curl_close($ch);




        $newApartment = new Apartment;
        $newApartment->x_coordinate = $addressData['results'][0]['position']['lon'];
        $newApartment->y_coordinate = $addressData['results'][0]['position']['lat'];
        $data["cover_img"] = Storage::put('apartment_images', $data["cover_img"]);
        $newApartment->fill($data);
        $newApartment->user_id = Auth::user()->id;

        $newApartment->save();

        $newApartment->services()->attach($data['services']);
        $newApartment->sponsors()->attach(1);

        return redirect()->route('user.apartment.index')->with('msg', 'Appartamento aggiunto correttamente.');;
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
        $services = Service::all();

        return view('user.apartment.edit', ['apartment' => $apartment, 'services' => $services]);
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
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0|max:32767',
            'cover_img' => 'file',
            'size' => 'required|integer|between:0,32767',
            'address' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'n_guests' => 'required|integer|between:0,255',
            'n_rooms' => 'required|integer|between:0,255',
            'n_bathrooms' => 'integer|between:0,255',
            'services' => 'required'
        ]);


        $data = $request->all();

        $data["services"] = explode(',', $data["services"]);

        $oldAddress = $apartment['address'];
        $oldCity = $apartment['location'];




        if ($oldAddress !== $data['address'] || $oldCity !== $data['location']) {

            $address = str_replace(' ', "%20", $data['address']);
            $address = str_replace('/', '%2f', $address);

            $city = str_replace(' ', "%20", $data['location']);
            $fullAddress = $address . '%20' . $city;

            $ch = curl_init();


            curl_setopt_array($ch, [
                CURLOPT_URL => "https://api.tomtom.com/search/2/geocode/" . $fullAddress . ".json?key=onx0t6tyRKJCe8Q2JIAWTMwu3Opxi7wH",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_SSL_VERIFYPEER => false


            ]);

            $addressData = curl_exec($ch);

            $addressData = json_decode($addressData, true);

            curl_close($ch);

            $apartment->x_coordinate = $addressData['results'][0]['position']['lon'];
            $apartment->y_coordinate = $addressData['results'][0]['position']['lat'];
        }
        if (isset($data["cover_img"])) {
            Storage::delete($apartment->cover_img); //deletes previous image in storage
            $data["cover_img"] = Storage::put('apartment_images', $data["cover_img"]); //adds new image
        }


        $apartment->update($data);


        $apartment->services()->sync($data['services']);

        $apartmentId = $apartment->id;

        //return redirect('/apartment/' . $apartmentId);  // **********  DA RICONTROLLARE  *************** 

        return redirect()->route('user.apartment.index')->with('msg', "Appartamento modificato correttamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   Apartment $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->services()->detach();
        $apartment->delete();

        return redirect()->route('user.apartment.index')->with('msg', 'Appartamento eliminato correttamente.');
    }
}

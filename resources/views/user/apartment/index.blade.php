@extends('layouts.user')

@php
use Carbon\Carbon;
use App\Sponsor;

function getLatestSponsor($apartment){
    $allSponsors = DB::table('apartment_sponsor')->where('apartment_id', $apartment->id)->get()->toArray();
    
    $actualSponsor = "";
    $finalSponsor = null;
    foreach ($allSponsors as $sponsor) {
        if (Carbon::parse($sponsor->expires_at) >= Carbon::now()) {
            $actualSponsor = $sponsor;
            return $finalSponsor = Sponsor::where('id', $actualSponsor->sponsor_id)->get()->toArray();
        }
    }
    return false;
}

function activeSponsors($apartment){
    if(getLatestSponsor($apartment)){
        return true;
    }
    else{
        return false;
    }
}
@endphp

@section('content')
    <div class="container mt-3">

        @if(session("msg"))
            <div class="alert alert-primary d-flex justify-content-between" role="alert">{{session("msg")}}</div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
            @foreach($userApartments as $apartment)
            <div class="col mb-3">
                <div class="card mb-3 h-100">
                    <img src="{{asset('storage/' . $apartment->cover_img)}}" class="card-img-top h-100" alt="{{$apartment->name}}">
                    <div class="card-body">
                        <h4 class="card-title d-flex justify-content-between align-items-center">{{$apartment->name}} @if(activeSponsors($apartment)) <img src="/images/{{getLatestSponsor($apartment)[0]['level']}}_badge.svg" alt=""> @endif</h4>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Prezzo: </strong> €{{$apartment->price}}</li>
                            <li class="list-group-item"><strong>Dimensione: </strong> {{$apartment->size}} mq.</li>
                            <li class="list-group-item"><strong>Numero di ospiti: </strong> {{$apartment->n_guests}}</li>
                            <li class="list-group-item"><strong>Numero di bagni: </strong> {{$apartment->n_bathrooms}}</li>
                            <li class="list-group-item"><strong>Numero di stanze: </strong> {{$apartment->n_rooms}}</li>
                            <li class="list-group-item"><strong>Indirizzo </strong> {{$apartment->address}}</li>
                            <li class="list-group-item"><strong>Città: </strong> {{$apartment->location}}</li>
                            <li class="list-group-item"><strong>CAP: </strong> {{$apartment->cap}}</li>
                        </ul>
                    </div>
                    <a href="/apartment/{{$apartment->id}}" class="btn btn-secondary text-primary">Dettagli appartamento</a>
                    <a href="{{route('user.apartment.edit', $apartment->id)}}" class="btn btn-primary text-secondary">Modifica appartamento</a>
                    <a href="{{route('user.message.index', $apartment->id)}}" class="btn btn-white text-secondary">Visualizza messaggi</a>
                    <a href="{{route('user.sponsors', $apartment)}}" class="btn btn-dark text-white">Sponsorizza appartamento</a>
                </div>
            </div>
            @endforeach
        </div>
        
</div>
@endsection
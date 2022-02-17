@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            My apartments
        </h1>

        <a href="{{route("user.apartment.create")}}" class="btn btn-success text-white mb-3">Aggiungi appartamento</a>

        @foreach($userApartments as $apartment)
        <div class="card mb-3">
            <img src="{{asset('storage/' . $apartment->cover_img)}}" class="card-img-top" alt="{{$apartment->name}}">
            <div class="card-body">
                <h4 class="card-title">{{$apartment->name}}</h4>
                <ul>
                    <li><strong>Prezzo: </strong> €{{$apartment->price}}</li>
                    <li><strong>Dimensione: </strong> {{$apartment->size}} mq.</li>
                    <li><strong>Numero di ospiti: </strong> {{$apartment->n_guests}}</li>
                    <li><strong>Numero di bagni: </strong> {{$apartment->n_bathrooms}}</li>
                    <li><strong>Numero di stanze: </strong> {{$apartment->n_rooms}}</li>
                    <li><strong>Indirizzo </strong> {{$apartment->address}}</li>
                    <li><strong>Città: </strong> {{$apartment->location}}</li>
                    <li><strong>CAP: </strong> {{$apartment->cap}}</li>
                </ul>
            </div>
            <a href="{{route('user.apartment.edit', $apartment->id)}}" class="btn btn-primary text-white">Modifica appartamento</a>
        </div>
        @endforeach
        
</div>
@endsection
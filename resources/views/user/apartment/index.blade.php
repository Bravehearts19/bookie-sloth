@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-white">
            My apartments
        </h1>

        <a href="{{route("user.apartment.create")}}" class="btn btn-primary text-secondary mb-3">Aggiungi appartamento</a>

        @if(session("msg"))
            <div class="alert alert-primary d-flex justify-content-between" role="alert">{{session("msg")}}</div>
        @endif

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
            <a href="{{route('user.apartment.edit', $apartment->id)}}" class="btn btn-primary text-secondary">Modifica appartamento</a>
        </div>
        @endforeach
        
</div>
@endsection
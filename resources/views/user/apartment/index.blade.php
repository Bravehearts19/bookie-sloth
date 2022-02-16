@extends('layouts.app')

@section('content')
    <div>
        <h1>
            Apartments index
        </h1>
    </div>

    <div class="container">
        @foreach($userApartments as $apartment)
            <h3>
                {{ $apartment->name }}
            </h3>
        @endforeach
    </div>
@endsection
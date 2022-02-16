@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('user.apartment.store') }}" method="post" enctype='multipart/form-data'>
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nome Hotel</label>
            <input type="text" class="form-control" name='name' id="name" aria-describedby="emailHelp">
        </div>
        
        <div class="mb-3">
            <label for="n_guests" class="form-label">Numero Ospiti</label>
            <input type="number" class="form-control" name='n_guests' id="n_guests" min="0" max="127" aria-describedby="emailHelp">
        </div> 

        <div class="mb-3">
            <label for="n_rooms" class="form-label">Numero Stanze</label>
            <input type="number" class="form-control" name='n_rooms' id="n_rooms" min="0" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="n_bathrooms" class="form-label">Numero Bagni</label>
            <input type="number" class="form-control" name='n_bathrooms' id="n_bathrooms" min="0" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="size" class="form-label">Dimensioni</label>
            <input type="number" class="form-control" name='size' id="size" min="0" max='32767' aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="number" class="form-control" name='price' id="price" min="0" max='32767' aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <input type="text" class="form-control" name='address' id="address" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="cover_img" class="form-label">Immagine di copertina</label>
            <input type="file" class="form-control" name='cover_img' id="cover_img" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Città</label>
            <input type="text" class="form-control" name='location' id="location" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="cap" class="form-label">CAP</label>
            <input type="text" class="form-control" name='cap' id="cap" aria-describedby="emailHelp">
        </div>

        <button type="submit" class="btn btn-primary mx-4">Aggiungi</button>

    </form>


@endsection

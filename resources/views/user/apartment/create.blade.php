@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('user.apartment.store') }}" method="post" enctype='multipart/form-data'>
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nome Hotel</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name='name' id="name" aria-describedby="emailHelp" value="{{ old('name') }}" required>
            @error('name')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="n_guests" class="form-label">Numero Ospiti</label>
            <input type="number" class="form-control @error('n_guests') is-invalid @enderror" name='n_guests' id="n_guests" min="0" max="127" aria-describedby="emailHelp" value="{{ old('n_guests') }}" required>
            @error('n_guests')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="n_rooms" class="form-label">Numero Stanze</label>
            <input type="number" class="form-control @error('n_rooms') is-invalid @enderror" name='n_rooms' id="n_rooms" min="0" aria-describedby="emailHelp" value="{{ old('n_rooms') }} required" >
            @error('n_rooms')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="n_bathrooms" class="form-label">Numero Bagni</label>
            <input type="number" class="form-control @error('n_bathrooms') is-invalid @enderror" name='n_bathrooms' id="n_bathrooms" min="0" aria-describedby="emailHelp" value="{{ old('n_bathrooms') }}" required>
            @error('n_bathrooms')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="size" class="form-label">Dimensioni</label>
            <input type="number" class="form-control @error('size') is-invalid @enderror" name='size' id="size" min="0" max='32767' aria-describedby="emailHelp" value="{{ old('size') }}">
            @error('size')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" name='price' id="price" step="0.01" min="0" max='32767' aria-describedby="emailHelp" value="{{ old('price') }}" required>
            @error('price')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" name='address' id="address" aria-describedby="emailHelp" value="{{ old('address') }}" required>
            @error('address')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_img" class="form-label">Immagine di copertina</label>
            <input type="url" class="form-control @error('cover_img') is-invalid @enderror" name='cover_img' id="cover_img" aria-describedby="emailHelp" value="{{ old('cover_img') }}" required>
            @error('cover_img')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Città</label>
            <input type="text" class="form-control @error('location') is-invalid @enderror" name='location' id="location" aria-describedby="emailHelp" value="{{ old('location') }}" required>
            @error('location')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cap" class="form-label">CAP</label>
            <input type="text" class="form-control @error('cap') is-invalid @enderror" name='cap' id="cap" aria-describedby="emailHelp" value="{{ old('cap') }}">
            @error('cap')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mx-4">Aggiungi</button>

    </form>


@endsection

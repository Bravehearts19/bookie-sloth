@extends ('layouts.app')

@section('content')
<div class="container">

  <form action="{{ route('user.apartment.update', $apartment->id) }}" method="post" enctype='multipart/form-data'>
      @csrf
      @method("PATCH")

      <div class="mb-3">
          <label for="name" class="form-label">Nome Hotel</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name='name' value="{{$apartment->name}}" id="name" aria-describedby="emailHelp">
            @error('name')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
      </div>
      
      <div class="mb-3">
          <label for="n_guests" class="form-label">Numero Ospiti</label>
          <input type="number" class="form-control @error('n_guests') is-invalid @enderror" name='n_guests' value="{{$apartment->n_guests}}" id="n_guests" min="0" max="127" aria-describedby="emailHelp">
            @error('n_guests')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
      </div> 

      <div class="mb-3">
        <label for="n_rooms" class="form-label">Numero Stanze</label>
        <input type="number" class="form-control @error('n_rooms') is-invalid @enderror" name='n_rooms' value="{{$apartment->n_rooms}}" id="n_rooms" min="0" aria-describedby="emailHelp">
          @error('n_rooms')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>

      <div class="mb-3">
          <label for="n_bathrooms" class="form-label">Numero Bagni</label>
          <input type="number" class="form-control @error('n_bathrooms') is-invalid @enderror" name='n_bathrooms' value="{{$apartment->n_bathrooms}}" id="n_bathrooms" min="0" aria-describedby="emailHelp">
            @error('n_bathrooms')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
      </div>

      <div class="mb-3">
          <label for="size" class="form-label">Dimensioni</label>
          <input type="number" class="form-control @error('size') is-invalid @enderror" name='size' id="size" value="{{$apartment->size}}" min="0" max='32767' aria-describedby="emailHelp">
            @error('size')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
            @enderror   
        </div>

      <div class="mb-3">
          <label for="price" class="form-label">Prezzo</label>
          <input type="number" class="form-control @error('price') is-invalid @enderror" name='price' step="0.01" id="price" value="{{$apartment->price}}" min="0" max='32767' aria-describedby="emailHelp">
            @error('price')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
            @enderror   
      </div>

      <div class="mb-3">
          <label for="address" class="form-label">Indirizzo</label>
          <input type="text" class="form-control @error('address') is-invalid @enderror" name='address' id="address" value="{{$apartment->address}}" aria-describedby="emailHelp">
            @error('address')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
            @enderror   
      </div>

      <div class="mb-3">
          <label for="cover_img" class="form-label">Immagine di copertina</label>
          <div class="input-group mb-3">
            <input type="file" class="form-control" name="cover_img" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
        </div>
          @error('cover_img')
              <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror 
      </div>

      <div class="mb-3">
          <label for="location" class="form-label">Città</label>
          <input type="text" class="form-control @error('location') is-invalid @enderror" name='location' id="location" value="{{$apartment->location}}" aria-describedby="emailHelp">
            @error('location')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
            @enderror   
      </div>

      <div class="mb-3">
          <label for="cap" class="form-label">CAP</label>
          <input type="text" class="form-control @error('cap') is-invalid @enderror" name='cap' id="cap" value="{{$apartment->cap}}" aria-describedby="emailHelp">
            @error('cap')
              <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </span>
            @enderror   
      </div>

      <div class="mb-3">
        <label for="visibility" class="form-label">Visibilità</label>
        <select class="form-select" name="visible">
          <option value="0" class="text-danger" {{$apartment->visible === 0 ? 'selected' : ''}}>Non visibile</option>
          <option value="1" class="text-success" {{$apartment->visible === 1 ? 'selected' : ''}}>Visibile</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary text-white">Modifica</button>
      
    </form>

    <form action="{{route('user.apartment.destroy', $apartment->id)}}" method="post">
      @csrf
      @method("DELETE")
      <button type="submit" id="deleteButton" class="btn btn-danger text-white mt-3">Elimina</button>
    </form>
@endsection
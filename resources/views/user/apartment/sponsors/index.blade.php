@extends('layouts.app')

@section('content')

<div class="mb-3">
  <label class="form-label">Level</label>
  <select class="form-select" aria-label="Default select example">
  <option selected>Scegli il livello del tuo sponsor</option>
  <option value="1">Oro</option>
  <option value="2">Argento</option>
  <option value="3">Bronzo</option>
</select>
</div>

@endsection
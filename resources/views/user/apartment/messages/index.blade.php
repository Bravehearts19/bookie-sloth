@extends('layouts.app')

@section('content')
<h2>Messaggi per </h2>
<div class="container mt-5">
  <div class="row">
    <ul class="list-group">
      @foreach($messages as $message)
      <a href="{{route('user.message.show', [$message->apartment->id, $message->id])}}" class="list-group-item">Messaggio da {{$message->name}}</a>
      @endforeach
    </ul>
  </div>
</div>
@endsection
{{-- <h2>Messaggi</h2>
@foreach ($messages as $message)
    {{$message->message}}
    {{$message->name}}
    {{$message->email}}
@endforeach --}}
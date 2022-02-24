@extends('layouts.user')

@section('content')
<div class="container mt-5">
  <div class="row">
    <div class="card text-center messages-card">
      <h3 class="card-header">
        Messaggi
      </h3>
      <div class="card-body">
        @if(count($messages) === 0)
        <div class="alert alert-dark" role="alert">
          Non hai nuovi messaggi.
        </div>
        @endif
        <ul class="list-group">
          @foreach($messages as $message)
          <a href="{{route('user.message.show', [$message->apartment->id, $message->id])}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" aria-current="true">
            <div>
              Messaggio da <strong>{{$message->name}}</strong>
            </div>
          
            @if($showAll)
              <h5>{{$message->apartment->name}}</h5>
            @endif
          </a>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- @foreach($messages as $message)
      <a href="{{route('user.message.show', [$message->apartment->id, $message->id])}}" class="list-group-item">Messaggio da {{$message->name}}</a>
      @endforeach --}}
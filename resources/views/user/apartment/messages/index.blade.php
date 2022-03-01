@extends('layouts.user')

@section('content')
<div class="container mt-5">
  <div class="row">
    <div class="card text-center messages-card">
      <h3 class="card-header text-primary">
        Messaggi
      </h3>
      <div class="card-body">
        @if(count($messages) === 0)
        <div class="alert alert-primary" role="alert">
          Non hai nuovi messaggi.
        </div>
        @endif
        <ul class="list-group">
          @foreach($messages as $message)
          <a href="{{route('user.message.show', [$message->apartment->id, $message->id])}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" aria-current="true">
            <div class="d-flex justify-content-between">
              <p>Messaggio da <strong>{{$message->name}}</strong></p>
            </div>
          
            @if($showAll)
            <div class="d-flex">
              <div class="me-3 opacity-50">{{$message->created_at}}</div>
              <h5>{{$message->apartment->name}}</h5>
            </div>

            @else
            <span class="ms-3 opacity-50">{{$message->created_at}}</span>
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
@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="card mt-5">
        <div class="card-header">
          Messaggio
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>{{$message->message}}</p>
            <strong>Email:</strong><p>{{$message->email}}</p>
            <footer class="blockquote-footer mt-2">{{$message->name}}</footer>
          </blockquote>
          <form action="{{route("user.message.destroy", [$message->apartment->id, $message->id])}}" id="formDelete" method="post">
            @csrf
            @method("DELETE")

            <button type="submit" class="btn btn-danger text-white mt-3">Cancella messaggio</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
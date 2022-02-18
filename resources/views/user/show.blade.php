@extends('layouts.app')

@section('content')
    <div>
        <h1>
            DASHBOARD
        </h1>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <h2>Bentornato {{Auth::user()->name}}</h2>

                        <a href="{{route("user.apartment.index")}}" class="btn btn-primary text-white d-block">I tuoi appartamenti</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
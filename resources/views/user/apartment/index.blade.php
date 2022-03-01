@extends('layouts.user')

@section('content')
    <div class="container mt-3 vh-100" style="background-color: #84cbba42;">
        
        @if(session("msg"))
            <div class="alert alert-primary d-flex justify-content-between" role="alert">{{session("msg")}}</div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
            @foreach($userApartments as $apartment)
            <div class="col mb-3">
                <div class="card mb-3 h-100">
                    <img src="{{asset('storage/' . $apartment->cover_img)}}" class="card-img-top h-100" alt="{{$apartment->name}}">
                    <div class="card-body bg-secondary">
                        <h4 class="card-title d-flex justify-content-between align-items-center text-primary mb-3">{{$apartment->name}} @if($apartment->sponsors->first()) <img src="/images/{{$apartment->sponsors->first()->level}}_badge.svg" alt=""> @endif</h4>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="/apartment/{{$apartment->id}}" class="btn btn-primary text-primary card-btn rounded-circle">
                                <lord-icon
                                src="https://cdn.lordicon.com/tyounuzx.json"
                                trigger="empty"
                                style="width:35px;height:35px"
                                colors="primary:#ffffff,secondary:#ffffff"
                                >
                                </lord-icon>
                            </a>
                            <a href="{{route('user.apartment.edit', $apartment->id)}}" class="btn btn-primary text-secondary rounded-circle">
                                <lord-icon
                                    src="https://cdn.lordicon.com/wloilxuq.json"
                                    trigger="empty"
                                    style="width:35px;height:35px"
                                    colors="primary:#ffffff,secondary:#ffffff"
                                    >
                                    
                                </lord-icon>
                            </a>
                            <a href="{{route('user.message.index', $apartment->id)}}" class="btn btn-primary text-secondary rounded-circle">
                                <lord-icon
                                src="https://cdn.lordicon.com/rhvddzym.json"
                                trigger="empty"
                                style="width:35px;height:35px"
                                colors="primary:#ffffff,secondary:#ffffff"
                                >
                            </lord-icon>
                            </a>
                            @if($apartment->sponsors->first()->level === 'no_sponsor') <a href="{{route('user.sponsors', $apartment)}}" class="btn btn-primary text-white rounded-circle">
                                <lord-icon
                                src="https://cdn.lordicon.com/rgyftmhc.json"
                                trigger="empty"
                                style="width:35px;height:35px"
                                colors="primary:#ffffff,secondary:#ffffff"
                                >
                                </lord-icon>
                            </a> 
                            @endif
                        </div>
                    </div>
                    {{-- <a href="/apartment/{{$apartment->id}}" class="btn btn-secondary text-primary">Dettagli appartamento</a>
                    <a href="{{route('user.apartment.edit', $apartment->id)}}" class="btn btn-primary text-secondary">Modifica appartamento</a>
                    <a href="{{route('user.message.index', $apartment->id)}}" class="btn btn-white text-secondary">Visualizza messaggi</a>
                    @if($apartment->sponsors->first()->level === 'no_sponsor') <a href="{{route('user.sponsors', $apartment)}}" class="btn btn-dark text-white">Sponsorizza appartamento</a> @endif --}}
                </div>
            </div>
            @endforeach
        </div>
        
</div>
@endsection
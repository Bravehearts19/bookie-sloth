@extends('layouts.user')

@section('content')
    <!--<div class="row row-cols-4 m-3">
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-8">
                        <div class="card-body">
                            <h4 class="card-title">Appartamenti</h4>
                            <h3 class="card-text">{{Auth::user()->apartments()->count()}}</h3>
                        </div>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <lord-icon
                            src="https://cdn.lordicon.com/gmzxduhd.json"
                            trigger="hover"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-8">
                        <div class="card-body">
                            <h4 class="card-title">Visite</h4>
                            {{-- <h3 class="card-text">{{Auth::user()->apartments()->count()}}</h3> --}}
                        </div>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <lord-icon
                            src="https://cdn.lordicon.com/tyounuzx.json"
                            trigger="hover"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-8">
                        <div class="card-body">
                            <h4 class="card-title">Sponsorizzati</h4>
                            <h3 class="card-text">{{Auth::user()->apartments()->has('sponsors')->count()}}</h3>
                        </div>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <lord-icon
                            src="https://cdn.lordicon.com/rgyftmhc.json"
                            trigger="hover"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-8">
                        <div class="card-body">
                            <h4 class="card-title">Punteggio</h4>
                            {{-- <h3 class="card-text">{{Auth::user()->apartments()->count()}}</h3> --}}
                        </div>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <lord-icon
                            src="https://cdn.lordicon.com/mdgrhyca.json"
                            trigger="hover"
                            style="width:100px;height:100px">
                        </lord-icon>
                    </div>
                </div>
            </div>
        </div>-->















    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="stat-cards-container d-flex flex-column flex-lg-row align-items-center gap-3 m-5">
                    <div class="stat-card d-flex w-fit-content shadow-lg overflow-hidden border border-primary rounded">
                        <div class="stat-card-content d-flex flex-column">
                            <div class="stat-card-header bg-secondary text-primary border-bottom border-primary p-2 px-5">
                                <h3>Appartamenti</h3>
                            </div>
                            <div class="stat-card-value bg-primary text-center py-2">
                                <h3 class="mb-0 text-white">{{Auth::user()->apartments()->count()}}</h3>
                            </div>
                        </div>
                        <div class="stat-card-icon d-flex align-items-center shadow-lg bg-white px-2">
                            <lord-icon
                                src="https://cdn.lordicon.com/gmzxduhd.json"
                                trigger="loop-on-hover"
                                style="width:60px;height:60px"
                                colors="primary:#109173,secondary:#109173"
                                >
                            </lord-icon>
                        </div>
                    </div>

                        {{-- <div class="stat-card d-flex w-fit-content shadow-lg overflow-hidden border border-primary rounded">
                        <div class="stat-card-content d-flex flex-column">
                            <div class="stat-card-header bg-secondary text-primary border-bottom border-primary p-2 px-5">
                                <h3>Viste</h3>
                            </div>
                            <div class="stat-card-value bg-primary text-center py-2">
                                <h3 class="mb-0">125</h3>
                            </div>
                        </div>
                        <div class="stat-card-icon d-flex align-items-center shadow-lg bg-white px-2">
                            <lord-icon
                                src="https://cdn.lordicon.com/tyounuzx.json"
                                trigger="loop-on-hover"
                                style="width:60px;height:60px"
                                colors="primary:#4d1803,secondary:#c7ef00"
                                >
                            </lord-icon>
                        </div>
                    </div> --}}

                        <div class="stat-card d-flex w-fit-content shadow-lg overflow-hidden border border-primary rounded">
                        <div class="stat-card-content d-flex flex-column">
                            <div class="stat-card-header bg-secondary text-primary border-bottom border-primary p-2 px-5">
                                <h3>Sponsorizzati</h3>
                            </div>
                            <div class="stat-card-value bg-primary text-center py-2">
                                <h3 class="mb-0 text-white">{{Auth::user()->apartments()->has('sponsors')->count()}}</h3>
                            </div>
                        </div>
                        <div class="stat-card-icon d-flex align-items-center shadow-lg bg-white px-2">
                            <lord-icon
                                src="https://cdn.lordicon.com/rgyftmhc.json"
                                trigger="loop-on-hover"
                                style="width:60px;height:60px"
                                colors="primary:#109173,secondary:#109173"
                                >
                            </lord-icon>
                        </div>
                    </div>

                        {{-- <div class="stat-card d-flex w-fit-content shadow-lg overflow-hidden border border-primary rounded">
                        <div class="stat-card-content d-flex flex-column">
                            <div class="stat-card-header bg-secondary text-primary border-bottom border-primary p-2 px-5">
                                <h3>Punteggio</h3>
                            </div>
                            <div class="stat-card-value bg-primary text-center py-2">
                                <h3 class="mb-0">6</h3>
                            </div>
                        </div>
                        <div class="stat-card-icon d-flex align-items-center shadow-lg bg-white px-2">
                            <lord-icon
                                src="https://cdn.lordicon.com/mdgrhyca.json"
                                trigger="loop-on-hover"
                                style="width:60px;height:60px"
                                colors="primary:#4d1803,secondary:#c7ef00"
                                >
                            </lord-icon>
                        </div>
                    </div> --}}

                    </div>

            </div>
        </div>
        <div class="row bg-info bg-wave py-3 mx-sm-1 mx-md-5 rounded shadow-lg mt-lg-5">
            <div class="col-10 offset-1 col-lg-6 offset-lg-0">
                <div id="map-div" class="rounded shadow-lg map"></div>
            </div>
            <div class="col-10 offset-1 col-lg-5 offset-lg-1 mt-3 mt-lg-0">
                <div class="d-flex flex-column h-100 p-4 white-overlay rounded shadow-lg">
                    <h3 class="border-bottom border-secondary card-title bg-secondary text-primary rounded shadow-lg py-2 text-center">I tuoi dati</h3>
                    <h5 class="border-bottom border-secondary py-2"><strong class="text-primary">Nome</strong>: {{Auth::user()->name}}</h5>
                    <h5 class="border-bottom border-secondary py-2"><strong class="text-primary">Cognome</strong>: {{Auth::user()->surname}}</h5>
                    <h5 class="border-bottom border-secondary py-2"><strong class="text-primary">Email</strong>: {{Auth::user()->email}}</h5>
                    <h5 class="border-bottom border-secondary py-2"><strong class="text-primary">Data di nascita</strong>: {{Auth::user()->date_of_birth}}</h5>
                </div>
            </div>

    </div>

    <style>
        body, html { margin: 0; padding: 0; }
        #map-div { width: 100%; height: 50vh }
    </style>

    <script>
        const ITALY = {lng: 12.600207285834681, lat:42.010732416015614 };

        const API_KEY = 'onx0t6tyRKJCe8Q2JIAWTMwu3Opxi7wH';
        const APPLICATION_NAME = 'bookie_sloth';
        const APPLICATION_VERSION = '1.0';

        tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);
        var map = tt.map({
        key: API_KEY,
        container: 'map-div',
        center: ITALY,
        zoom: 5});

        const apartments = <?php echo json_encode(Auth::user()->apartments, JSON_HEX_TAG); ?>;

        apartments.forEach(apartment => {

            var popup = new tt.Popup()
            .setHTML(`  <div class="row justify-content-center">
                        <div class="col-12 mb-3"><img src="storage/${apartment["cover_img"]}" style="width:100%; height:100px" /></div>
                        <div>
                            <h5>${apartment["name"]}</h5>
                            <p>${apartment["address"]}</p>
                            <p class="m-0">${apartment["cap"]}</p>
                            <p class="m-0"><strong>${apartment["location"]}</strong></p>
                        </div>
                        </div>`)

            new tt.Marker()
            .setLngLat([apartment["x_coordinate"], apartment["y_coordinate"]])
            .setPopup(popup)
            .addTo(map)
        });

    </script>

@endsection

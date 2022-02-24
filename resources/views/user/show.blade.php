@extends('layouts.user')

@section('content')
    <div class="row row-cols-4 m-3">
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
        </div>

        <div class="col-8 mt-3">
            <div id="map-div"></div>
        </div>
        <div class="col-4 mt-3">
            <div class="card mb-3 h-100">
                <div class="row g-0">
                    <div class="col-8">
                        <div class="card-body">
                            <h4 class="card-title mb-3">I tuoi dati</h4>
                            <h5><strong>Nome</strong>: {{Auth::user()->name}}</h5>
                            <h5><strong>Cognome</strong>: {{Auth::user()->surname}}</h5>
                            <h5><strong>Email</strong>: {{Auth::user()->email}}</h5>
                            <h5><strong>Data di nascita</strong>: {{Auth::user()->date_of_birth}}</h5>

                            <h2 class="text-danger">Da cambiare con statistiche utente(?)</h2>
                        </div>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-center">
                    </div>
                </div>
            </div>
        </div>

        
    </div>
    
    <style>
        body, html { margin: 0; padding: 0; }
        #map-div { width: 100%; height: 700px; }
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
@extends('layouts.user')

@section('content')
<div class="container-fluid h-100">
    <div class="row flex-shrink-0 h-100 align-items-center">
        <div class="col-10 offset-1">
            <div class="badges-container d-flex flex-wrap justify-content-center justify-content-lg-between">
                @foreach($sponsors as $sponsor)
                @if($sponsor->id !== 1)         
                <div class="badge d-flex flex-column bg-primary rounded shadow-lg py-5 sponsor-{{$sponsor->id}} active" style="transition:filter 0.3s">
                    <img src="/images/{{$sponsor->level}}_badge.svg" alt="{{$sponsor->level}} badge" class="w-75 d-block mx-auto">
                    <h2 class="text-white mt-5">{{ucfirst($sponsor->level)}}</h2>
                    <div class="d-flex align-items-center justify-content-around">
                        <div>
                            <h5 class="mb-0 bg-info text-dark shadow-lg rounded p-2">{{$sponsor->duration}}h</h5>
                        </div>
                        
                    </div>
                    <div class="mt-5 bg-info p-3">
                        <h6 class="mb-0 text-wrap fw-normal text-dark">Vantaggi: i tuoi appartamenti verranno visualizzati per primi dagli utenti</h6>
                    </div>
                    <div class="d-flex mt-5 justify-content-around align-items-center">
                        <div class="input-group w-50 shadow-lg rounded">
                            <span class="input-group-text bg-secondary text-primary border-secondary">$</span>
                            <input type="text" class="form-control bg-info text-white text-center border-secondary" id="price-{{$sponsor->id}}" value="{{ $sponsor->price }}" disabled>
                            
                        </div>
                        <button class="btn btn-outline-secondary purchase-btn" value="{{ $sponsor->id }}">
                            Acquista
                        </button>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <form id='sponsorForm' action="{{route('user.sponsors.store', $apartment->id)}}" method="post">
                @csrf
                <input type="hidden" id="sponsor" name="sponsor" value="0">

            </form>
            <div id="dropin-container" style="opacity:0; transition: opacity 0.6s; display:none"></div>
            <button id="submit-button" style="opacity:0; transition: opacity 0.6s; display:none" class="btn btn-primary text-secondary">Acquista</button>
        </div>

       
        
        
        <script>
        var price;
        const buttons = document.querySelectorAll('.purchase-btn')
        buttons.forEach( button => { button.addEventListener('click', function() {
                document.getElementById('dropin-container').style.display = "block";
                document.getElementById('submit-button').style.display = "block";
                setTimeout(() => {
                    document.getElementById('dropin-container').style.opacity = "100%";
                    document.getElementById('submit-button').style.opacity = "100%";
                }, 200);
                document.getElementById('sponsor').value = button.value;
                price=document.getElementById('price-'+ button.value).value;
                let card = ".sponsor-" + button.value;
                for(let i=0; i<buttons.length; i++){
                    let currentCard = document.querySelector(`.sponsor-${i+2}`);
                    currentCard.classList.remove('active');
                    currentCard.classList.add('unactive');
                }
                document.querySelector(card).classList.remove('unactive');
                document.querySelector(card).classList.add('active');
            }) });

        var button = document.querySelector('#submit-button');
        braintree.dropin.create({
            authorization: "{{ 'sandbox_x6gbkvj7_dw85tnr9p5v7xt7n' }}",
            container: '#dropin-container'
            }, function (createErr, instance) {
            button.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {
            $.get('{{ route('payment.make') }}', {payload,price}, function (response) {
            if (response.success) {
            document.getElementById('sponsorForm').submit();
            } else {
            alert('Payment failed');
            }
            }, 'json');
            });
            });
        });

        
        </script>

    </body>
</div>
@endsection

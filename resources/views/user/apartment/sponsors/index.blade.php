@extends('layouts.user')

@section('content')
<div class="container-fluid h-100 position-relative">
    <div class="row flex-shrink-0 h-100 align-items-center">
        <div class="col-10 offset-1">
            <div class="badges-container d-flex flex-wrap justify-content-center justify-content-lg-between">
                @foreach($sponsors as $sponsor)
                @if($sponsor->id !== 1)         
                <div class="badge d-flex flex-column bg-primary shadow-lg py-5 sponsor-{{$sponsor->id}} active" style="transition:filter 0.3s;border-radius:10px">
                    <img src="/images/{{$sponsor->level}}_badge.svg" alt="{{$sponsor->level}} badge" class="w-75 d-block mx-auto">
                    <h2 class="text-white mt-5">{{ucfirst($sponsor->level)}}</h2>
                    <div class="d-flex align-items-center justify-content-around">
                        <div>
                            <h5 class="mb-0 bg-info text-dark shadow-lg rounded p-2">{{$sponsor->duration}}h</h5>
                        </div>
                        
                    </div>
                    <div class="mt-5 bg-info p-3">
                        <h6 class="mb-0 text-wrap fw-normal text-dark">Vantaggi: i tuoi appartamenti verranno visualizzati per primi dagli utenti</h6>
                        @if ($sponsor->id === 3)
                        <h6>(anche prima dei bronze)</h6>
                        @elseif ($sponsor->id === 4)
                        <h6>(anche prima dei bronze e dei silver)</h6>
                        @elseif ($sponsor->id === 2)
                        <h6 class="text-primary">(anche prima dei bronze e dei silver)</h6>
                        @endif

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
            
            <div class="position-absolute" style="top:0; left:0; bottom:0; right:0; display:none; transition:background 0.6s; background:rgba(0,0,0,0)" id="paymentOverlay">
                    <div id="dropin-container" style="opacity:0; transition: opacity 0.6s; display:none; top:50%; left:50%; transform:translate(-50%,-50%); width:600px" class="position-absolute">
                    </div>
                <div>
                    <button id="submit-button" style="opacity:0; transition: opacity 0.6s; display:none; position: absolute; bottom:250px; left:45%; transform:translateX(-50%)" class="btn btn-primary text-secondary">Acquista</button>
                    <button id="close-button" style="opacity:0; transition: opacity 0.6s; display:none; position: absolute; bottom:250px; left:55%; transform:translateX(-50%)" class="btn btn-danger text-secondary">Annulla</button>
                </div>
            </div>
        </div>

       
        
        
        <script>
        var price;
        const buttons = document.querySelectorAll('.purchase-btn')
        buttons.forEach( button => { button.addEventListener('click', function() {
                document.getElementById('dropin-container').style.display = "block";
                document.getElementById('submit-button').style.display = "block";
                document.getElementById('close-button').style.display = "block";
                document.getElementById('paymentOverlay').style.display = "block";
                setTimeout(() => {
                    document.getElementById('paymentOverlay').style.background = "rgba(0,0,0,0.6)";
                    document.getElementById('dropin-container').style.opacity = "100%";
                    document.getElementById('submit-button').style.opacity = "100%";
                    document.getElementById('close-button').style.opacity = "100%";
                }, 200);
                document.getElementById('sponsor').value = button.value;
                price=document.getElementById('price-'+ button.value).value;

                document.getElementById('close-button').addEventListener('click', function(){
                    document.getElementById('paymentOverlay').style.background = "rgba(0,0,0,0)";
                    document.getElementById('dropin-container').style.opacity = "0";
                    document.getElementById('submit-button').style.opacity = "0";
                    document.getElementById('close-button').style.opacity = "0";

                    setTimeout(() => {
                    document.getElementById('paymentOverlay').style.display ="none";
                    document.getElementById('dropin-container').style.display="none";
                    document.getElementById('submit-button').style.display = "none";
                    document.getElementById('close-button').style.display = "none";
                }, 200);
                })


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

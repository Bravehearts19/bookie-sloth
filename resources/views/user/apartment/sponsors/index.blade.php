@extends('layouts.user')

@section('content')
<div class="container-fluid h-100">
    <div class="row flex-shrink-0 h-100 align-items-center">
        <div class="col-10 offset-1">
            <div class="badges-container d-flex flex-wrap justify-content-center justify-content-lg-between">
                @foreach($sponsors as $sponsor)
                @if($sponsor->id !== 1)         
                <div class="badge d-flex flex-column bg-primary rounded shadow-lg py-5 sponsor-{{$sponsor->id}} unactive" style="transition:filter 0.3s">
                    <img src="/images/{{$sponsor->level}}_badge.svg" alt="{{$sponsor->level}} badge" class="w-75 d-block mx-auto">
                    <h2 class="text-dark mt-5">{{$sponsor->level}}</h2>
                    <div class="d-flex align-items-center justify-content-around">
                        <div>
                            <h5 class="mb-0 bg-info text-dark shadow-lg rounded p-2">{{$sponsor->duration}}h</h5>
                        </div>
                        <div class="progress w-75 bg-info shadow-lg">
                            <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" style="width: 33.33%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mt-5 bg-info p-3">
                        <h6 class="mb-0 text-wrap fw-normal text-dark">Vantages: your apartments will appear first in customers feed</h6>
                    </div>
                    <div class="d-flex mt-5 justify-content-around align-items-center">
                        <div class="input-group w-50 shadow-lg rounded">
                            <span class="input-group-text bg-secondary text-white border-secondary">$</span>
                            <input type="text" class="form-control bg-info text-dark text-center border-secondary" value="{{ $sponsor->price }}" disabled>
                            
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
                <input type="hidden" id="sponsor" name="sponsor">

            </form>
            <div id="dropin-container"></div>
            <button id="submit-button">Request payment method</button>
        </div>

       
        
        
        <script>
            function upTo(el, tagName) {
                tagName = tagName.toLowerCase();

                while (el && el.parentNode) {
                    el = el.parentNode;
                    if (el.tagName && el.tagName.toLowerCase() == tagName) {
                    return el;
                    }
                }
                return null;
                }
        const buttons = document.querySelectorAll('.purchase-btn')
        buttons.forEach( button => { button.addEventListener('click', function() {
                document.getElementById('sponsor').value = button.value; 
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
            $.get('{{ route('payment.make') }}', {payload}, function (response) {
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

@extends('layouts.user')

@section('content')
<div class="container-fluid h-100">
    <div class="row flex-shrink-0 h-100 align-items-center">
        <div class="col-10 offset-1">
            <div class="badges-container d-flex flex-wrap justify-content-center justify-content-lg-between">
                <div class="badge d-flex flex-column bg-primary rounded shadow-lg py-5">
                    <img src="/images/bronze_badge.svg" alt="bronze badge" class="w-75 d-block mx-auto">
                    <h2 class="text-dark mt-5">Bronze</h2>
                    <div class="d-flex align-items-center justify-content-around">
                        <div>
                            <h5 class="mb-0 bg-info text-dark shadow-lg rounded p-2">24h</h5>
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
                            <input type="text" class="form-control bg-info text-dark text-center border-secondary" value="4" disabled>
                            <span class="input-group-text bg-secondary text-white border-secondary">.99</span>
                        </div>
                        <button class="btn btn-outline-secondary">
                            Purchase
                        </button>
                    </div>
                </div>




                <div class="badge d-flex flex-column bg-primary rounded shadow-lg py-5 mt-5 mt-lg-0">
                    <img src="/images/silver_badge.svg" alt="silver badge" class="w-75 d-block mx-auto">
                    <h2 class="text-dark mt-5">Silver</h2>
                    <div class="d-flex align-items-center justify-content-around">
                        <div>
                            <h5 class="mb-0 bg-info text-dark shadow-lg rounded p-2">48h</h5>
                        </div>
                        <div class="progress w-75 bg-info shadow-lg">
                            <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" style="width: 66.66%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mt-5 bg-info p-3">
                        <h6 class="mb-0 text-wrap fw-normal text-dark">Vantages: your apartments will appear first (then bronze badge) in customers feed</h6>
                    </div>
                    <div class="d-flex mt-5 justify-content-around align-items-center">
                        <div class="input-group w-50 shadow-lg rounded">
                            <span class="input-group-text bg-secondary text-white border-secondary">$</span>
                            <input type="text" class="form-control bg-info text-dark text-center border-secondary" value="9" disabled>
                            <span class="input-group-text bg-secondary text-white border-secondary">.99</span>
                        </div>
                        <button class="btn btn-outline-secondary">
                            Purchase
                        </button>
                    </div>
                </div>



                <div class="badge d-flex flex-column bg-primary rounded shadow-lg py-5 mt-5 mt-lg-0">
                    <img src="/images/gold_badge.svg" alt="silver badge" class="w-75 d-block mx-auto">
                    <h2 class="text-dark mt-5">Gold</h2>
                    <div class="d-flex align-items-center justify-content-around">
                        <div>
                            <h5 class="mb-0 bg-info text-dark shadow-lg rounded p-2">72h</h5>
                        </div>
                        <div class="progress w-75 bg-info shadow-lg">
                            <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mt-5 bg-info p-3">
                        <h6 class="mb-0 text-wrap fw-normal text-dark">Vantages: your apartments will appear first (then bronze and badge) in customers feed</h6>
                    </div>
                    <div class="d-flex mt-5 justify-content-around align-items-center">
                        <div class="input-group w-50 shadow-lg rounded">
                            <span class="input-group-text bg-secondary text-white border-secondary">$</span>
                            <input type="text" class="form-control bg-info text-dark text-center border-secondary" value="14" disabled>
                            <span class="input-group-text bg-secondary text-white border-secondary">.99</span>
                        </div>
                        <button class="btn btn-outline-secondary">
                            Purchase
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
        <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div id="dropin-container"></div>
        <button id="submit-button">Request payment method</button>
        </div>
        </div>
        </div>
        <script>
        var button = document.querySelector('#submit-button');
        braintree.dropin.create({
        authorization: "sandbox_x6gbkvj7_dw85tnr9p5v7xt7n",
        container: '#dropin-container'
        }, function (createErr, instance) {
        button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
        $.get('{{ route('payment.make') }}', {payload}, function (response) {
        if (response.success) {
        alert('Payment successfull!');
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

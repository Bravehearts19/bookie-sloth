@extends('layouts.app')

@section('content')

<a href="/" class="py-3 border-none d-flex justify-content-center align-items-center bg-primary shadow-lg text-decoration-none text-black">
    <img src="/images/logo.svg" alt="slothel logo">
    <h1>Slothel</h1>
</a>

<div class="container container_login">
    <div class="login_card_positioning">
        <div class="card w-50">
            <div class="card-header">{{ __('Login') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input id="password" type="password" class="form-control @error('surname') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">
                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary text-secondary">Accedi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

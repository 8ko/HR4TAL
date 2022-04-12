@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-primary m-0 fw-bold">{{ __('Login') }}</div>
                <div class="card-body mt-3">
                    <div class="row mb-3">
                        <div class="text-primary text-lg m-0 fw-bold text-center">WELCOME</div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-8">
                                <label for="email" class="col-md-4 col-form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="row mb-1 justify-content-center">
                            <div class="col-md-8">
                                <label for="email" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="text-center">
                                <div class="mb-3">
                                    <input class="form-check-input form-check-input-sm" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        <small>{{ __('Remember Me') }}</small>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-3 d-flex justify-content-center width-auto">
                            <div class="col-md-10">
                                <img class="img-fluid" src="{{ asset('assets/img/businessmeeting.png') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

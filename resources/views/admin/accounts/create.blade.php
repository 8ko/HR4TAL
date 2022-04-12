@extends('layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
    @include('layouts.flash-messages')
        <div class="card">
            <div class="card-header text-primary m-0 fw-bold">{{ __('Account Creation') }}</div>

            <div class="card-body d-flex justify-content-center">
                <form method="POST" action="{{ route('admin.accounts.store') }}">
                    @csrf

                    <div class="row my-3">
                        <label for="user_level" class="col-md-4 col-form-label text-md-end">{{ __('User Level') }}</label>

                        <div class="col-md-6">
                        <select class="custom-select-lg form-select @error('employee_id') is-invalid @enderror" id="user_level" name="user_level" value="{{ old('user_level') }}" required autocomplete="user_levelssssss" autofocus>
                            <option value="admin">Administrator</option>
                            <option value="engr">Engineer</option>
                            <option value="hr">Human Resource</option>
                            <option selected value="user">Employee</option>
                        </select>

                            @error('user_level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="employee_id" class="col-md-4 col-form-label text-md-end">{{ __('Employee ID') }}</label>

                        <div class="col-md-6">
                            <input id="employee_id" type="number" class="form-control @error('employee_id') is-invalid @enderror" name="employee_id" value="{{ old('employee_id') }}" required autocomplete="employee_id" autofocus>

                            @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                        <div class="col-md-6">
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input data-bs-toggle="tooltip" title="Copied!"
                                    id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="domain"
                                    style="border-top-left-radius: 0rem; border-bottom-left-radius: 0rem;">
                                    @roc.ph</span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                            <input data-bs-toggle="tooltip" title="Copied!"
                                id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            <button id="generate" type="button" class="btn btn-outline-success">Generate</button>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-center my-2">
                            <button type="submit" class="btn btn-primary ">
                                {{ __('Create Account') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $( document ).ready(function() {

        const $tooltip = $('[data-toggle="tooltip"]');
        $tooltip.tooltip({
        html: true,
        trigger: 'click',
        animation: true,
        placement: 'top',
        });

        $( "#generate" ).click(function() {
            // console.log("puwit");
            var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var passwordLength = 12;
            var password = "";
            for (var i = 0; i <= passwordLength; i++) {
                var randomNumber = Math.floor(Math.random() * chars.length);
                password += chars.substring(randomNumber, randomNumber +1);
            }
            $( "#password" ).val(password);
        });

        $( "#password" ).click(function(e) {
            e.preventDefault();
            password.select();
            navigator.clipboard.writeText(password.value);
            // alert("Copied password: " + password.value);
            if($('#password').val()){
                $('#password').tooltip('show');
                setTimeout(function() {
                    $('#password').tooltip('dispose');
                }, 1000);
            }
            
        });

        $( "#email" ).click(function(e) {
            e.preventDefault();
            
            var org = $( "#domain").text();
            email.select();
            navigator.clipboard.writeText(email.value+org);
            if($('#email').val()){
                
                $('#email').tooltip('show');
                setTimeout(function() {
                    $('#email').tooltip('dispose');
                }, 1000);
            }
            
        });
        
    });
   
</script>
@endsection
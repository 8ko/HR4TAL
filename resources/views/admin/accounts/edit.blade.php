@extends('layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
    @include('layouts.flash-messages')
        <div class="card">
            <div class="card-header text-primary m-0 fw-bold">{{ __('Account Update') }}</div>

            <div class="card-body d-flex justify-content-center">
            
                    {{ Form::model($user,['admin.accounts.update','id'=>'frm_update']) }}
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="my-3 pb-3 d-flex justify-content-center">
                            <img class="rounded-circle" src="{{$user->avatar()}}" width="100" height="100" />
                    </div>
                    <div class="row my-3">
                        <label for="user_level" class="col-md-4 col-form-label text-md-end">{{ __('User Level') }}</label>

                        <div class="col-md-6">
                            {{
                                Form::select('user_level',array(
                                    'admin'     => 'Administrator',
                                    'engr'      => 'Engineer',
                                    'hr'        => 'Human Resource',
                                    'user'      => 'Employee',
                                    ),
                                    null,['class' => 'form-select rounded-1','id'=>'user_level','required'])
                            }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="employee_id" class="col-md-4 col-form-label text-md-end">{{ __('Employee ID') }}</label>

                        <div class="col-md-6">
                            {{ Form::text('employee_id',null,['class'=>'form-control','id'=>'employee_id','readonly']) }}
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
                            {{ Form::text('first_name',null,['class'=>'form-control','id'=>'first_name','required']) }}

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
                            {{ Form::text('last_name',null,['class'=>'form-control','id'=>'last_name','required']) }}
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
                            <div class="input-group">
                                <input data-toggle="tooltip" data-placement="top" data-html="true" title="Copied!"
                                    id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ str_replace('@roc.ph','',$user->email) }}" required autocomplete="email">
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
                            {{ Form::text('password',null,['class'=>'form-control','id'=>'password', 'data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Copied!','required']) }}
                            <button id="generate" type="button" class="btn btn-outline-success">Generate</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-center my-2">
                            <button type="submit" class="btn btn-primary ">
                                {{ __('Update Account') }}
                            </button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>



<script>
    $( document ).ready(function() {
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

        $( "#password" ).click(function() {
            password.select();
            navigator.clipboard.writeText(password.value);
            // alert("Copied password: " + password.value);
            if($('#password').val()){
                $('#password').tooltip('toggle')
            }
            
        });

        $( "#email" ).click(function() {
            var org = $( "#domain").text();
            email.select();
            navigator.clipboard.writeText(email.value+org);
            // alert("Copied password: " + password.value);
            if($('#email').val()){
                $('#email').tooltip('toggle')
            }
            
        });
        
    });
   
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="section background-dark over-hide">
    <div class="form-center-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 col-sm-6">                            
                    <div class="input-form">
                        <h1 class="text-center">Register</h1>
                        {{-- @if(Session::has('success'))
                            <div class="alert-error text-center mt-4">{{Session::get('success')}}</div>
                        @endif --}}
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="input-field"> 
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <div class="alert-error text-center mt-4">
                                        <strong>*{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif                               
                            </div>

                            <div class="input-field">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <div class="alert-error text-center mt-4">
                                        <strong>*{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="input-field">
                                <label for="password" >{{ __('Password') }}</label>
                                <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <div class="alert-error text-center mt-4">
                                        <strong>*{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif                              
                            </div>

                            <div class="input-field">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password"  name="password_confirmation" required>
                            </div>

                            <div class="button-div text-center col-6  col-sm-4 col-lg-12">                                
                                <button type="submit" class="input-button">
                                    {{ __('Register') }}
                                </button>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="slideshow">
        <div class="slide">
            <figure class="slide__figure">
                <div class="slide__figure-inner">
                    <div class="slide__figure-img" style="background-image: url(./img/home-background.jpg)"></div>
                </div>
            </figure>
        </div>
    </div>
</div>
@endsection

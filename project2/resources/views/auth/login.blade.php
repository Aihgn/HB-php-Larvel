@extends('layouts.app')

@section('content')
    <div class="section background-dark over-hide">
        <div class="form-center-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-8 col-sm-6">                            
                        <div class="input-form">
                            <h1 class="text-center mb-4">Login</h1>
                            @if(Session::has('failed'))
                                <div class="alert-error text-center mt-4" id="login_failed">{{Session::get('failed')}}</div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                
                                <div class="input-field">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="input-field">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    
                                </div>

                                <div class="button-div text-center col-6  col-sm-4 col-lg-12 mb-4">
                                    <button type="submit" class="input-button">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div  class="text-center col-6 col-sm-4 col-lg-12 mb-3">
                                    <a class="account-help" href="{{ route('password.request') }}">Forgot password</a> |
                                    <a class="account-help" href="{{route('register')}}">Create a new account</a>
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

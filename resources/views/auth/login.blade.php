@extends('layouts.user_side_master')

@section('content')

<div class="main-content main-content-login">
    <div class="container">
        <div class="row">
           
        </div>
        <div class="row">
            <div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <div class="site-main">
                   
                    <div class="customer_login">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12" style="margin-left: 280px !important; margin-top: 50px !important;">
                                <div class="login-item">
                                    <h5 class="title-login">Login your Account</h5>

                    <form method="POST" action="{{ route('login') }}" class="login">
                        @csrf

                        <p class="form-row form-row-wide">
                            <label for="email" class="text">{{ __('Email Address') }}</label>

                            
                                <input id="email" type="email" title="Email" class="input-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </p>
                  

                        <p class="form-row form-row-wide">
                            <label for="password" class="text">{{ __('Password') }}</label>

                            
                                <input id="password" title="password" type="password" class="input-text @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </p>

                       

                        <p class="form-row">
                                <button type="submit" class="button-submit">
                                    {{ __('Login') }}
                                </button>

                               
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                        {{ __("Don't have an account create one ") }}
                                    </a>
                               
                         </p>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>



@endsection
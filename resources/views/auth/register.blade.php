@extends('layouts.user_side_master')

@section('content')

<div class="main-content main-content-login">
    <div class="container">
        <div class="row">
           
        </div>
        <div class="row">
            <div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="site-main">
                    
                    <div class="customer_login">
                        <div class="row">
                           
                            <div class="col-lg-6 col-md-6 col-sm-12" style="width: 70%;margin-left: 180px !important; margin-top: 50px !important; ">
                                <div class="login-item">
                                    <h5 class="title-login">Register now</h5>

                    <form method="POST" action="{{ route('register') }}" class="register">
                        @csrf

                      <p class="col-sm-6">
                            <label for="Fname" class="text">{{ __('First Name') }}</label>

                           
                                <input id="Fname" title="First Name" type="text" class="input-text @error('Fname') is-invalid @enderror" name="Fname" value="{{ old('Fname') }}" required autocomplete="Fname" autofocus>

                                @error('Fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                      </p>

                        <p class="col-sm-6">
                            <label for="Lname" class="text">{{ __('Last Name') }}</label>

                            
                                <input id="Lname" title="Last Name" type="text" class="input-text @error('Lname') is-invalid @enderror" name="Lname" value="{{ old('Lname') }}" required autocomplete="Lname" autofocus>

                                @error('Lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </p>

                        <p class="col-sm-6">
                            <label for="email" class="text">{{ __('Email Address') }}</label>

                            
                                <input id="email" title="Email Address" type="email" class="input-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </p>



                        <p class="col-sm-6">
                            <label for="mobile" class="text">{{ __('Mobile') }}</label>

                            
                                <input id="mobile" title="Mobile" type="text" class="input-text @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </p>



                        <p class="col-sm-6">
                            <label for="password" class="text">{{ __('Password') }}</label>

                            
                                <input id="password" title="Password" type="password" class="input-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </p>

                        <p class="col-sm-6">
                            <label for="password-confirm" class="text">{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" title="Confirm Password" type="password" class="input-text" name="password_confirmation" required autocomplete="new-password">
                           
                        </p>

                        <p class="form-row" style="margin-left: 15px;">
                                <button type="submit" class="button-submit">
                                    {{ __('Register') }}
                                </button>
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
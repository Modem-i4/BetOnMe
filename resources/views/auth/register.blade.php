@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="justify-content-center">
            <div class="col-md-3 d-inline-block"></div>
            <form class="col-md-6 d-inline-block" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="login-form h3">
                    <img src="/images/main-logo.png" style="margin-left: auto;margin-right: auto;display: block;">
                    <div style="text-align: center"></div>
                    <label>{{ __('other.name') }}</label>
                    <input  id="name" type="text" class="form-control h2 @error('name') is-invalid @enderror" name="name" value="{{ array("Джон Мур","Річард Таттерсалл","Левіафан Девіс","Фред Свинделл","П'єр Олер")[random_int(0,3)] }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <label>{{ __('other.email_address') }}</label>
                    <input id="email" type="email" class="form-control h2 @error('email') is-invalid @enderror" name="email" value="betty-{{ random_int(0,1000) }}@gmail.com" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label>{{ __('other.password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="password123">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label>{{ __('other.comfirmpass') }}</label>
                    <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" value="password123">
                    <input type="submit" value="{{__('other.register')}}" class="btn btn-block ui-input-btn mt-4" style="font-size: x-large">
                    <div class="mt-3"><a href="{{ route('login') }}" style="text-decoration: none; color: gray; text-align: center; display: block;" class="h5">{{__('other.login')}}</a></div>
                </div>
            </form>
        </div>
    </div>
@endsection

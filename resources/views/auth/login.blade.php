@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="col-md-3 d-inline-block"></div>
        <form class="col-md-6 d-inline-block" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="login-form h3">
                <img src="/images/main-logo.png" style="margin-left: auto;margin-right: auto;display: block;">
                <div style="text-align: center"></div>
                <label>Email</label>
                <input type="text" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control h2">
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <label>{{__('other.password')}}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror display-1" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <input type="submit" value="{{__('other.login')}}" class="btn btn-block ui-input-btn mt-4" style="font-size: x-large">
                <div class="mt-3"><a href="{{route('register')}}" style="text-decoration: none; color: gray; text-align: center; display: block;" class="h5">{{__('other.register')}}</a></div>
            </div>
        </form>
    </div>
</div>
@endsection

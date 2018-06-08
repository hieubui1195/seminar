@extends('layouts.auth')

@section('content')
    <h3>@lang('custom.title')</h3>
    <h4>@lang('custom.login')</h4>
    
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ Lang::get('custom.email') }}">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

        <input id="password" type="password" class="form-control" name="password" required placeholder="{{ Lang::get('custom.password') }}">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <div id="remember" class="checkbox">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('custom.remember_me')
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">@lang('custom.login')</button>
        <a class="btn btn-link forgot-password" href="{{ route('password.request') }}">
            @lang('custom.forgot_password')
        </a>
        <a class="btn btn-link" href="{{ route('welcome') }}">
            @lang('custom.back_home')
        </a>
        <a class="btn btn-link" href="{{ route('register') }}">
            @lang('custom.register')
        </a>
    </form>
@endsection

@extends('layouts.auth')

@section('content')
    <h3>@lang('custom.title')</h3>
    <form class="form-signin" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="{{ Lang::get('custom.name') }}">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif

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

        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{ Lang::get('custom.confirm_password') }}">

        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">
            @lang('custom.register')
        </button>
        <a class="btn btn-link" href="{{ route('welcome') }}">
            @lang('custom.back_home')
        </a>
        <a class="btn btn-link" href="{{ route('login') }}">
            @lang('custom.login')
        </a>
    </form>
@endsection

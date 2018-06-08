@extends('layouts.auth')

@section('content')
    <h3>@lang('custom.title')</h3>
    <h4>@lang('custom.Reset Password')</h4>

    <form class="form-signin" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">@lang('custom.email')</label>

            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="{{ Lang::get('custom.email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label">@lang('custom.password')</label>

            <input id="password" type="password" class="form-control" name="password" required placeholder="{{ Lang::get('custom.password') }}">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm" class="control-label">@lang('custom.confirm_password')</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{ Lang::get('custom.confirm_password') }}">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                @lang('custom.Reset Password')
            </button>
        </div>
    </form>
@endsection

@extends('layouts.auth')

@section('content')
    <h3>@lang('custom.title')</h3>
    <h4>@lang('custom.forgot_password')</h4>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-signin" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">@lang('custom.email')</label>

            <div class="">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="{{ Lang::get('custom.email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="">
                <button type="submit" class="btn btn-primary">
                    @lang('custom.Send Password Reset Link')
                </button>
            </div>
        </div>
    </form> 
@endsection

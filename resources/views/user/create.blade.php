@extends('layouts.app')

@section('style')
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">@lang('custom.seminar')</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">@lang('custom.home')</a><i class="fa fa-angle-right"></i>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('user.index') }}">@lang('custom.user')</a><i class="fa fa-angle-right"></i>
                </li>
                <li class="breadcrumb-item active">@lang('custom.create')</li>
            </ol>
        </div>
        <div class="col-md-7 align-self-center">
            <a href="{{ route('user.index') }}" class="btn btn-info pull-right">@lang('custom.back')</a>
        </div>
    </div>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'user.store', 'method' => 'POST', 'class' => 'form-horizontal col-md-8 offset-2']) !!}

                    <h2 class="form-title">@lang('custom.new_user')</h2>

                    {!! Form::hidden('formType', 'create') !!}
    
                        <div class="form-group row">
                            {!! Form::label('email', Lang::get('custom.email'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-8">
                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!}
                                @if($errors->first('email'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('name', Lang::get('custom.name'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-8">
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!}
                                @if($errors->first('name'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('level', Lang::get('custom.role'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-8">
                                {!! Form::select('level', ['1' => Lang::get('custom.user'), '2' => Lang::get('custom.admin')], 1, ['class' => 'form-control']) !!}
                                @if($errors->first('level'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-8 offset-4">
                            {!! Form::submit(Lang::get('custom.save'), ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('user.index') }}" class="btn btn-secondary">@lang('custom.back')</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script type="text/javascript">
    </script>
@endsection

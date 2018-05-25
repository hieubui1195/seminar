@extends('layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">@lang('custom.profile')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">@lang('custom.home')</a><i class="fa fa-angle-right"></i>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('user.index') }}">@lang('custom.user')</a><i class="fa fa-angle-right"></i>
            </li>
            <li class="breadcrumb-item active">@lang('custom.profile')</li>
        </ol>
    </div>
</div>

<div class="row card">
    <div class="col-md-8 offset-2">
        {!! Form::open(['route' => ['user.update', $user->id],
            'method' => 'PUT', 'class' => 'form-horizontal form-material',
            'enctype' => 'multipart/form-data', 'id' => 'form-update',
        ]) !!}

        {!! Form::hidden('formType', config('custom.update')) !!}

        {!! Form::hidden('userId', $user->id) !!}
        <h2 class="form-title">@lang('custom.edit_user')</h2>

        <div class="row">
            
            <div class="col-md-4">
                <div id="image-preview">
                    {!! Html::image(
                        config('custom.path_avatar') . $user->avatar,
                        'User Image',
                        [
                            'class' => 'img-responsive img-circle',
                        ]
                    ) !!}
                </div>

                {!! Form::file(
                    'avatar',
                    [
                        'id' => 'image',
                        'accept' => 'image/*',
                        'style' => 'display: none',
                    ]
                ) !!}
                {!! Form::button('Browse...', ['class' => 'btn btn-info', 'id' => 'choose-avatar']) !!}
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('name', Lang::get('custom.email'), ['class' => 'col-md-12']) !!}
                    <div class="col-md-12">
                        {!! Form::email(
                            'email',
                            old('email') ? old('email') : $user->email,
                            [
                                'class' => 'form-control form-control-line',
                                'placeholder' => Lang::get('custom.email'),
                                'disabled' => 'disabled',
                            ]
                        ) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name', Lang::get('custom.name'), ['class' => 'col-md-12']) !!}
                    <div class="col-md-12">
                        {!! Form::text(
                            'name',
                            old('name') ? old('name') : $user->name,
                            [
                                'class' => 'form-control form-control-line',
                                'placeholder' => Lang::get('custom.name'),
                                'required' => 'required',
                            ]
                        ) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name', Lang::get('custom.password'), ['class' => 'col-md-12']) !!}
                    <div class="col-md-12">
                        {!! Form::password(
                            'password',
                            [
                                'class' => 'form-control form-control-line',
                                'placeholder' => Lang::get('custom.password'),
                            ]
                        ) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', Lang::get('custom.confirm_password'), ['class' => 'col-md-12']) !!}
                    <div class="col-md-12">
                        {!! Form::password(
                            'password_confirmation',
                            [
                                'class' => 'form-control form-control-line',
                                'placeholder' => Lang::get('custom.confirm_password'),
                            ]
                        ) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('phone', Lang::get('custom.phone'), ['class' => 'col-md-12']) !!}
                    <div class="col-md-12">
                        {!! Form::text(
                            'phone',
                            old('phone') ? old('phone') : $user->phone,
                            [
                                'class' => 'form-control form-control-line',
                                'placeholder' => Lang::get('custom.phone'),
                                'required' => 'required',
                            ]
                        ) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::submit(Lang::get('custom.save'), ['id' => 'btn-update', 'class' => 'btn btn-primary']) !!}
                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary">@lang('custom.back')</a>
                </div>
            </div>
        </div>
        
        {!! Form::close() !!}
    </div>
</div>

@endsection

@section('script')
    {{ Html::script('js/app.js') }}
@endsection

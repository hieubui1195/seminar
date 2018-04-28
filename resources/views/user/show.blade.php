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
    @if (Auth::id() == $user->id)
        <div class="col-md-7 align-self-center">
            {!! Form::button(
                Lang::get('custom.update_profile'),
                [
                    'class' => 'btn waves-effect waves-light btn-info pull-right hidden-sm-down',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal-update'
                ]
            ) !!}
        </div>
    @endif
</div>

<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open([
                'route' => [
                    'user.update',
                    $user->id
                ],
                'method' => 'PUT',
                'class' => 'form-horizontal form-material',
                'enctype' => 'multipart/form-data',
                'id' => 'form-update',
            ]) !!}

            {!! Form::hidden('formType', config('custom.update')) !!}

            {!! Form::hidden('userId', $user->id) !!}

                <div class="modal-header">
                    <h5 class="modal-title">@lang('custom.update_profile')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
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
                                        'required' => 'required',
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
                                        'required' => 'required',
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
                    </div>

                </div>
                <div class="modal-footer">
                    {!! Form::button(Lang::get('custom.save'), ['id' => 'btn-update', 'class' => 'btn btn-primary']) !!}
                    {!! Form::button(Lang::get('custom.close'), ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="row" id="profile-content">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> {!! Html::image(config('custom.path_avatar') . $user->avatar, 'User image', ['class' => 'img-circle', 'width' => '150']) !!}
                    <h4 class="card-title m-t-10 profile-title">{{ $user->name }}</h4>
                    <h6>
                        @if ($user->level == config('custom.admin'))
                            @lang('custom.admin')
                        @else
                            @lang('custom.user')
                        @endif
                    </h6>
                </center>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Tab panes -->
            <div class="card-body">
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>@lang('custom.name')</dt>
                        <dd class="profile-name">{{ $user->name }}</dd>
                        <dt>@lang('custom.email')</dt>
                        <dd>{{ $user->email }}</dd>
                        <dt>@lang('custom.phone')</dt>
                        <dd class="profile-phone">{{ $user->phone }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
@endsection

@section('script')
    {!! Html::script('js/user.js') !!}
    <script type="text/javascript">
        var user = new user();
        user.init();

    </script>
@endsection
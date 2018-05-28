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
            <a href="{{ route('user.edit', Auth::id()) }}" class="btn waves-effect waves-light btn-success pull-right hidden-sm-down">
                @lang('custom.update_profile')
            </a>
        </div>
    @else
    <div class="col-md-7 align-self-center">
        <a href="/user/video/{{ $user->id }}?caller={{ Auth::id() }}&receiver={{ $user->id }}" class="btn waves-effect waves-light btn-info pull-right hidden-sm-down">
            <i class="fa fa-phone"></i>
        </a>
    </div>
    @endif
</div>

<div class="row" id="profile-content">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> {!! Html::image(config('custom.path_avatar') . $user->avatar, 'User image', ['class' => 'img-circle user-profile', 'width' => '150']) !!}
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
                    @if (session('msg'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>{{ session('msg') }}</strong>
                        </div>
                    @endif
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
    {{ Html::script('js/app.js') }}
    {!! Html::script('js/user.js') !!}
@endsection
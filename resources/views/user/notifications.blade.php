@extends('layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">@lang('custom.user')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('custom.home')</a><i class="fa fa-angle-right"></i></li>
            <li class="breadcrumb-item active">@lang('custom.notifications')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card card-body mailbox">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="card-title" style="float: left;">@lang('custom.notifications')</h5>
                    </div>
                    <div class="col-sm-6">
                        <a class="card-title" id="marked-all" style="float: right;" data-id={{ Auth::id() }}>@lang('custom.marked_all')</a>
                    </div>
                </div>
                
                <div class="message-center ps ps--theme_default ps--active-y" id="notification-list">
                    @include('partials.notifications', ['notifications' => $notifications])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    {{ Html::script('js/notification.js') }}
@endsection

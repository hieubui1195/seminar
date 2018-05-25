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
    <!-- Column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card card-body mailbox">
                <h5 class="card-title">Notification</h5>
                <div class="message-center ps ps--theme_default ps--active-y">
                    @foreach ($notifications as $notification)
                        {{$notification['user_send']}}
                        <a href="#">
                            @if ($notification->notification_type == config('custom.call'))
                                <div class="btn btn-danger btn-circle"><i class="fa fa-phone"></i></div>
                                <div class="mail-contnet">
                                    <h5>{{ config('custom.call') }}</h5> 
                                <span class="mail-desc"></span> @lang('custom.noty_call_with', ['User' => $notification->user_send])<span class="time">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span> </div>
                            @elseif ($notification->notification_type == config('custom.seminar'))
                                <div class="btn btn-warning btn-circle"><i class="fa fa-comment"></i></div>
                                <div class="mail-contnet">
                                    <h5>{{ config('custom.seminar') }}</h5> 
                                <span class="mail-desc"></span> @lang('custom.noty_seminar', ['Seminar' => 'Hi'])<span class="time">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span> </div>
                            @endif
                                
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    {{ Html::script('js/app.js') }}
@endsection

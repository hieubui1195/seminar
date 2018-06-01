@extends('layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">@lang('custom.seminar')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">@lang('custom.home')</a><i class="fa fa-angle-right"></i>
            </li>
            <li class="breadcrumb-item active">@lang('custom.seminar')</li>
        </ol>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-4">
        <div class="card seminar-list">
            <div class="card-body">
                <ul class="list" id="hits">
                    @foreach ($seminars as $seminar)
                        <li class="clearfix {{ ($seminar->id == $id) ? 'current-seminar' : '' }}">
                            {!! Html::image(config('custom.path_avatar') . $seminar->user->avatar, 'Avatar', ['class' => 'img img-circle']) !!}
                            <div class="about">
                                <div class="name">
                                    <h4>
                                        {{ Html::linkRoute('seminar.show', $seminar->name, $seminar->id, ['class' => 'seminar-link', 'title' => Lang::get('custom.detail')]) }}
                                    </h4>
                                </div>
                                <div class="name">
                                    {{ Html::linkRoute('user.show', $seminar->user->name, $seminar->user->id, ['title' => Lang::get('custom.detail')]) }}
                                </div>
                                <div class="status">
                                    @if (\Carbon\Carbon::parse($seminar->start)->isFuture())
                                        <i class="fa fa-circle early"></i> @lang('custom.early')
                                    @elseif (\Carbon\Carbon::parse($seminar->end)->isPast())
                                        <i class="fa fa-circle offline"></i> @lang('custom.finished')
                                    @else
                                        <i class="fa fa-circle online"></i> @lang('custom.active')
                                    @endif
                                </div>
                            </div>
                            @if (($seminar->user_id == Auth::id()) || (Auth::user()->level == 2))
                                <div class="seminar-option">
                                    <a class="btn-edit-seminar" href="{{ route('seminar.edit', $seminar->id) }}" data-id="{{ $seminar->id }}" title="{{ Lang::get('custom.edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn-delete-seminar" href="{{ route('seminar.destroy', $seminar->id) }}" data-id="{{ $seminar->id }}" title="{{ Lang::get('custom.delete') }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card seminar-content">
            <div class="card-body">
                {!! Form::hidden('seminarId', $id) !!}
                {!! Form::hidden('userId', Auth::id()) !!}
                <div class="chat" id="chat">
                    <div class="chat-header clearfix">
                        {{ Html::image(config('custom.path_avatar') . $seminarUser->user->avatar, 'Avatar', ['class' => 'img img-circle'])}}
                        <div class="chat-about">
                            <div class="chat-with">{{ $seminarUser->name }}</div>
                            <div class="status">
                                @if (\Carbon\Carbon::parse($seminarUser->start)->isFuture())
                                    <i class="fa fa-circle early"></i> @lang('custom.early')
                                @elseif (\Carbon\Carbon::parse($seminarUser->end)->isPast())
                                    <i class="fa fa-circle offline"></i> @lang('custom.finished')
                                @else
                                    <i class="fa fa-circle online"></i> @lang('custom.active')
                                @endif
                            </div>
                            <div class="chat-num-messages">{{ $messages->count() }} @lang('custom.messages')</div>
                        </div>
                        <div class="chat-time">
                            <h5>
                                @lang('custom.from') {{ \Carbon\Carbon::parse($seminarUser->start)->format('d F\, Y H:i A') }}
                            </h5>
                            <h5>
                                @lang('custom.to') {{ \Carbon\Carbon::parse($seminarUser->end)->format('d F\, Y H:i A') }}
                            </h5>
                            <button type="button" class="btn btn-primary" id="btn-more-info">@lang('custom.more_info')</button>
                            
                        </div>
                    </div> 
                    @if ($checkValidation)
                        <div class="chat-history">
                            <ul>
                                @foreach ($messages as $message)
                                    <li class="clearfix">
                                        <div class="message-data {{ ($message->id == Auth::id()) ? 'align-right' : '' }}">
                                            <span class="message-data-time" >
                                                {{ $message->pivot->created_at }}
                                            </span> &nbsp; &nbsp;
                                            <span class="message-data-name" >
                                                {{ Html::linkRoute('user.show', $message->name, $message->id)}}
                                            </span> <i class="fa fa-circle {{ ($message->id == Auth::id()) ? 'me' : 'online' }}"></i>
                                        </div>
                                        <div class="message {{ ($message->id == Auth::id()) ? 'other-message float-right' : 'my-message' }}">
                                            {{ $message->pivot->message }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        
                        </div>

                        @if (\Carbon\Carbon::parse($seminarUser->end)->isPast() == false)
                            <div class="chat-message clearfix">
                                <textarea name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>
                                <button>@lang('custom.send')</button>

                            </div>
                        @else
                            <h3 class="text-center">@lang('custom.timeout')</h3>
                            @if ($checkPublished && $checkPublished != null)
                                <h3 style="text-align: center;">
                                    <a href="{{ route('seminar.report', $id) }}" class="btn btn-info">
                                        @lang('custom.show_report')
                                    </a>
                                </h3>
                            @elseif (Auth::id() == $seminarUser->user_id)
                                <center>
                                    <a href="{{ route('seminar.editor', $seminarUser->id) }}" class="btn btn-info">
                                        @lang('custom.get_editor')
                                    </a>
                                </center>
                            @endif
                        @endif
                    @else
                        <h3 style="text-align: center; padding: 20px;">
                            @lang('custom.non_valid')
                        </h3>
                        <div class="row">
                            <div  class="col-md-6 offset-md-3">
                                <form id="form-validate">
                                    <div class="form-group">
                                        <input type="text" id="input-code" placeholder="@lang('custom.placeholder_valid')" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info">@lang('custom.authentic')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="modal-seminar-info" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('custom.seminar_info')</h4>
                    <button class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-3">@lang('custom.seminar')</dt>
                        <dd class="col-sm-9">
                            <b>
                                {{ $seminarUser->name }}
                            </b>
                        </dd>

                        <dt class="col-sm-3">@lang('custom.chairman')</dt>
                        <dd class="col-sm-9">
                            <a href="{{ route('user.show', $seminarUser->user_id) }}" title="{{ Lang::get('custom.detail') }}">
                                {{ $seminarUser->user->name }}
                            </a>
                        </dd>

                        <dt class="col-sm-3">@lang('custom.description')</dt>
                        <dd class="col-sm-9">{{ $seminarUser->description }}</dd>

                        <dt class="col-sm-3">@lang('custom.from')</dt>
                        <dd class="col-sm-9">
                            {{ \Carbon\Carbon::parse($seminarUser->start)->format('d F\, Y H:i A') }}
                        </dd>

                        <dt class="col-sm-3">@lang('custom.to')</dt>
                        <dd class="col-sm-9">
                            {{ \Carbon\Carbon::parse($seminarUser->end)->format('d F\, Y H:i A') }}
                        </dd>

                        <dt class="col-sm-3">@lang('custom.members')</dt>
                        <dd class="col-sm-9">
                            <ul style="padding-left: 10px">
                                @foreach ($members as $member)
                                    <li>
                                        <a href="{{ route('user.show', $member->user->id) }}" title="{{ Lang::get('custom.detail') }}">
                                            {{ $member->user->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </dd>

                    </dl>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">@lang('custom.close')</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    {{ Html::script('js/seminar.js')}}
    </script>
@endsection

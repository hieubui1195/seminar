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
            <div class="card-title">
                <div class="search">
                    {!! Form::open([
                        'method' => 'POST',
                        'id' => 'search-early',
                    ]) !!}
                        {!! Form::text('keySeminar', null, ['placeholder' => Lang::get('custom.search')]) !!}
                        <i class="fa fa-search"></i>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body">
                <ul class="list">
                    @foreach ($seminars as $element)
                        <li class="clearfix {{ ($element->id == $id) ? 'current-seminar' : '' }}">
                            {!! Html::image(config('custom.path_avatar') . $element->user->avatar, 'Avatar', ['class' => 'img img-circle']) !!}
                            <div class="about">
                                <div class="name">
                                    <h4>
                                        {{ Html::linkRoute(
                                            'seminar.show',
                                            $element->name,
                                            $element->id,
                                            [
                                                'class' => 'seminar-link',
                                                'title' => Lang::get('custom.detail'),
                                            ]
                                        ) }}
                                    </h4>
                                </div>
                                <div class="name">
                                    {{ Html::linkRoute('user.show', $element->user->name, $element->user->id, ['title' => Lang::get('custom.detail')]) }}
                                </div>
                                <div class="status">
                                    @if (\Carbon\Carbon::parse($element->start)->isFuture())
                                        <i class="fa fa-circle early"></i> @lang('custom.early')
                                    @elseif (\Carbon\Carbon::parse($element->end)->isPast())
                                        <i class="fa fa-circle offline"></i> @lang('custom.finished')
                                    @else
                                        <i class="fa fa-circle online"></i> @lang('custom.active')
                                    @endif
                                </div>
                            </div>
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
                        {{ Html::image(config('custom.path_avatar') . $seminarUser[0]->user->avatar, 'Avatar', ['width' => 55, 'height' => 55])}}
                        <div class="chat-about">
                            <div class="chat-with">{{ $seminarUser[0]->name }}</div>
                            <div class="status">
                                @if (\Carbon\Carbon::parse($seminarUser[0]->start)->isFuture())
                                    <i class="fa fa-circle early"></i> @lang('custom.early')
                                @elseif (\Carbon\Carbon::parse($seminarUser[0]->end)->isPast())
                                    <i class="fa fa-circle offline"></i> @lang('custom.finished')
                                @else
                                    <i class="fa fa-circle online"></i> @lang('custom.active')
                                @endif
                            </div>
                            <div class="chat-num-messages">{{ $messages->count() }} @lang('custom.messages')</div>
                        </div>
                        <div class="chat-time">
                            <h4>
                                @lang('custom.from') {{ \Carbon\Carbon::parse($seminarUser[0]->start)->format('d F\, Y H:i A') }}
                                <br>
                                @lang('custom.to') {{ \Carbon\Carbon::parse($seminarUser[0]->end)->format('d F\, Y H:i A') }}
                            </h4>
                            <button type="button" class="btn btn-primary" id="btn-more-info">@lang('custom.more_info')</button>
                            
                        </div>
                    </div> 
                  
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

                    @if (\Carbon\Carbon::parse($seminarUser[0]->end)->isPast() == false)
                        <div class="chat-message clearfix">
                            <textarea name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>
                                    
                            <i class="fa fa-file"></i> &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-file-image"></i>
                            
                            <button>Send</button>

                        </div>
                    @else
                        <h3 class="text-center">@lang('custom.timeout')</h3>
                        <a href="{{ route('seminar.report', $id) }}">@lang('custom.show_report')</a>
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
                                {{ $seminarUser[0]->name }}
                            </b>
                        </dd>

                        <dt class="col-sm-3">@lang('custom.chairman')</dt>
                        <dd class="col-sm-9">
                            <a href="{{ route('user.show', $seminarUser[0]->user_id) }}">
                                {{ $seminarUser[0]->user->name }}
                            </a>
                        </dd>

                        <dt class="col-sm-3">@lang('custom.description')</dt>
                        <dd class="col-sm-9">{{ $seminarUser[0]->description }}</dd>

                        <dt class="col-sm-3">@lang('custom.from')</dt>
                        <dd class="col-sm-9">
                            {{ \Carbon\Carbon::parse($seminarUser[0]->start)->format('d F\, Y H:i A') }}
                        </dd>

                        <dt class="col-sm-3">@lang('custom.to')</dt>
                        <dd class="col-sm-9">
                            {{ \Carbon\Carbon::parse($seminarUser[0]->end)->format('d F\, Y H:i A') }}
                        </dd>

                        <dt class="col-sm-3">@lang('custom.members')</dt>
                        <dd class="col-sm-9">
                            <ul style="padding-left: 10px">
                                @foreach ($members as $member)
                                    <li>
                                        <a href="{{ route('user.show', $member->user->id) }}">
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
    {!! Html::script('js/app.js') !!}
    {{ Html::script('js/seminar.js')}}
    <script type="text/javascript">
        var chatHistory = $('body .chat-history');
        chatHistory.scrollTop(chatHistory[0].scrollHeight);
    </script>
@endsection

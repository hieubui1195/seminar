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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-seminar-info">@lang('custom.more_info')</button>
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
                                            Content
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal">@lang('custom.close')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('script')
    {!! Html::script('js/app.js') !!}
    <script type="text/javascript">
        var seminar = function () {
            this.init = function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });

                this.addEvent();
                this.scrollTop();
                var seminarId = $('body input[name="seminarId"]').val();
                this.echo(seminarId);
            }

            this.addEvent = function() {
                var current = this;
                $('body').on('submit', '#form-create-seminar', function(event) {
                    event.preventDefault();
                    var formType = $('#modal-create input[name="formType"]').val(),
                        name = $('#modal-create input[name="name"]').val(),
                        chairman = $('#modal-create select[name="selectChairman"]').val(),
                        time = $('#modal-create input[name="time"]').val(),
                        description = $('#modal-create textarea[name="description"]').val(),
                        members = $('#modal-create select[name="members[]"]').val();

                    $('.text-danger').remove();
                    current.addSeminar(formType, name, chairman, description, time, members);
                });

                $('body').on('keyup', '#message-to-send', function(event) {
                    if (event.keyCode === 13) {
                        var seminarId = $('body input[name="seminarId"]').val(),
                            message = $('body #message-to-send').val();
                        
                        if (message.length != 0) {
                            current.sendMessage(seminarId, message);
                            current.scrollTop();
                        };
                    }
                });
            }

            this.addSeminar = function(formType, name, chairman, description, time, members) {
                $.ajax({
                    url: '/seminar',
                    type: 'POST',
                    data: {
                        formType: formType,
                        name: name,
                        chairman: chairman,
                        description: description,
                        time: time,
                        members: members
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        if (result.status == 1) {
                            $('#modal-create').modal('hide');
                            swal({
                                title: 'Success',
                                text: result.msg,
                                type: 'success',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value) {
                                    location.href("/seminar/" + id);
                                }
                            });
                        }
                    },
                    error: function(result)
                    {
                        var errors = JSON.parse(result.responseText);
                        if (errors.errors.name) {
                            var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.name + '</b>')
                            $('#modal-create input[name="name"]').after(message);
                        }

                        if (errors.errors.chairman) {
                            var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.chairman + '</b>')
                            $('#modal-create input[name="selectChairman"]').after(message);
                        }

                        if (errors.errors.time) {
                            var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.time + '</b>')
                            $('#modal-create input[name="time"]').after(message);
                        }

                        if (errors.errors.members) {
                            var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.members + '</b>')
                            $('#modal-create select[name="members[]"]').after(message);
                        }

                        if (errors.errors.description) {
                            var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.description + '</b>')
                            $('#modal-create input[name="description"]').after(message);
                        }
                    }
                });
            }

            this.sendMessage = function(seminarId, message) {
                var current = this,
                    userId = $('body input[name="userId"]');
                $.ajax({
                    url: '/message',
                    type: 'POST',
                    data: {
                        seminarId: seminarId,
                        message: message
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        if (result.status == 1) {
                            current.getMessage(result.id, userId);
                            $('body #message-to-send').val('');
                        }
                    },
                    error: function(result) {
                        console.log(result);
                    },
                    complete: function() {
                        var chatHistory = $('body .chat-history');
                        chatHistory.scrollTop(chatHistory[0].scrollHeight);
                    }
                });
            };

            this.scrollTop = function() {
                var chatHistory = $('body .chat-history');
                chatHistory.scrollTop(chatHistory[0].scrollHeight);
            };

            this.getMessage = function(messageId, currentUser) {
                var current = this;
                $.ajax({
                    url: '/message/' + messageId,
                    type: 'GET',
                    data: { messageId: messageId },
                    dataType: 'JSON',
                    success: function(result) {
                        console.log(result);
                        current.addMessageElement(currentUser, result);
                        current.scrollTop();
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });
            };

            this.addMessageElement = function(currentUser, message) {
                var element = '';
                if (message[0][0]['user_id'] != currentUser) {
                    element = '<li class="clearfix"><div class="message-data align-right">'
                                    + '<span class="message-data-time">' + message[0][0]['created_at'] + '</span> &nbsp; &nbsp;'
                                    + '<span class="message-data-name"><a href="/user/' + message[0][0]['user']['id'] + '">'
                                    + message[0][0]['user']['name'] + '</a></span> <i class="fa fa-circle me"></i></div>'
                                    + '<div class="message other-message float-right">' + message[0][0]['message'] + '</div></li>';
                    $('body .chat-history ul').append(element);
                } else {
                    element = '<li class="clearfix"><div class="message-data">'
                                    + '<span class="message-data-time">' + message[0][0]['created_at'] + '</span> &nbsp; &nbsp;'
                                    + '<span class="message-data-name"><a href="/user/' + message[0][0]['user']['id'] + '">'
                                    + message[0][0]['user']['name'] + '</a></span> <i class="fa fa-circle online"></i></div>'
                                    + '<div class="message my-message">' + message[0][0]['message'] + '</div></li>';
                    $('body .chat-history ul').append(element);
                }
            };

            this.echo = function (seminarId) {
                var current = this;
                const app = new Vue({
                    el: '#app',
                    created() {
                        Echo.private('message' + seminarId)
                            .listen('MessageSentEvent', (e) => {
                                console.log(e);
                                this.$forceUpdate();
                                var element = '<li class="clearfix"><div class="message-data">'
                                                + '<span class="message-data-time">' + e['message']['created_at'] + '</span> &nbsp; &nbsp;'
                                                + '<span class="message-data-name"><a href="/user/' + e['user']['id'] + '">'
                                                + e['user']['name'] + '</a></span> <i class="fa fa-circle online"></i></div>'
                                                + '<div class="message my-message">' + e['message']['message'] + '</div></li>';
                                $('body .chat-history ul').append(element);
                                current.scrollTop();
                            });
                    }
                });
            };
        }
        var seminar = new seminar();
        seminar.init();

        $(document).ready(function() {
            var chatHistory = $('body .chat-history');
            chatHistory.scrollTop(chatHistory[0].scrollHeight);
        })
    </script>
@endsection

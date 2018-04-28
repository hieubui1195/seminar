@extends('layouts.app')

@section('content')
    <div class="panel panel-primary" id="chat-box">
        @foreach ($messages as $message)
            <div class="panel-heading">
                <i class="fa fa-user" aria-hidden="true"></i> 
                {{ $message->user_id }}
            </div>
            <div class="box-chat">
                <div class="user">
                    <span class="message">{{ $message->message }}</span>
                    <br>
                    <span class="author-message"><b>Role</b></span>
                </div>
            </div>
        @endforeach
        <div class="panel-footer clearfix">
            {!! Form::open(['route' => 'message.store', 'method' => 'POST', 'id' => 'form-message']) !!}
            <div class="form-group">
                <div class="input-group">
                    {!! Form::text(
                        'message',
                        null,
                        [
                            'class' => 'form-control',
                            'id' => 'message-content',
                            'placeholder' => 'Type your message',
                            'required' => 'required',
                        ]
                    ) !!}

                    {!! Form::hidden('seminarId', 1) !!}
                    {!! Form::hidden('userId', Auth::id()) !!}
                    <div class="input-group-addon">
                        {!! Form::button('Send', ['id' => 'btn-send']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('script')
    {!! Html::script('assets/pusher-js/dist/web/pusher.min.js') !!}
    {!! Html::script('js/app.js') !!}
    {!! Html::script('js/chat.js') !!}

    <script type="text/javascript">
        var chat = new chat();
        chat.init();
    </script>
@endsection

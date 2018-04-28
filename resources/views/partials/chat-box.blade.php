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
        </div>
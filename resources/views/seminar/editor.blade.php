@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <textarea id="editor" style="text-align: justify;">
            @if ($report == null)
                <h2 style="text-align: center;">{{ $seminar->name }}</h2>
                <h3>@lang('custom.chairman'): <b>{{ $seminar->user->name }}</b></h3>
                <h3>@lang('custom.participants'):</h3>
                <ol>
                    @foreach ($participants as $participant)
                        <li>{{ $participant->user->name }}</li>
                    @endforeach
                </ol>
                @foreach ($messages as $message)
                    {!! $message->message !!}<br>
                @endforeach
            @else
                {!! $report !!}
            @endif
        </textarea>
        <div class="form-group" style="margin-top: 15px;">
            <button type="button" class="btn btn-success" id="btn-save-editor">@lang('custom.save')</button>
            <a href="{{ route('seminar.preview', $id) }}" class="btn btn-info" id="btn-preview-report" style="{{ $checkReported == true ? '' : 'display: none;' }}">
                @lang('custom.preview')
            </a>
            @if (Auth::id() == $seminar->user_id)
                <button type="button" class="btn btn-warning" id="btn-publish-report" style="{{ $checkReported == true ? '' : 'display: none;' }}">
                    @lang('custom.publish')
                </button>
            @endif
            <a href="{{ route('seminar.show', $id) }}" class="btn btn-danger">@lang('custom.back')</a>
            <input type="hidden" id="seminar-id" value="{{ $id }}">
        </div>
            
    </div>
</div>
@endsection

@section('script')
    {{ Html::script('bower/ckeditor/ckeditor.js') }}
    {{ Html::script('js/editor.js') }}
    {{ Html::script('js/saveEditor.js') }}
@endsection

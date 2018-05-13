@extends('layouts.app')

@section('style')
    {{ Html::style('bower/sweetalert2/dist/sweetalert2.min.css') }}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <textarea id="editor" style="text-align: justify;">
            @if ($report == null)
                <h2 style="text-align: center;">{{ $seminar->name }}</h2>
                @foreach ($messages as $element)
                    {!! $element->message !!}<br>
                @endforeach
            @else
                {!! $report !!}
            @endif
        </textarea>
        <div class="form-group" style="margin-top: 15px;">
            <button type="button" class="btn btn-success" id="btn-save-editor">@lang('custom.save')</button>
            @if (Auth::id() == $seminar->id)
                <button type="button" class="btn btn-info" id="btn-publish-report-file">@lang('custom.publish')</button>
            @endif
            <a href="{{ route('seminar.show', $id) }}" class="btn btn-warning">@lang('custom.back')</a>
            <input type="hidden" id="seminar-id" value="{{ $id }}">
        </div>
            
    </div>
</div>
@endsection

@section('script')
    {{ Html::script('bower/sweetalert2/dist/sweetalert2.min.js') }}
    {{ Html::script('bower/ckeditor/ckeditor.js') }}
    {{ Html::script('js/editor.js') }}
    {{ Html::script('js/saveEditor.js') }}
@endsection

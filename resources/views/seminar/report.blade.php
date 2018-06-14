@extends('layouts.app')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">@lang('custom.seminar')</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">@lang('custom.home')</a><i class="fa fa-angle-right"></i>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('seminar.show', $report->id) }}">@lang('custom.seminar')</a><i class="fa fa-angle-right"></i>
                </li>
                <li class="breadcrumb-item active">@lang('custom.report')</li>
            </ol>
        </div>
        <div class="col-md-7 align-self-center">
            <a href="{{ route('seminar.download', $report->id) }}" class="btn btn-info" style="float: right;">@lang('custom.download')</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="height: 430px; overflow-y: auto;">
                <div class="card-body">
                    <center>
                        <h3>
                            @lang('custom.report_of', ['seminar' => $seminar->name])
                        </h3>
                    </center>
                </div>
                <div class="card-body">
                    <article>
                        {!! $report->report !!}
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{ Html::script('js/app.js') }}
@endsection

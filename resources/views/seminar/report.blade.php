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
                    <a href="{{ route('seminar.show', $report[0]->id) }}">@lang('custom.seminar')</a><i class="fa fa-angle-right"></i>
                </li>
                <li class="breadcrumb-item active">@lang('custom.report')</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 style="float: left;">
                        @lang('custom.report_of', ['seminar' => $report[0]->name])
                    </h3>
                    <a href="" class="btn btn-info" style="float: right;">@lang('custom.download')</a>
                </div>
                <div class="card-body">
                    <article>
                        {!! $report[0]->report->report !!}
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection

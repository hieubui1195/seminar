@extends('layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">@lang('custom.dashboard')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('custom.home')</a><i class="fa fa-angle-right"></i></li>
            <li class="breadcrumb-item active">@lang('custom.dashboard')</li>
        </ol>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="pull-left">
                    <h5 class="card-title m-b-0">@lang('custom.seminar')</h5>
                </div>
                <div class="pull-right">
                    <a href="{{ route('seminar.show', $latestSeminar->id) }}">@lang('custom.more')</a>
                </div>
                <div class="table-responsive m-t-20">
                    <table class="table vm no-th-brd pro-of-month">
                        <thead>
                            <tr>
                                <th colspan="2">@lang('custom.name')</th>
                                <th>@lang('custom.chairman')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newSeminars as $seminar)
                                <tr>
                                    <td style="width:50px;"><span class="round">S</span></td>
                                    <td>
                                        <h6>
                                            <a href="{{ route('seminar.show', $seminar->id) }}" title="{{ Lang::get('custom.detail') }}">
                                                {{ $seminar->name }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($seminar->start)->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.show', $seminar->user->id) }}" title="{{ Lang::get('custom.detail') }}">
                                            {{ $seminar->user->name }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="pull-left">
                    <h5 class="card-title m-b-0">@lang('custom.report')</h5>
                </div>
                <div class="pull-right">
                    <a href="{{ route('report') }}">@lang('custom.more')</a>
                </div>
                <div class="table-responsive m-t-20">
                    <table class="table vm no-th-brd pro-of-month">
                        <thead>
                            <tr>
                                <th colspan="2">@lang('custom.report')</th>
                                <th>@lang('custom.Time')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newReports as $report)
                                <tr>
                                    <td style="width:50px;"><span class="round round-warning">R</span></td>
                                    <td>
                                        <h6>
                                            <a href="{{ route('report.preview', $report->report_id) }}">
                                                {{ $report->filename }}
                                            </a> 
                                        </h6>
                                        <small class="text-muted"></small>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($report->updated_at)->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">@lang('custom.report')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('custom.home')</a><i class="fa fa-angle-right"></i></li>
            <li class="breadcrumb-item active">@lang('custom.report')</li>
        </ol>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">@lang('custom.report')</h5>
                <ul class="feeds">
                    @foreach ($reports as $report)
                        @if ($report->report_type == config('custom.seminar'))
                            <li>
                                <div class="bg-light-info"><i class="fa fa-comment"></i></div> 
                        @else
                            <li>
                                <div class="bg-light-danger"><i class="fa fa-phone"></i></div> 
                        @endif
                            <a href="{{ route('report.preview', $report->id) }}">
                                {{ $report->filename }}
                            </a> 
                            <span style="color: black;">{{ \Carbon\Carbon::parse($report->updated_at)->diffForHumans() }}</span>
                        <li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

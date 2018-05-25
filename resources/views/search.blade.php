@extends('layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.7.4/dist/instantsearch.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}">
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">@lang('custom.search')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('custom.home')</a><i class="fa fa-angle-right"></i></li>
            <li class="breadcrumb-item active">@lang('custom.search')</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="card" style="width: 100%">
        <div class="card-body col-md-6 offset-3">
            <div id="search-box"></div>
            <div id="hits"></div>
            <div id="pagination"></div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.7.4"></script>
    <script src="{{ asset('js/search.js') }}"></script>
@endsection

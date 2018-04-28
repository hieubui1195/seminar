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
    <div class="col-md-7 align-self-center">
        {!! Form::button(
            Lang::get('custom.new_seminar'),
            [
                'class' => 'btn waves-effect waves-light btn-info pull-right hidden-sm-down',
                'data-toggle' => 'modal',
                'data-target' => '#exampleModal'
            ]
        ) !!}
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex no-block">
                    <div>
                        <h5 class="card-title m-b-0">Sales Chart</h5>
                    </div>
                    <div class="ml-auto">
                        <ul class="list-inline text-center font-12">
                            <li><i class="fa fa-circle text-success"></i> SITE A</li>
                            <li><i class="fa fa-circle text-info"></i> SITE B</li>
                            <li><i class="fa fa-circle text-primary"></i> SITE C</li>
                        </ul>
                    </div>
                </div>
                <div class="" id="sales-chart" style="height: 355px;"></div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex m-b-30 no-block">
                    <h5 class="card-title m-b-0 align-self-center">Our Visitors</h5>
                    <div class="ml-auto">
                        <select class="custom-select b-0">
                            <option selected="">Today</option>
                            <option value="1">Tomorrow</option>
                        </select>
                    </div>
                </div>
                <div id="visitor" style="height:260px; width:100%;"></div>
                <ul class="list-inline m-t-30 text-center font-12">
                    <li><i class="fa fa-circle text-purple"></i> Tablet</li>
                    <li><i class="fa fa-circle text-success"></i> Desktops</li>
                    <li><i class="fa fa-circle text-info"></i> Mobile</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

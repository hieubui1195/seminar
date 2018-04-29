@extends('layouts.app')

@section('style')
    {!! Html::style('assets/bootstrap-daterangepicker/daterangepicker.css') !!}
    {!! Html::style('assets/select2/dist/css/select2.min.css') !!}

    <style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #20aee3;
        }
    </style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">@lang('custom.seminar')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">@lang('custom.home')</a><i class="fa fa-angle-right"></i>
            </li>
            <li class="breadcrumb-item active">@lang('custom.seminar')</li>
        </ol>
    </div>
    <div class="col-md-7 align-self-center">
        {!! Form::button(
            Lang::get('custom.new_seminar'),
            [
                'class' => 'btn waves-effect waves-light btn-info pull-right hidden-sm-down',
                'data-toggle' => 'modal',
                'data-target' => '#modal-create'
            ]
        ) !!}
    </div>
</div>

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open([
                'route' => 'user.store',
                'method' => 'POST',
                'class' => 'form-horizontal',
                'id' => 'form-create-seminar',
            ]) !!}

                {!! Form::hidden('formType', 'create') !!}

                <div class="modal-header">
                    <h5 class="modal-title">@lang('custom.new_seminar')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row">
                        {!! Form::label(
                            'name',
                            Lang::get('custom.seminar_name'),
                            [
                                'class' => 'col-md-4 control-label'
                            ]
                        ) !!}

                        <div class="col-md-8">
                            {!! Form::text(
                                'name',
                                old('name'),
                                [
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'autofocus' => 'autofocus',
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label(
                            'chairman',
                            Lang::get('custom.chairman'),
                            [
                                'class' => 'col-md-4 control-label'
                            ]
                        ) !!}

                        <div class="col-md-8">
                            {!! Form::select(
                                'selectChairman',
                                $selectChairman,
                                Auth::id(),
                                [
                                    'id' => 'select-chairman',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'autofocus' => 'autofocus',
                                    'style' => 'width: 100%',
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label(
                            'time',
                            Lang::get('custom.time'),
                            [
                                'class' => 'col-md-4 control-label'
                            ]
                        ) !!}

                        <div class="col-md-8">
                            {!! Form::text(
                                'time',
                                old('time'),
                                [
                                    'class' => 'form-control pull-right',
                                    'placeholder' => Lang::get('custom.select_time'),
                                    'required' => 'required',
                                    'id' => 'time',
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label(
                            'members',
                            Lang::get('custom.members'),
                            [
                                'class' => 'col-md-4 control-label'
                            ]
                        ) !!}

                        <div class="col-md-8">
                            {!! Form::select(
                                'members[]',
                                $selectChairman,
                                [],
                                [
                                    'id' => 'select-members',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'autofocus' => 'autofocus',
                                    'multiple' => 'multiple',
                                    'style' => 'width: 100%',
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        {!! Form::label(
                            'description',
                            Lang::get('custom.description'),
                            [
                                'class' => 'col-md-4 control-label'
                            ]
                        ) !!}

                        <div class="col-md-8">
                            {!! Form::textarea(
                                'description',
                                old('description'),
                                [
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'autofocus' => 'autofocus',
                                    'rows' => '3',
                                ]
                            ) !!}
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    {!! Form::submit(Lang::get('custom.save'), ['class' => 'btn btn-primary']) !!}
                    {!! Form::button(Lang::get('custom.close'), ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-8">
        
    </div>
</div>
@endsection

@section('script')
    {!! Html::script('assets/moment/moment.js') !!}
    {!! Html::script('assets/bootstrap-daterangepicker/daterangepicker.js') !!}
    {!! Html::script('assets/select2/dist/js/select2.min.js') !!}
    {!! Html::script('js/script.js') !!}
    {!! Html::script('js/seminar.js') !!}
    <script type="text/javascript">
        var timerange = new timerange('#time');
        var selectChairman = new multiselect('#select-chairman');
        var multiselect = new multiselect('#select-members');

        var seminar = new seminar();
        seminar.init();
    </script>
@endsection

@extends('layouts.app')

@section('style')
    {{ Html::style('bower/select2/dist/css/select2.min.css') }}
    {{ Html::style('bower/bootstrap-daterangepicker/daterangepicker.css') }}

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
                <li class="breadcrumb-item">
                    <a href="{{ route('seminar.show', $seminar->id) }}">{{ $seminar->name }}</a><i class="fa fa-angle-right"></i>
                </li>
                <li class="breadcrumb-item active">@lang('custom.edit')</li>
            </ol>
        </div>
        <div class="col-md-7 align-self-center">
            <a href="{{ route('seminar.show', $seminar->id) }}" class="btn btn-info pull-right">@lang('custom.back')</a>
        </div>
    </div>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => ['seminar.update', $seminar->id], 'method' => 'PUT', 'class' => 'form-horizontal col-md-8 offset-md-2']) !!}

                        {!! Form::hidden('formType', 'update') !!}

                        <h2 class="form-title">@lang('custom.edit_seminar')</h2>

                        <div class="form-group row">
                            {!! Form::label('name', Lang::get('custom.seminar_name'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-8">
                                {!! Form::text('name', $seminar->name, ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!}
                                @if($errors->first('name'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('chairman', Lang::get('custom.chairman'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-8">
                                {!! Form::select('chairman', $users, $seminar->user_id,
                                ['id' => 'select-chairman', 'class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'style' => 'width: 100%'] ) !!}
                                @if($errors->first('chairman'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('chairman') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('time', Lang::get('custom.time'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-8">
                                {!! Form::text('time', null,
                                ['class' => 'form-control pull-right time', 'placeholder' => Lang::get('custom.select_time'), 'required' => 'required', 'id' => 'time']) !!}
                                @if($errors->first('time'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </p>
                                @endif
                                <input type="hidden" id="start-seminar" value="{{ $seminar->start }}">
                                <input type="hidden" id="end-seminar" value="{{ $seminar->end }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('members', Lang::get('custom.members'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-8">
                                {!! Form::select( 'members[]', $users, $participants,
                                    ['id' => 'select-members','class' => 'form-control','required' => 'required','autofocus' => 'autofocus','multiple' => 'multiple', 'style' => 'width: 100%']) !!}
                                    @if($errors->first('members'))
                                        <p class="text-danger">
                                            <strong>{{ $errors->first('members') }}</strong>
                                        </p>
                                    @endif                           
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('description', Lang::get('custom.description'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-8">
                                {!! Form::textarea('description', $seminar->description,
                                ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'rows' => '3']) !!}
                                @if($errors->first('description'))
                                    <p class="text-danger">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                {!! Form::submit(Lang::get('custom.save'), ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('seminar.show', $seminar->id) }}" class="btn btn-info">@lang('custom.cancel')</a>
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{ Html::script('bower/select2/dist/js/select2.min.js') }}
    {{ Html::script('bower/moment/moment.js') }}
    {{ Html::script('bower/bootstrap-daterangepicker/daterangepicker.js') }}

    <script type="text/javascript">
        $('select').select2();
        $('.time').daterangepicker({ 
            timePicker: true, 
            timePickerIncrement: 30, 
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            },
            startDate: $('#start-seminar').val(),
            endDate: $('#end-seminar').val(), 
            function(start, end, label) {
                swal("A new date range was chosen: " 
                    + start.format('YYYY-MM-DD HH:mm:ss') 
                    + ' to ' 
                    + end.format('YYYY-MM-DD HH:mm:ss'));
            }
        });
    </script>
@endsection

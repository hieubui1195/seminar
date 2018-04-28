@extends('layouts.app')

@section('style')
    {!! Html::style('assets/datatables.net-dt/css/jquery.dataTables.min.css') !!}
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">@lang('custom.user')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('custom.home')</a><i class="fa fa-angle-right"></i></li>
            <li class="breadcrumb-item active">@lang('custom.user')</li>
        </ol>
    </div>
    <div class="col-md-7 align-self-center">
        {!! Form::button(
            Lang::get('custom.new_user'),
            [
                'class' => 'btn waves-effect waves-light btn-info pull-right hidden-sm-down',
                'data-toggle' => 'modal',
                'data-target' => '#modal-create'
            ]
        ) !!}
    </div>
</div>

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {!! Form::open([
                'route' => 'user.store',
                'method' => 'POST',
                'class' => 'form-horizontal'
            ]) !!}

                <div class="modal-header">
                    <h5 class="modal-title">@lang('custom.new_user')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="email" class="col-md-4 control-label">@lang('custom.email')</label>

                        <div class="col-md-8">
                            {!! Form::email(
                                'email',
                                old('email'),
                                [
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'autofocus' => 'autofocus',
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 control-label">@lang('custom.name')</label>

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

                    <div class="form-group row {{ $errors->has('level') ? ' has-error' : '' }}">
                        <label for="level" class="col-md-4 control-label">@lang('custom.role')</label>

                        <div class="col-md-8">
                            {!! Form::select(
                                'level',
                                [
                                    '1' => Lang::get('custom.user'),
                                    '2' => Lang::get('custom.admin'),
                                ],
                                1,
                                [
                                    'class' => 'form-control',
                                ]
                            ) !!}
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    {!! Form::button(Lang::get('custom.save'), ['id' => 'btn-add', 'class' => 'btn btn-primary']) !!}
                    {!! Form::button(Lang::get('custom.close'), ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12">
        <div class="card">
            <table class="table table-bordered" id="table-users">
                @include('partials.users', ['users' => $users])
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    {!! Html::script('assets/datatables.net/js/jquery.dataTables.min.js') !!}
    {!! Html::script('js/script.js') !!}
    {!! Html::script('js/user.js') !!}
    <script type="text/javascript">
        var user = new user();
        user.init();

        var dataTable = new dataTable('#table-users');
    </script>
@endsection

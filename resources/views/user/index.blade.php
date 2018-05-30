@extends('layouts.app')

@section('style')
    {!! Html::style('bower/datatables.net-dt/css/jquery.dataTables.min.css') !!}
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
        <a href="{{ route('user.create') }}" class="btn waves-effect waves-light btn-info pull-right hidden-sm-down">@lang('custom.new_user')</a>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-12">
        @if (session('msg'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{{ session('msg') }}</strong>
            </div>
        @endif
        <div class="card">
            <table class="table table-bordered" id="table-users">
                @include('partials.users', ['users' => $users])
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    {!! Html::script('bower/datatables.net/js/jquery.dataTables.min.js') !!}
    {!! Html::script('js/user.js') !!}
    <script type="text/javascript">
        $('table').DataTable();
    </script>
@endsection

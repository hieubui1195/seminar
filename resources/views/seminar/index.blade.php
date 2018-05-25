@extends('layouts.app')

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
            <a href="{{ route('seminar.create') }}" class="btn waves-effect waves-light btn-info pull-right hidden-sm-down">
                @lang('custom.new_seminar')
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Column -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-title">
                    <h3 class="title-center title-active">
                        <i class="fa fa-circle"></i> @lang('custom.active')
                    </h3>
                    <div class="search">
                        {!! Form::open([
                            'method' => 'POST',
                            'id' => 'search-active',
                        ]) !!}
                            {!! Form::text('keyActive', null, ['placeholder' => Lang::get('custom.search')]) !!}
                            <i class="fa fa-search"></i>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list">
                        @foreach ($listActive as $element)
                            <li class="clearfix">
                                {!! Html::image(config('custom.path_avatar') . $element->user->avatar, 'Avatar', ['class' => 'img img-circle']) !!}
                                <div class="about">
                                    <div class="name">
                                        <h4>
                                            {{ Html::linkRoute(
                                                'seminar.show',
                                                $element->name,
                                                $element->id,
                                                [
                                                    'class' => 'seminar-link',
                                                    'title' => Lang::get('custom.detail'),
                                                ]
                                            ) }}
                                        </h4>
                                    </div>
                                    <div class="name">
                                        {{ Html::linkRoute('user.show', $element->user->name, $element->user->id, ['title' => Lang::get('custom.detail')]) }}
                                    </div>
                                </div>
                            </li>
                        @endforeach

                        @if ($countActive > 5)
                            <li class="clearfix">
                                {!! html_entity_decode(
                                    Html::link('', Lang::get('custom.more') . '<i class="fas fa-angle-double-right"></i>')
                                ) !!}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-title">
                    <h3 class="title-center title-early">
                        <i class="fa fa-circle"></i> @lang('custom.early')
                    </h3>
                    <div class="search">
                        {!! Form::open([
                            'method' => 'POST',
                            'id' => 'search-early',
                        ]) !!}
                            {!! Form::text('keyEarly', null, ['placeholder' => Lang::get('custom.search')]) !!}
                            <i class="fa fa-search"></i>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list">
                        @foreach ($listEarly as $element)
                            <li class="clearfix">
                                {!! Html::image(config('custom.path_avatar') . $element->user->avatar, 'Avatar', ['class' => 'img img-circle']) !!}
                                <div class="about">
                                    <div class="name">
                                        <h4>
                                            {{ Html::linkRoute(
                                                'seminar.show',
                                                $element->name,
                                                $element->id,
                                                [
                                                    'class' => 'seminar-link',
                                                    'title' => Lang::get('custom.detail'),
                                                ]
                                            ) }}
                                        </h4>
                                    </div>
                                    <div class="name">
                                        {{ Html::linkRoute('user.show', $element->user->name, $element->user->id, ['title' => Lang::get('custom.detail')]) }}
                                    </div>
                                </div>
                            </li>
                        @endforeach

                        @if ($countEarly > 5)
                            <li class="clearfix">
                                {!! html_entity_decode(
                                    Html::link('', Lang::get('custom.more') . '<i class="fas fa-angle-double-right"></i>')
                                ) !!}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-title">
                    <h3 class="title-center title-finished">
                        <i class="fa fa-circle"></i> @lang('custom.finished')
                    </h3>
                    <div class="search">
                        {!! Form::open([
                            'method' => 'POST',
                            'id' => 'search-finished',
                        ]) !!}
                            {!! Form::text('keyEarly', null, ['placeholder' => Lang::get('custom.search')]) !!}
                            <i class="fa fa-search"></i>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list">
                        @foreach ($listFinished as $element)
                            <li class="clearfix">
                                {!! Html::image(config('custom.path_avatar') . $element->user->avatar, 'Avatar', ['class' => 'img img-circle']) !!}
                                <div class="about">
                                    <div class="name">
                                        <h4>
                                            {{ Html::linkRoute(
                                                'seminar.show',
                                                $element->name,
                                                $element->id,
                                                [
                                                    'class' => 'seminar-link',
                                                    'title' => Lang::get('custom.detail'),
                                                ]
                                            ) }}
                                        </h4>
                                    </div>
                                    <div class="name">
                                        {{ Html::linkRoute('user.show', $element->user->name, $element->user->id, ['title' => Lang::get('custom.detail')]) }}
                                    </div>
                                </div>
                            </li>
                        @endforeach

                        @if ($countFinished > 5)
                            <li class="clearfix">
                                {!! html_entity_decode(
                                    Html::link('', Lang::get('custom.more') . '<i class="fas fa-angle-double-right"></i>')
                                ) !!}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{ Html::script('js/app.js') }}
    {!! Html::script('js/seminar-index.js') !!}
@endsection

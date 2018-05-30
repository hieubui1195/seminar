<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <title>@lang('custom.title')</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('bower/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/form.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="{{ asset('images/icon-avatar.png') }}" />

                @section('content')
                    @show
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('bower/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    </body>
</html>

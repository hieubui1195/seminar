<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@lang('custom.title')</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('bower/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('bower/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('bower/sweetalert2/dist/sweetalert2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/video.css') }}">
    </head>

    <body>
        <div id="app">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" id="current-user" value="{{ Auth::id() }}">
                    <input type="hidden" id="receiver-id" value="{{ $receiver->id }}">
                    <div class="box-videos">
                        <video id="friends-video" autoplay class="video-larger"></video>
                        <video id="your-video" autoplay muted class="video-smaller"></video>
                        <div id="btn-video">
                            <button type="button" id="btn-call" title="{{ Lang::get('custom.call') }}"><span class="fa fa-video"></span></button>
                            <button type="button" id=btn-finish title="{{ Lang::get('custom.finish') }}"><span class="fa fa-window-close"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <textarea id="editor""></textarea>
                </div>
                <div class="col-md-2">
                    <div class="box-button-report-call">
                        <button class="btn btn-info" id="btn-publish-report-call">@lang('custom.publish')</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="{{ asset('bower/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower/firebase/firebase.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower/ckeditor/ckeditor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/editor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/call.js') }}"></script>
        
    </body>
</html>
<!DOCTYPE html>
<html>
    @include('layouts.head')

    @section('style')
        @show

    <body class="fix-header fix-sidebar card-no-border">
        <div id="app">
            <div class="preloader">
                <div class="loader">
                    <div class="loader__figure"></div>
                    <p class="loader__label">Admin Wrap</p>
                </div>
            </div>
            <div id="main-wrapper">
                @include('layouts.header')

                @include('layouts.sidebar')

                <div class="page-wrapper">
                    <div class="container-fluid">
                        @section('content')
                            @show
                    </div>

                    @include('layouts.footer')
                </div>
            </div>
        </div>
        
        @include('layouts.script')
        @section('script')
            @show

    </body>
</html>

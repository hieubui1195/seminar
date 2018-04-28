<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('custom.title')</title>
    <!-- Bootstrap Core CSS -->
    {!! Html::style('assets/bootstrap/dist/css/bootstrap.min.css') !!}
    {{-- {!! Html::style('assets/perfect-scrollbar/css/perfect-scrollbar.css') !!} --}}
    {!! Html::style('assets/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') !!}
    <!-- chartist CSS -->
    {!! Html::style('assets/morris.js/morris.css') !!}
    <!--c3 CSS -->
    {!! Html::style('assets/c3/c3.min.css') !!}
    <!--iCheck -->
    {!! Html::style('assets/iCheck/skins/minimal/blue.css') !!}
    <!-- Sweetalert -->
    {!! Html::style('assets/sweetalert2/dist/sweetalert2.min.css') !!}
    <!-- Custom CSS -->
    {!! Html::style('assets/css/main.css') !!}
    <!-- Dashboard 1 Page CSS -->
    {!! Html::style('assets/css/pages/dashboard1.css') !!}
    <!-- You can change the theme colors from here -->
    {!! Html::style('assets/css/colors/default.css') !!}
    <!-- Custom style -->
    {!! Html::style('css/style.css') !!}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

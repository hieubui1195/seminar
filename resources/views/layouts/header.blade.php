<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <!-- Logo icon --><b>
                    <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                </b>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                <li class="nav-item hidden-xs-down search-box"> <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-search"></i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="fa fa-times"></i></a></form>
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (Auth::check())
                            {!! Html::image(config('custom.path_avatar') . Auth::user()->avatar, 'User') !!} <span class="hidden-md-down">{{ Auth::user()->name }} &nbsp;</span> </a>
                        @endif
                </li>
            </ul>
        </div>
    </nav>
</header>

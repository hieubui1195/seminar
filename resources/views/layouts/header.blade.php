<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <b>
                    <img src="{{ asset('images/WicomLab.png') }}" alt="homepage" class="dark-logo" width="200" />
                </b>
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (Auth::check())
                            @if (Auth::user()->avatar == config('custom.default_avatar'))
                                <img src="{{ config("custom.path_images") . config('custom.default_avatar') }}" class="user-image" alt="{{ Lang::get('custom.user') }}">
                            @else
                                <img src="{{ config("custom.path_avatar") . Auth::user()->avatar }}" class="user-image" alt="{{ Lang::get('custom.user') }}">
                            @endif
                             <span class="hidden-md-down">{{ Auth::user()->name }} &nbsp;</span> 
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

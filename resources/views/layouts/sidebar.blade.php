<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('home') }}" aria-expanded="false">
                        <i class="fa fa-tachometer"></i><span class="hide-menu">@lang('custom.dashboard')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('notifications') }}" aria-expanded="false">
                        <i class="fa fa-exclamation"></i><span class="hide-menu">@lang('custom.notifications')</span>
                        @if ($countNotify > 0)
                            <span class="pull-right count-notification">{{ $countNotify }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('user.show', Auth::id()) }}" aria-expanded="false">
                        <i class="fa fa-user-circle"></i><span class="hide-menu">@lang('custom.profile')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('seminar.index') }}" aria-expanded="false">
                        <i class="fa fa-table"></i><span class="hide-menu">@lang('custom.seminar')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('report') }}" aria-expanded="false">
                        <i class="fa fa-file"></i><span class="hide-menu">@lang('custom.report')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('user.index') }}" aria-expanded="false">
                        <i class="fa fa-users"></i><span class="hide-menu">@lang('custom.user')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('search') }}" aria-expanded="false">
                        <i class="fa fa-search"></i><span class="hide-menu">@lang('custom.search')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('change-language', 'en') }}" aria-expanded="false">
                        <i class="fa"><img src="{{ asset('images/en.png') }}"></i><span class="hide-menu">@lang('custom.en')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('change-language', 'vi') }}" aria-expanded="false">
                        <i class="fa"><img src="{{ asset('images/vi.png') }}"></i><span class="hide-menu">@lang('custom.vi')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark logout" href="{{ route('logout') }}" aria-expanded="false">
                        <i class="fa fa-sign-out"></i><span class="hide-menu">@lang('custom.logout')</span>
                    </a>
                </li>
                {!! Form::open(['id' => 'logout-form', 'method' => 'POST', 'route' => 'logout', 'style' => 'display: none;']) !!}
                {!! Form::close() !!}
            </ul>
        </nav>
    </div>
</aside>

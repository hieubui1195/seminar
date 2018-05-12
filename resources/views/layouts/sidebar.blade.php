<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="{{ route('home') }}" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">@lang('custom.dashboard')</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ route('user.show', Auth::id()) }}" aria-expanded="false"><i class="fa fa-user-circle"></i><span class="hide-menu">@lang('custom.profile')</span></a>
                </li>
                <li> <a class="waves-effect waves-dark @yield('seminar-active')" href="{{ route('seminar.index') }}" aria-expanded="false"><i class="fa fa-table"></i><span class="hide-menu">@lang('custom.seminar')</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="{{ route('user.index') }}" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">@lang('custom.user')</span></a>
                </li>
                <li> <a class="waves-effect waves-dark logout" href="{{ route('logout') }}" aria-expanded="false"><i class="fa fa-sign-out"></i><span class="hide-menu">@lang('custom.logout')</span></a>
                </li>
                {!! Form::open([
                    'id' => 'logout-form', 
                    'method' => 'POST', 
                    'route' => 'logout', 
                    'style' => 'display: none;'
                    ]
                ) !!}
                
                {!! Form::close() !!}
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

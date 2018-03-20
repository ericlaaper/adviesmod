@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('relatiemanager_access')
            <li class="{{ $request->segment(2) == 'relatiemanagers' ? 'active' : '' }}">
                <a href="{{ route('admin.relatiemanagers.index') }}">
                    <i class="fa fa-hand-o-up"></i>
                    <span class="title">@lang('quickadmin.relatiemanager.title')</span>
                </a>
            </li>
            @endcan
            
            @can('bedrijf_access')
            <li class="{{ $request->segment(2) == 'bedrijfs' ? 'active' : '' }}">
                <a href="{{ route('admin.bedrijfs.index') }}">
                    <i class="fa fa-building-o"></i>
                    <span class="title">@lang('quickadmin.bedrijf.title')</span>
                </a>
            </li>
            @endcan
            
            @can('klanten_access')
            <li class="{{ $request->segment(2) == 'klantens' ? 'active' : '' }}">
                <a href="{{ route('admin.klantens.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.klanten.title')</span>
                </a>
            </li>
            @endcan
            
            @can('rapportage_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.rapportages.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('rapportage_module_1_access')
                <li class="{{ $request->segment(2) == 'rapportage_module_1s' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.rapportage_module_1s.index') }}">
                            <i class="fa fa-gears"></i>
                            <span class="title">
                                @lang('quickadmin.rapportage-module-1.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('mod1_access')
            <li class="{{ $request->segment(2) == 'mod1s' ? 'active' : '' }}">
                <a href="{{ route('admin.mod1s.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.mod1.title')</span>
                </a>
            </li>
            @endcan
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>


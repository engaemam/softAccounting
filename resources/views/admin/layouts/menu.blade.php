<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">


        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-globe"></i>
                <span class="hidden-xs"> </span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ aurl('lang/ar') }}"><i class="fa fa-flag"></i> عربى</a></li>
                {{--<li><a href="{{ aurl('lang/en') }}"><i class="fa fa-flag"></i> English</a></li>--}}
            </ul>
        </li>

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                <span class="hidden-xs">{{admin()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">


                    <p>
                        {{admin()->user()->name}}
                        <small>Member since {{admin()->user()->created_at}}</small>
                    </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="{{aurl("admin/".admin()->user()->id."/edit")}}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <a href="{{url('admin/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                </li>
            </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->

    </ul>
</div>

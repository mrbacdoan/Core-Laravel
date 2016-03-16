<a href="{{ route('backend.dashboard.index') }}" class="logo">
    <span class="logo-mini"><b>IZee Media </b></span>
    <span class="logo-lg"><b>IZee Media </b></span>
</a>
<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ empty(Auth::getUser()->avatar) ? url(USER_AVATAR_DEFAULT) : url(Auth::getUser()->avatar) }}" class="user-image avatar" alt="User Image">
                    <span class="hidden-xs"> {{ Auth::getUser()->username }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header">
                        <img src="{{ empty(Auth::getUser()->avatar) ? url(USER_AVATAR_DEFAULT) : url(Auth::getUser()->avatar) }}" class="img-circle avatar" alt="User Image">
                        <p>
                            {{ Auth::getUser()->full_name }}
                            <small>{{ Auth::getUser()->phone }}</small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{{ route('backend.account.profile') }}" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('backend.account.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
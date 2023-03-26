<li class="side-menus {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-home"></i><span>Dashboard</span>
    </a>
</li>

<li class="side-menus {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('users.index')}}">
        <i class=" fas fa-users"></i><span>User</span>
    </a>
</li>
<li class="side-menus {{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('roles.index')}}">
        <i class=" fa fa-user-cog"></i><span>Role</span>
    </a>
</li>
<li class="side-menus {{ Request::is('permissions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('permissions.index')}}">
        <i class="fa fa-cog"></i><span>Permission</span>
    </a>
</li>

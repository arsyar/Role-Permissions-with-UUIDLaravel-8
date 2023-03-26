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

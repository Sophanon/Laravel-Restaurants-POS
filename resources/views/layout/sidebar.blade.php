<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
            <li class="nav-header">User Management</li>
            <li class="nav-item">
                <a href="{{ route('user_list') }}" class="nav-link {{ (Request::route()->getName() == 'user_list' || Request::route()->getName() == 'user_create' || Request::route()->getName() == 'user_show') ? 'active' : '' }}">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>User</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('user_logout') }}" class="nav-link">
                    <i class="fas fa-exist nav-icon"></i>
                    <p>Logout</p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>

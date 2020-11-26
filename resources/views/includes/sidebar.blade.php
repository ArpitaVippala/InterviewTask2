<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{asset('/public/assets/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <span style="color:#ffffff">{!! session('user')['userName'] !!}</span>
            </div>
        </div>

      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(session('user')['role'] == 'admin')
                <li class="nav-item">
                    <a href="{{asset('AdminDashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{asset('addUser')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{asset('adminPosts')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Posts</p>
                    </a>
                </li>
                @endif
                @if(session('user')['role'] == 'user')
                <li class="nav-item">
                    <a href="{{asset('posts')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Posts</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{asset('logout/user')}}" role="button">Logout  </a>
                </li>
            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
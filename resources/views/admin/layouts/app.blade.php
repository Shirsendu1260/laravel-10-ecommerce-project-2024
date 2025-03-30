<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel ECOM • Admin Panel</title>
    @include('includes.css_includes')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site Wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <div class="navbar-nav pl-2">
                <ol class="breadcrumb p-0 m-0 bg-white">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="nav-link" data-widget="fullscreen" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                        @if (Auth::guard('admin')->user()->gender == 'F')
                            <img src="{{ asset('admin-assets/img/avatar3.png') }}" class='img-circle elevation-2'
                                width="40" height="40" alt="">
                        @elseif(Auth::guard('admin')->user()->gender == 'M')
                            <img src="{{ asset('admin-assets/img/avatar4.png') }}" class='img-circle elevation-2'
                                width="40" height="40" alt="">
                        @else
                            <img src="{{ asset('admin-assets/img/user.png') }}" class='img-circle elevation-2'
                                width="40" height="40" alt="">
                            {{-- <a href="https://www.freepik.com/icon/admin_14471192#fromView=keyword&page=1&position=19&uuid=37062be2-c93d-47c4-ae52-2e179a07468c">Icon by gungyoga04</a> --}}
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                        <h4 class="h4 mb-0"><strong>{{ Auth::guard('admin')->user()->name }}</strong></h4>
                        <div class="mb-3">{{ Auth::guard('admin')->user()->email }}</div>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin_settings') }}" class="dropdown-item">
                            <i class="fas fa-user-cog mr-2"></i>Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin_change_password_page') }}" class="dropdown-item">
                            <i class="fas fa-lock mr-2"></i>Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin_logout') }}" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        @include('admin.layouts.sidebar')
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('includes.footer')
    </div>
    @include('includes.js_includes')
</body>

</html>

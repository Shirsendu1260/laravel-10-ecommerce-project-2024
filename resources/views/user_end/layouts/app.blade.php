<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Laravel ECOM</title>
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <meta property="og:locale" content="en_AU" />
    <meta property="og:type" content="website" />
    <meta property="fb:admins" content="" />
    <meta property="fb:app_id" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="og:image:alt" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:image:alt" content="" />
    <meta name="twitter:card" content="summary_large_image" />
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/bootstrap.min.css') }}" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/ion.rangeSlider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/video-js.css') }}" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap"
        rel="stylesheet">
    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />
</head>

<body data-instant-intensity="mousedown">
    <div class="bg-light top-header">
        <div class="container">
            <div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
                <div class="col-lg-4 logo">
                    <a href="{{ route('userend_home') }}" class="text-decoration-none">
                        <span class="h1 text-primary bg-dark rounded px-2">Laravel</span>
                        <span class="h1 text-dark bg-primary px-2 ml-n1">ECOM</span>
                    </a>
                </div>
                <div class="col-lg-6 col-6 text-left d-flex justify-content-end align-items-center">
                    @if (!Auth::check())
                        <a href="{{ route('userend_login_page') }}"
                            class="nav-link link-dark d-flex align-items-center">Sign
                            In<i class="fa fa-chevron-right ms-1 text-dark"></i></a>
                    @else
                        <div class="dropdown">
                            <a href="javascript:void(0)" data-bs-toggle="dropdown"
                                class="nav-link link-dark d-flex align-items-center">Hello,&nbsp;<strong>{{ Auth::user()->name }}</strong><i
                                    class="fa fa-chevron-right ms-1 text-dark"></i></a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                                @if (Auth::user()->image != null)
                                    <img src="{{ asset('uploads/user/thumbnails/' . Auth::user()->image) }}"
                                        class='img-fluid mb-3 rounded' alt="{{ Auth::user()->name }}"
                                        style="max-width: 35%;">
                                @else
                                    <img src="{{ asset('admin-assets/img/user.png') }}"
                                        class='img-fluid mb-3 rounded' alt="{{ Auth::user()->name }}"
                                        style="max-width: 35%;">
                                    {{-- <a href="https://www.freepik.com/icon/admin_14471192#fromView=keyword&page=1&position=19&uuid=37062be2-c93d-47c4-ae52-2e179a07468c">Icon by gungyoga04</a> --}}
                                @endif
                                <h5 class="mb-0"><strong>{{ Auth::user()->name }}</strong></h5>
                                <div class="mb-3 fs-6">{{ Auth::user()->email }}</div>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('user_dashboard') }}" class="dropdown-item">
                                    <i class="fas fa-user-cog me-2"></i>Dashboard
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('user_change_password_page') }}" class="dropdown-item">
                                    <i class="fas fa-lock me-2"></i>Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('user_sign_out') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Sign Out</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('userend_shoppage') }}" method="get">
                        <div class="input-group">
                            <input type="text" placeholder="Search For Products" class="form-control"
                                name="search" id="search" value="{{ Request::get('search') }}">
                            <button type="submit" class="input-group-text">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <header class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-xl" id="navbar">
                <a href="{{ route('userend_home') }}" class="text-decoration-none mobile-logo">
                    <span class="h2 text-primary bg-dark">Laravel</span>
                    <span class="h2 text-white px-2">ECOM</span>
                </a>
                <button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon icon-menu"></span> -->
                    <i class="navbar-toggler-icon fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php" title="Products">Home</a>
                        </li> -->
                        @php
                            $categories_for_navbar = get_categories_for_navbar();
                        @endphp
                        @if ($categories_for_navbar->isNotEmpty())
                            @foreach ($categories_for_navbar as $category)
                                <li class="nav-item dropdown">
                                    <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ $category->name }}
                                    </button>
                                    @php
                                        $sub_categories_for_navbar = get_sub_categories_for_navbar($category->id);
                                    @endphp
                                    @if ($sub_categories_for_navbar->isNotEmpty())
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            @foreach ($sub_categories_for_navbar as $sub_category)
                                                <li><a class="dropdown-item nav-link"
                                                        href="{{ route('userend_shoppage', [$category->slug, $sub_category->slug]) }}">{{ $sub_category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="right-nav py-0">
                    <a href="{{ route('userend_cartpage') }}" class="ml-3 d-flex pt-2">
                        <i class="fas fa-shopping-cart text-primary"></i>
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-dark mt-5">
        @php
            use App\Models\Setting;
            $settings_data = Setting::find(1);
        @endphp
        <div class="container pb-5 pt-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>Get In Touch</h3>
                        <p>{{ $settings_data->company_text }}<br>
                            {{ $settings_data->company_default_address }}<br>
                            <a
                                href="mailto:{{ $settings_data->company_default_email }}">{{ $settings_data->company_default_email }}</a>
                            <a
                                href="tel:{{ $settings_data->company_default_phone_country_code }}{{ $settings_data->company_default_phone }}">
                                ({{ $settings_data->company_default_phone_country_code }})&nbsp;{{ $settings_data->company_default_phone }}
                            </a>
                        </p>
                    </div>
                </div>
                @php
                    $pages = static_pages();
                @endphp
                @if ($pages->isNotEmpty())
                    <div class="col-md-4">
                        <div class="footer-card">
                            <h3>Important Links</h3>
                            <ul>
                                @foreach ($pages as $page)
                                    <li><a href="{{ route('userend_static_page', $page->slug) }}"
                                            title="{{ $page->name }}">{{ $page->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>My Account</h3>
                        <ul>
                            <li><a href="{{ route('userend_login_page') }}" title="Login">Login</a></li>
                            <li><a href="{{ route('userend_signup_page') }}" title="Sign Up">Sign Up</a></li>
                            @if (Auth::check())
                                <li><a href="{{ route('user_orders') }}" title="My Orders">My Orders</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="copy-right text-center">
                            <p>Copyright &copy; 2024 LaravelECOM. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('user-assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('user-assets/js/custom.js') }}"></script>

    <script>
        window.onscroll = function() {
            myFunction()
        };

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('customJs')
</body>

</html>

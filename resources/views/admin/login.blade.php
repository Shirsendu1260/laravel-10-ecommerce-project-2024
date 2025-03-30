<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel ECOM • Admin Login</title>
    @include('includes.css_includes')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        @include('admin.message')
        <div class="card card-outline card-secondary shadow">
            <div class="card-header text-center">
                <img src="{{ asset('admin-assets\img\brand_logo.svg') }}" alt="Logo" class="brand-image m-1"
                    height="40" width="40">
                <h3>Login as an Admin</h3>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Log in to start your session</p>
                <form action="{{ route('admin_authenticate') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="adminEmail" value="{{ old('email') }}" placeholder="Email Address">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="adminPassword" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8 d-flex align-items-center">
                            <div class="icheck-primary">
                                <input type="checkbox" id="adminRemember">
                                <label for="adminRemember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-warning btn-block">Login</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1 mt-3">
                    <a href="">Forgot Password?</a>
                </p>
            </div>
        </div>
    </div>
    @include('includes.js_includes')
</body>

</html>

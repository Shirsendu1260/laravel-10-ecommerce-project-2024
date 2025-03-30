@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item">Sign In</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-10">
        <div class="container">
            @if (Session::has('error'))
                <div class="mb-3" id="login-error">
                    <div class="alert alert-danger px-4">
                        <h6><i class="icon fa fa-exclamation-triangle"></i> {!! Session::get('error') !!}</h6>
                    </div>
                </div>
            @endif
            <div class="login-form">
                <form action="{{ route('userend_user_authenticate') }}" method="post">
                    @csrf
                    <h4 class="modal-title">Sign In To Your Account</h4>
                    <div class="form-group">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="Password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group small">
                        <a href="{{ route('user_forgot_password_page') }}" class="forgot-link">Forgot Password?</a>
                    </div>
                    <input type="submit" class="btn btn-sm btn-dark btn-block" value="Sign In">
                </form>
                <div class="text-center small">Don't have an account? <a href="{{ route('userend_signup_page') }}">SIGN
                        UP</a></div>
                <div class="text-center fw-light" style="font-size: 12.5px">Are you an admin? <a
                        href="{{ route('admin_login') }}">CLICK HERE</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        setTimeout(function() {
            $('#login-error').fadeOut('slow');
        }, 7000);
    </script>
@endsection

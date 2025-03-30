@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item">Forgot Password</li>
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
            @elseif (Session::has('success'))
                <div class="mb-3" id="login-success">
                    <div class="alert alert-success px-4">
                        <h6><i class="icon fa fa-check"></i> {!! Session::get('success') !!}</h6>
                    </div>
                </div>
            @endif
            <div class="login-form">
                <form action="{{ route('user_forgot_password') }}" method="post">
                    @csrf
                    <h4 class="modal-title">Forgot Your Password?</h4>
                    <div class="form-group">
                        <p style="font-size: 12px;" class="text-center">Enter your registered
                            email address and we will send you a link to reset your password.
                        </p>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-sm btn-dark btn-block" value="Submit">
                </form>
                <div class="text-center small">Remember your password? <a href="{{ route('userend_login_page') }}">SIGN
                        IN</a></div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        setTimeout(function() {
            $('#login-error').fadeOut('slow');
        }, 7000);

        setTimeout(function() {
            $('#login-success').fadeOut('slow');
        }, 7000);
    </script>
@endsection

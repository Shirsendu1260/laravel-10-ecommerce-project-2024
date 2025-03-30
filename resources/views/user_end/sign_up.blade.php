@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item">Sign Up</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-10">
        <div class="container">
            <div class="login-form">
                <form name="signup_form" id="signup-form">
                    @csrf
                    <h4 class="modal-title">Sign Up Now</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <select class="form-select" id="gender" name="gender">
                            <option selected value="">Gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="O">Others</option>
                        </select>
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone (Optional)" id="phone"
                            name="phone" maxlength="10">
                        <p style="font-size: 12px;" class="m-0 pt-2 fw-light">
                            The phone number must be from India.
                        </p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password"
                            id="password_confirmation" name="password_confirmation">
                        <p></p>
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-sm btn-dark btn-block" value="Sign Up">Sign Up</button>
                </form>
                <div class="text-center small">Already have an account? <a href="{{ route('userend_login_page') }}">SIGN
                        IN</a></div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $("#signup-form").submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('userend_user_register') }}",
                type: "post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('#name').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#gender').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#email').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#password').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#password_confirmation').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');

                        window.location.href = "{{ route('userend_login_page') }}";
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        let errors = response['msg'];

                        if (errors['name']) {
                            $('#name').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['name']);
                        } else {
                            $('#name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['gender']) {
                            $('#gender').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['gender']);
                        } else {
                            $('#gender').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['email']) {
                            $('#email').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['email']);
                        } else {
                            $('#email').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['password']) {
                            $('#password').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['password']);
                        } else {
                            $('#password').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['password_confirmation']) {
                            $('#password_confirmation').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['password_confirmation']);
                        } else {
                            $('#password').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    alert("Something went wrong while signing up!");
                }
            });
        });
    </script>
@endsection

@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item">Reset Password</li>
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
                <form id="reset-pw-form">
                    @csrf
                    <h4 class="modal-title">Reset Your Password</h4>
                    <input type="hidden" name="email" value="{{ $reset_token_data->email }}">
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="New Password" id="new_password"
                            name="new_password">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm New Password" id="confirm_password"
                            name="confirm_password">
                        <p></p>
                    </div>
                    <input type="submit" class="btn btn-sm btn-dark btn-block" value="Reset">
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
            $('#msg-success').fadeOut('slow');
        }, 10000);

        setTimeout(function() {
            $('#msg-error').fadeOut('slow');
        }, 10000);
    </script>

    <script>
        $("#reset-pw-form").submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('user_reset_password') }}",
                type: "post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('#new_password').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#confirm_password').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');

                        window.location.reload();
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        let errors = response['msg'];

                        if (errors['new_password']) {
                            $('#new_password').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['new_password']);
                        } else {
                            $('#new_password').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['confirm_password']) {
                            $('#confirm_password').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['confirm_password']);
                        } else {
                            $('#confirm_password').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    alert("Something went wrong while resetting password!");
                }
            });
        });
    </script>
@endsection

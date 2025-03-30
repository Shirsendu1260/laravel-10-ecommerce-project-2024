@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('user_dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Change Password</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-11">
        <div class="container mt-5 py-4">
            <div class="row">
                @if (Session::has('success'))
                    <div class="col-md-12 mb-3" id="msg-success">
                        <div class="alert alert-success px-4">
                            <h6><i class="icon fa fa-check"></i> {!! Session::get('success') !!}</h6>
                        </div>
                    </div>
                @elseif (Session::has('error'))
                    <div class="col-md-12 mb-3" id="msg-error">
                        <div class="alert alert-danger px-4">
                            <h6><i class="icon fa fa-ban"></i> {!! Session::get('error') !!}</h6>
                        </div>
                    </div>
                @endif
                <div class="col-md-3">
                    @include('includes.account_panel')
                </div>
                <div class="col-md-9">
                    <div class="card border">
                        <div class="card-header bg-dark">
                            <h2 class="h5 mb-0 pt-2 text-white pb-2">Change Password</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <form id="change-pw-form">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="old_password">Old Password</label>
                                        <input type="password" name="old_password" id="old_password"
                                            placeholder="Old Password" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password">New Password</label>
                                        <input type="password" name="new_password" id="new_password"
                                            placeholder="New Password" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password">Confirm New Password</label>
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            placeholder="Confirm New Password" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-dark">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
        $("#change-pw-form").submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('user_change_password') }}",
                type: "post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('#old_password').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#new_password').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#confirm_password').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');

                        window.location.href = "{{ route('user_change_password_page') }}";
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        let errors = response['msg'];

                        if (errors['old_password']) {
                            $('#old_password').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['old_password']);
                        } else {
                            $('#old_password').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

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
                    alert("Something went wrong while changing password!");
                }
            });
        });
    </script>
@endsection

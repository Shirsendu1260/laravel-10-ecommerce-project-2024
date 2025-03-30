{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_view_categories') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default Box -->
        <div class="container-fluid">
            @include('admin.message')
            <form id="change-pw-form">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" name="old_password" id="old_password" class="form-control"
                                        placeholder="Old Password">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control"
                                        placeholder="New Password">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control" placeholder="Confirm New Password">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-warning">Save</button>
                    <button type="reset" class="btn btn-outline-dark ml-3">Reset</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $("#change-pw-form").submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin_change_password') }}",
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

                        window.location.href = "{{ route('admin_change_password_page') }}";
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

                        document.getElementById("change-pw-form").reset(); // Reset the form
                    }
                },
                error: function(jqXHR, exception) {
                    alert("Something went wrong while changing password!");
                }
            });
        });
    </script>
@endsection

{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update User</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_view_users') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default Box -->
        <div class="container-fluid">
            <form id="userEditForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" value="{{ $user->name }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role">Role</label>
                                    <select class="custom-select" name="role" id="role">
                                        <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>User</option>
                                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender">Gender</label>
                                    <select class="custom-select" name="gender" id="gender">
                                        <option value="" selected>Select a gender</option>
                                        <option value="M" {{ $user->gender == 'M' ? 'selected' : '' }}>Male</option>
                                        <option value="F" {{ $user->gender == 'F' ? 'selected' : '' }}>Female</option>
                                        <option value="O" {{ $user->gender == 'O' ? 'selected' : '' }}>Others</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Email" value="{{ $user->email }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        placeholder="Phone" minlength="10" maxlength="10" value="{{ $user->phone }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select class="custom-select" name="status" id="status">
                                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <button type="reset" class="btn btn-outline-dark ml-3">Reset</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $('#userEditForm').submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin_update_user', $user->id) }}",
                type: 'put',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('#name').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#gender').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#email').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#phone').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');

                        window.location.href = "{{ route('admin_view_users') }}";
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        var errors = response['msg'];

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
                        if (errors['phone']) {
                            $('#phone').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['phone']);
                        } else {
                            $('#phone').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    alert('Error occured!');
                },
            });
        });
    </script>
@endsection

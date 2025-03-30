{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
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
            <form id="settings-form">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="company_text">Company Text</label>
                                    <textarea class="form-control" rows="3" id="company_text" name="company_text" required placeholder="Company Text">{{ $settings->company_text }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="main_admin_id">Main Admin</label>
                                    <select name="main_admin_id" id="main_admin_id" class="form-control">
                                        <option value="">Select main admin</option>
                                        @if ($admins->isNotEmpty())
                                            @foreach ($admins as $admin)
                                                <option value="{{ $admin->id }}"
                                                    {{ $admin->id == $settings->main_admin_id ? 'selected' : '' }}>
                                                    {{ $admin->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">N/A</option>
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company_default_email">Default Email</label>
                                    <input type="text" name="company_default_email" id="company_default_email"
                                        class="form-control" placeholder="Default Email"
                                        value="{{ $settings->company_default_email }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company_default_phone_country_code">Default Phone Country Code</label>
                                    <select name="company_default_phone_country_code"
                                        id="company_default_phone_country_code" class="form-control">
                                        <option value="" selected>Select a country code</option>
                                        <option data-countryCode="IN" value="+91"
                                            {{ '91' == $settings->company_default_phone_country_code ? 'selected' : '' }}>
                                            India (+91)</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company_default_phone">Default Phone</label>
                                    <input type="text" name="company_default_phone" id="company_default_phone"
                                        class="form-control" placeholder="Default Phone" minlength="10" maxlength="10"
                                        value="{{ $settings->company_default_phone }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="company_default_address">Address</label>
                                    <textarea class="form-control" rows="3" id="company_default_address" name="company_default_address" required
                                        placeholder="Address">{{ $settings->company_default_address }}</textarea>
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
        $("#settings-form").submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin_save_settings') }}",
                type: "post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('#main_admin_id').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#company_default_email').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#company_default_phone_country_code').removeClass('is-invalid').siblings('p')
                            .removeClass('invalid-feedback').html('');
                        $('#company_default_phone').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#company_default_address').removeClass('is-invalid').siblings('p')
                            .removeClass('invalid-feedback').html('');

                        window.location.href = "{{ route('admin_settings') }}";
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        let errors = response['msg'];

                        if (errors['main_admin_id']) {
                            $('#main_admin_id').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['main_admin_id']);
                        } else {
                            $('#main_admin_id').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['company_default_email']) {
                            $('#company_default_email').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['company_default_email']);
                        } else {
                            $('#company_default_email').removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html('');
                        }

                        if (errors['company_default_phone_country_code']) {
                            $('#company_default_phone_country_code').addClass('is-invalid').siblings(
                                'p').addClass('invalid-feedback').html(errors[
                                'company_default_phone_country_code']);
                        } else {
                            $('#company_default_phone_country_code').removeClass('is-invalid').siblings(
                                'p').removeClass('invalid-feedback').html('');
                        }

                        if (errors['company_default_phone']) {
                            $('#company_default_phone').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['company_default_phone']);
                        } else {
                            $('#company_default_phone').removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html('');
                        }

                        if (errors['company_default_address']) {
                            $('#company_default_address').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['company_default_address']);
                        } else {
                            $('#company_default_address').removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html('');
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    alert("Something went wrong while saving settings!");
                }
            });
        });
    </script>
@endsection

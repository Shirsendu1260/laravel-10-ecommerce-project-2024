{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Shipping Charge</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_view_shippings') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default Box -->
        <div class="container-fluid">
            <form id="shippingEditForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="country">Country</label>
                                    <select name="country" id="country" class="form-control">
                                        <option value="" selected>Select a country</option>
                                        @if (!empty($countries))
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ $shipping->country_id == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount">Amount (In Rupees)</label>
                                    <input type="text" name="amount" id="amount" class="form-control"
                                        placeholder="Amount" value="{{ $shipping->amount }}">
                                    <p></p>
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
        $('#shippingEditForm').submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin_update_shipping', $shipping->id) }}",
                type: 'put',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('#country').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#amount').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');

                        window.location.href = "{{ route('admin_view_shippings') }}";
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        var errors = response['msg'];

                        if (errors['country']) {
                            $('#country').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['country']);
                        } else {
                            $('#country').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors['amount']) {
                            $('#amount').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['amount']);
                        } else {
                            $('#amount').removeClass('is-invalid').siblings('p').removeClass(
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

{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Discount Coupon</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_view_discount_coupons') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default Box -->
        <div class="container-fluid">
            <form id="discountCouponForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code">Coupon Code</label>
                                    <input type="text" name="code" id="code" class="form-control"
                                        placeholder="Coupon Code">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Coupon Code Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Coupon Code Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="5"
                                        placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_uses">Max Uses (How many user can use it at most?)</label>
                                    <input type="number" name="max_uses" id="max_uses" class="form-control"
                                        placeholder="Max Uses">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_uses_user">Max Uses for User (How many times an user can use it at
                                        most?)</label>
                                    <input type="number" name="max_uses_user" id="max_uses_user" class="form-control"
                                        placeholder="Max Uses (For User)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Type</label>
                                    <select class="custom-select" name="type" id="type">
                                        <option value="percent">Percent</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discount_amount">Discount Amount</label>
                                    <input type="number" name="discount_amount" id="discount_amount" class="form-control"
                                        placeholder="Discount Amount" step="0.01">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="min_amount">Minimum Product Price (In Rupees)</label>
                                    <input type="number" name="min_amount" id="min_amount" class="form-control"
                                        placeholder="Minimum Amount" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="starts_at">Starts At</label>
                                    <input type="text" name="starts_at" id="starts_at" class="form-control"
                                        placeholder="Starts At">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expires_at">Expires At</label>
                                    <input type="text" name="expires_at" id="expires_at" class="form-control"
                                        placeholder="Expires At">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select class="custom-select" name="status" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-warning">Create</button>
                    <button type="reset" class="btn btn-outline-dark ml-3">Reset</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $('#discountCouponForm').submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin_create_discount_coupon') }}",
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('#code').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#discount_amount').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#starts_at').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#expires_at').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');

                        window.location.href = "{{ route('admin_view_discount_coupons') }}";
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        var errors = response['msg'];

                        if (errors['code']) {
                            $('#code').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['code']);
                        } else {
                            $('#code').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors['discount_amount']) {
                            $('#discount_amount').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['discount_amount']);
                        } else {
                            $('#discount_amount').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors['starts_at']) {
                            $('#starts_at').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['starts_at']);
                        } else {
                            $('#starts_at').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors['expires_at']) {
                            $('#expires_at').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['expires_at']);
                        } else {
                            $('#expires_at').removeClass('is-invalid').siblings('p').removeClass(
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

    <script>
        $('#starts_at, #expires_at').datetimepicker({
            format: 'Y-m-d H:i:s',
        });
    </script>
@endsection

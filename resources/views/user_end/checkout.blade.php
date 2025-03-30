@extends('user_end.layouts.app')

@section('content')
    <div>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                        <li class="breadcrumb-item">Checkout</li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="section-9 pt-4">
            <div class="container">
                <form id="orderForm">
                    <div class="row">
                        @if (Session::has('login_success'))
                            <div class="col-md-12 mb-3" id="msg-login-success">
                                <div class="alert alert-primary px-4">
                                    <h6><i class="icon fa fa-check"></i> {!! Session::get('login_success') !!}</h6>
                                </div>
                            </div>
                        @elseif (Session::has('success'))
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
                        <div class="col-md-7">
                            <div class="sub-title">
                                <h2>Shipping Address</h2>
                            </div>
                            <div class="card shadow-lg border-0">
                                <div class="card-body checkout-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="first_name" id="first_name" class="form-control"
                                                    placeholder="First Name"
                                                    value="{{ !empty($customer_address->first_name) ? $customer_address->first_name : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="last_name" id="last_name" class="form-control"
                                                    placeholder="Last Name"
                                                    value="{{ !empty($customer_address->last_name) ? $customer_address->last_name : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="email" id="email" class="form-control"
                                                    placeholder="Email"
                                                    value="{{ !empty($customer_address->email) ? $customer_address->email : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <select name="country" id="country" class="form-control">
                                                    <option value="" selected>Select a Country</option>
                                                    @if (!empty($countries))
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}"
                                                                {{ !empty($customer_address->country_id) && $customer_address->country_id == $country->id ? 'selected' : '' }}>
                                                                {{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{ !empty($customer_address->address) ? $customer_address->address : '' }}</textarea>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="house" id="house" class="form-control"
                                                    placeholder="Apartment, suite, unit, etc. (Optional)"
                                                    value="{{ !empty($customer_address->house) ? $customer_address->house : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="city" id="city" class="form-control"
                                                    placeholder="City"
                                                    value="{{ !empty($customer_address->city) ? $customer_address->city : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="state" id="state" class="form-control"
                                                    placeholder="State"
                                                    value="{{ !empty($customer_address->state) ? $customer_address->state : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="zip" id="zip" class="form-control"
                                                    placeholder="Zipcode" maxlength="6"
                                                    value="{{ !empty($customer_address->zip) ? $customer_address->zip : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <input type="text" name="country_code" id="country_code"
                                                    class="form-control" placeholder="Country Code"
                                                    value="{{ !empty($customer_address->country_code) ? $customer_address->country_code : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <input type="text" name="phone" id="phone" class="form-control"
                                                    placeholder="Phone No." minlength="10" maxlength="10"
                                                    value="{{ !empty($customer_address->phone) ? $customer_address->phone : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea name="order_notes" id="order_notes" cols="30" rows="3" placeholder="Order Notes (Optional)"
                                                    class="form-control"></textarea>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="sub-title">
                                <h2>Order Summery</h3>
                            </div>
                            <div class="card cart-summery">
                                <div class="card-body">
                                    @foreach ($cart_content as $item)
                                        <div class="d-flex justify-content-between pb-2">
                                            <div style="font-size: 13.5px">{{ $item->name }} &nbsp;X&nbsp;
                                                <b>{{ $item->qty }}</b>
                                            </div>
                                            <div style="font-size: 13.5px">
                                                ₹{{ number_format($item->price * $item->qty, 2) }}</div>
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-between summery-end">
                                        <div class="h6"><strong>Subtotal</strong></div>
                                        <div class="h6"><strong>₹{{ Cart::subtotal() }}</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="h6"><strong>Shipping</strong></div>
                                        <div class="h6"><strong>₹<span
                                                    id="shipping-charge-span">{{ number_format($shipping_charge, 2) }}</span></strong>
                                        </div>
                                    </div>
                                    <div id="discount-div">
                                        <hr>
                                        <div class="d-flex justify-content-between mt-2">
                                            <div class="h6"><strong>Discount</strong></div>
                                            <div class="h6"><strong class="text-danger">₹<span
                                                        id="discount-span">{{ number_format($discount, 2) }}</span></strong>
                                            </div>
                                        </div>
                                        <div id="discount-div-2" style="display: none;">
                                            <p style="font-size: 13.5px">Applied Coupon:
                                                <span id="applied-coupon">COUPON</span>
                                                <br>To remove this coupon, <a href="javascript:void(0)"
                                                    class="remove-coupon">click here</a>.
                                            </p>
                                        </div>
                                        @if (Session::has('discount_coupon'))
                                            <p style="font-size: 13.5px">Applied Coupon:
                                                {{ Session::get('discount_coupon.code') }}
                                                <br>To remove this coupon, <a href="javascript:void(0)"
                                                    class="remove-coupon">click here</a>.
                                            </p>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 summery-end">
                                        <div class="h5"><strong>Total</strong></div>
                                        <div class="h5"><strong>₹<span
                                                    id="grand-total-span">{{ number_format($grand_total, 2) }}</span></strong>
                                        </div>
                                    </div>
                                    <div class="input-group apply-coupon mt-4">
                                        <input type="text" placeholder="Coupon Code" class="form-control"
                                            name="discount_coupon_code" id="discount-coupon-code">
                                        <button class="btn btn-dark" type="button" id="apply-discount-coupon">Apply
                                            Coupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card payment-form">
                                <h3 class="card-title h5 mb-3">Payment Method</h3>
                                <div class="card-body p-0">
                                    <div class="btn-group" role="group" aria-label="Available Payment Methods">
                                        <input type="radio" class="btn-check" name="payment_method"
                                            id="payment_method_1" value="cod">
                                        <label
                                            class="btn btn-light border border-2 rounded-0 me-3 d-flex align-items-center"
                                            style="font-size: 14.5px;" for="payment_method_1">Cash On Delivery</label>
                                        <input type="radio" class="btn-check" name="payment_method"
                                            id="payment_method_2" value="razorpay">
                                        <label
                                            class="btn btn-light border border-2 rounded-0 p-1 d-flex align-items-center"
                                            for="payment_method_2">
                                            <img src="{{ asset('user-assets/images/razorpay.svg') }}" alt="razorpay"
                                                style="width: 85px;" class="mx-2">
                                        </label>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <a href="javascript:void(0)" class="btn-dark btn btn-block w-100 pay-now-btn"
                                        data-bs-toggle="modal" data-bs-target="#confirmPayment" style="display: none">Pay
                                        Now</a>
                                </div>
                            </div>
                            <!-- CREDIT CARD FORM ENDS HERE -->
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="confirmPayment" tabindex="-1" aria-labelledby="confirmPaymentLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmPaymentLabel">Are you sure?
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Do you really want to proceed this payment using <b><span
                                            id="payment-method-span">PaymentMethod</span></b> method?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-warning" id="modalYesBtn">Yes</button>
                                    <button type="submit" class="btn btn-warning" id="modalYesRazorpay"
                                        style="display: none">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('customJs')
    <script>
        function base64Encode(str) {
            return btoa(encodeURIComponent(str)); // Encode to Base64
        }
    </script>

    <script>
        setTimeout(function() {
            $('#msg-login-success').fadeOut('slow');
        }, 10000);

        setTimeout(function() {
            $('#msg-success').fadeOut('slow');
        }, 15000);

        setTimeout(function() {
            $('#msg-error').fadeOut('slow');
        }, 15000);
    </script>

    <script>
        $("#payment_method_1").click(function() {
            let paymentMethod = $(this).val();
            // console.log(paymentMethod);

            $("#payment-method-span").text("Cash On Delivery");
            $(".pay-now-btn").fadeIn('fast');
            $("#modalYesBtn").show();
            $("#modalYesRazorpay").hide();
        });

        $("#payment_method_2").click(function() {
            let paymentMethod = $(this).val();
            // console.log(paymentMethod);

            $("#payment-method-span").text("Razorpay");
            $(".pay-now-btn").fadeIn('fast');
            $("#modalYesBtn").hide();
            $("#modalYesRazorpay").show();
        });
    </script>

    <script>
        $("#orderForm").submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('userend_process_checkout') }}",
                type: "post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        window.location.href = "{{ url('/thank-you/') }}/" + base64Encode(response
                            .uniqueOrderID.toString());
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        let errors = response['errors'];
                        // console.log(errors);

                        if (errors['first_name']) {
                            $('#first_name').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['first_name']);
                        } else {
                            $('#first_name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['last_name']) {
                            $('#last_name').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['last_name']);
                        } else {
                            $('#last_name').removeClass('is-invalid').siblings('p').removeClass(
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

                        if (errors['country']) {
                            $('#country').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['country']);
                        } else {
                            $('#country').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['address']) {
                            $('#address').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['address']);
                        } else {
                            $('#address').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['city']) {
                            $('#city').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['city']);
                        } else {
                            $('#city').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['state']) {
                            $('#state').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['state']);
                        } else {
                            $('#state').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['zip']) {
                            $('#zip').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['zip']);
                        } else {
                            $('#zip').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    alert("Something went wrong while saving the order!");
                },
            });
        });
    </script>

    <script>
        $("#country").change(function() {
            $.ajax({
                url: "{{ route('userend_get_order_summary') }}",
                type: "post",
                data: {
                    country_id: $(this).val(),
                },
                dataType: "json",
                success: function(response) {
                    $("#shipping-charge-span").text(response.shippingAmount);
                    $("#grand-total-span").text(response.grandTotal);
                },
                error: function() {
                    alert("Something went wrong while fetching the specific shipping charge!");
                },
            });
        });
    </script>

    <script>
        $("#apply-discount-coupon").click(function() {
            $.ajax({
                url: "{{ route('userend_apply_discount') }}",
                type: "post",
                data: {
                    discount_coupon_code: $("#discount-coupon-code").val(),
                    country_id: $("#country").val(),
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        $("#shipping-charge-span").text(response.shippingAmount);
                        $("#discount-div-2").fadeIn('fast');
                        $("#applied-coupon").text(response.discount_coupon_code);
                        $("#discount-span").text(response.discount);
                        $("#grand-total-span").text(response.grandTotal);
                    } else {
                        alert(response.msg);
                        $("#discount-coupon-code").val("");
                    }
                },
                error: function() {
                    alert("Something went wrong while applying the discount coupon code!");
                },
            });
        });
    </script>

    <script>
        $(".remove-coupon").click(function() {
            $.ajax({
                url: "{{ route('userend_remove_discount') }}",
                type: "post",
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        window.location.reload();
                    }
                },
                error: function() {
                    alert("Something went wrong while removing the coupon from cart items.");
                },
            });
        });
    </script>
@endsection

{{-- {{ dd(Session::all()) }} --}}

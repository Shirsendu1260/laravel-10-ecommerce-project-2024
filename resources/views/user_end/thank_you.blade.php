@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item">Thank You</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-10">
        <div class="container">
            @if (Session::has('success'))
                <div class="mb-3 mt-2" id="order-success">
                    <div class="alert alert-success px-4">
                        <h6><i class="icon fa fa-check"></i> {!! Session::get('success') !!}</h6>
                    </div>
                </div>
            @endif
            <div class="d-flex flex-column justify-content-center">
                <div class="mt-3">
                    <h2 class="text-center">THANK YOU</h2>
                    <h5 class="text-center fw-light">for shopping with us!</h5>
                    <h6 class="text-center fw-light px-2 mt-3">We're processing your order and will notify you soon. Stay
                        connected with us.</h6>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-6 col-md-4 col-sm-12 col-12">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ asset('user-assets/images/order-confirmed.png') }}" alt="order-confirmed-png">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12 col-12 mt-3 py-5 px-4">
                        <h6 class="d-flex justify-content-between">
                            <div>Unique Order ID</div>
                            <div class="fw-light">{{ $ty_order_data->unique_order_id }}</div>
                        </h6>
                        <h6 class="d-flex justify-content-between">
                            <div>Order Date</div>
                            <div class="fw-light">{{ date('l, F j, Y', strtotime($ty_order_data->created_at)) }}</div>
                        </h6>
                        <h6 class="d-flex justify-content-between">
                            <div>Payment Method</div>
                            <div class="fw-light">
                                {{ $ty_order_data->payment_method == 'cod' ? 'Cash On Delivery' : 'Razorpay' }} (Delivery
                                Within 5-10 Days)</div>
                        </h6>
                        <hr>
                        @foreach ($ty_order_items as $item)
                            <h6 class="d-flex justify-content-between">
                                <div>{{ $item->name }}</div>
                                <div class="fw-light">Qty {{ $item->qty }}</div>
                            </h6>
                        @endforeach
                        <hr>
                        <h6 class="d-flex justify-content-between">
                            <div>Subtotal</div>
                            <div class="fw-light">₹{{ $ty_order_data->subtotal }}</div>
                        </h6>
                        <h6 class="d-flex justify-content-between">
                            <div>Shipping</div>
                            <div class="fw-light">₹{{ $ty_order_data->shipping }}</div>
                        </h6>
                        <h6 class="d-flex justify-content-between">
                            <div>Discount</div>
                            <div class="fw-light">₹{{ $ty_order_data->discount }}</div>
                        </h6>
                        <h6 class="d-flex justify-content-between">
                            <div>Grand Total</div>
                            <div class="fw-light">₹{{ $ty_order_data->grand_total }}</div>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        setTimeout(function() {
            $('#order-success').fadeOut('slow');
        }, 7000);
    </script>
@endsection

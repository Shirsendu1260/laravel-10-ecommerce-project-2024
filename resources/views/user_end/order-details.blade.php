@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('user_dashboard') }}">Dashboard</a>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('user_orders') }}">My Orders</a>
                    </li>
                    <li class="breadcrumb-item">Order Details</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-11">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('includes.account_panel')
                </div>
                <div class="col-md-9">
                    <div class="card border">
                        <div class="card-header bg-dark">
                            <h2 class="h5 mb-0 pt-2 text-white pb-2">Order Details</h2>
                        </div>
                        <div class="card-body pb-0">
                            <!-- Info -->
                            <div class="card card-sm">
                                <div class="card-body bg-light mb-3">
                                    <div class="row">
                                        <div class="col-6 col-lg-2">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Unique Order ID:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">{{ $order_details->unique_order_id }}</p>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Shipped Date:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                                <time datetime="2019-10-01">
                                                    @if (!empty($order_details->shipped_date))
                                                        {{ date('d M, Y', strtotime($order_details->shipped_date)) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </time>
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Delivered Date:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                                <time datetime="2019-10-01">
                                                    @if (!empty($order_details->delivered_date))
                                                        {{ date('d M, Y', strtotime($order_details->delivered_date)) }}
                                                    @else
                                                        Not Applicable
                                                    @endif
                                                </time>
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Status:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                @if ($order_details->status == 'pending')
                                                    <span class="badge bg-warning text-dark fw-normal">Pending</span>
                                                @elseif ($order_details->status == 'shipped')
                                                    <span class="badge bg-secondary fw-normal">Shipped</span>
                                                @elseif ($order_details->status == 'delivered')
                                                    <span class="badge bg-success fw-normal">Delivered</span>
                                                @else
                                                    <span class="badge bg-danger fw-normal">Cancelled</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Payment:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                @if ($order_details->payment_status == 'paid')
                                                    <span class="badge bg-success fw-normal">Paid</span>
                                                @else
                                                    <span class="badge bg-danger fw-normal">Not Paid</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Order Amount:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                ₹{{ number_format($order_details->grand_total, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer p-3">
                            <!-- Heading -->
                            <h6 class="mb-7 h5 mt-4">Order Items ({{ $order_items->count() }})</h6>
                            <!-- Divider -->
                            <hr class="my-3">
                            <!-- List group -->
                            <ul>
                                @foreach ($order_items as $item)
                                    @php
                                        $product_img = get_product_image($item->id);
                                    @endphp
                                    <li class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-4 col-md-3 col-xl-2">
                                                <!-- Image -->
                                                @if (!empty($product_img))
                                                    <img src="{{ asset('uploads\product\\' . $product_img->name) }}"
                                                        alt="{{ $item->title }}" class="img-fluid rounded">
                                                @else
                                                    <img src="{{ asset('admin-assets/img/unavailable.png') }}"
                                                        class="img-fluid rounded">
                                                @endif
                                            </div>
                                            <div class="col">
                                                <!-- Title -->
                                                <p class="mb-4 fs-sm fw-bold">
                                                    <a class="link"
                                                        href="{{ route('userend_product_details_page', $item->slug) }}">{{ $item->title }}</a>
                                                    &nbsp;X&nbsp;
                                                    {{ $item->qty }}
                                                    <br>
                                                    <span class="text-muted">₹{{ number_format($item->total, 2) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="card border card-lg mb-5 mt-3">
                        <div class="card-body">
                            <!-- Heading -->
                            <h6 class="mt-0 mb-3 h5">Order Total</h6>
                            <!-- List group -->
                            <ul>
                                <li class="list-group-item d-flex">
                                    <span>Subtotal</span>
                                    <span class="ms-auto">₹{{ number_format($order_details->subtotal, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>Shipping</span>
                                    <span class="ms-auto">₹{{ number_format($order_details->shipping, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>
                                        Discount
                                        @if (!empty($order_details->coupon_code))
                                            <p style="font-size: 13.2px" class="fw-light m-0 p-0">Applied Coupon:
                                                {{ $order_details->coupon_code }}
                                            </p>
                                        @endif
                                    </span>
                                    <span
                                        class="ms-auto text-danger">₹{{ number_format($order_details->discount, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex fs-lg fw-bold">
                                    <span>Total</span>
                                    <span class="ms-auto">₹{{ number_format($order_details->grand_total, 2) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
@endsection

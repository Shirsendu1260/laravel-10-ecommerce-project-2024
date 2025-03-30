@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('user_dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">My Orders</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-11">
        <div class="container mt-5 py-4">
            <div class="row">
                <div class="col-md-3">
                    @include('includes.account_panel')
                </div>
                <div class="col-md-9">
                    @if ($orders->isNotEmpty())
                        <div class="card border">
                            <div class="card-header bg-dark">
                                <h2 class="h5 mb-0 pt-2 text-white pb-2">My Orders</h2>
                            </div>
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Unique Order ID</th>
                                                <th>Purchase Date</th>
                                                <th>Delivered Date</th>
                                                <th>Payment Status</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->unique_order_id }}</td>
                                                    <td>{{ $order->created_at->format('d M Y, h:m a') }}</td>
                                                    <td>{{ $order->delivered_date != null ? date('d M Y, h:m a', strtotime($order->delivered_date)) : 'Not Applicable' }}
                                                    </td>
                                                    <td>
                                                        @if ($order->payment_status == 'paid')
                                                            <span class="badge bg-success fw-normal">Paid</span>
                                                        @else
                                                            <span class="badge bg-danger fw-normal">Not Paid</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($order->status == 'pending')
                                                            <span
                                                                class="badge bg-warning text-dark fw-normal">Pending</span>
                                                        @elseif ($order->status == 'shipped')
                                                            <span class="badge bg-secondary fw-normal">Shipped</span>
                                                        @elseif ($order->status == 'delivered')
                                                            <span class="badge bg-success fw-normal">Delivered</span>
                                                        @else
                                                            <span class="badge bg-danger fw-normal">Cancelled</span>
                                                        @endif
                                                    </td>
                                                    <td>₹{{ number_format($order->grand_total, 2) }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('user_order_details', $order->unique_order_id) }}">
                                                            <span class="badge bg-dark">Visit</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ asset('user-assets/images/not-found.png') }}" alt="not-found-png"
                                style="width: 170px;">
                            <br>
                            <h5><b>No Orders Found</b></h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
@endsection

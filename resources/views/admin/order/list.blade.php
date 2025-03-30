{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default Box -->
        <div class="container-fluid">
            @include('admin.message')
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" onclick="window.location.href='{{ route('admin_view_orders') }}'"
                                class="btn btn-sm btn-secondary">Reset</button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group" style="width: 250px;">
                                <input type="text" name="order_search" class="form-control float-right"
                                    value="{{ Request::get('order_search') }}" placeholder="Search for order">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Unique Order ID</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Total (Rs.)</th>
                                <th>Status</th>
                                <th>Date Ordered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isNotEmpty())
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            <a href="{{ route('admin_order_details_page', $order->unique_order_id) }}"
                                                class="card-link">
                                                {{ $order->unique_order_id }}
                                            </a>
                                        </td>
                                        <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->country_code }}{{ $order->phone }}</td>
                                        <td>{{ $order->grand_total }}</td>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning text-dark"
                                                    style="font-weight: 500;">Pending</span>
                                            @elseif ($order->status == 'shipped')
                                                <span class="badge bg-secondary" style="font-weight: 500;">Shipped</span>
                                            @elseif ($order->status == 'delivered')
                                                <span class="badge bg-success" style="font-weight: 500;">Delivered</span>
                                            @else
                                                <span class="badge bg-danger" style="font-weight: 500;">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('d M, Y') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-danger text-center">Records not found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination m-0 float-right">
                        {{ $orders->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
@endsection

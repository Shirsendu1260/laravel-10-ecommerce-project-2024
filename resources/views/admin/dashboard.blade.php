{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default Box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>{{ $order_count }}</h3>
                            <p>Total Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="{{ route('admin_view_orders') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>{{ $products_count }}</h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <a href="{{ route('admin_view_products') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>{{ $customer_count }}</h3>
                            <p>Total Customers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{ route('admin_view_users', 'user') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>₹{{ number_format($total_sale, 2) }}</h3>
                            <p>Total Sale</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <a href="{{ route('admin_view_orders') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>₹{{ number_format($this_month_total_sale, 2) }}</h3>
                            <p>Total Sale of This Month</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <a href="{{ route('admin_view_orders', [$month_start_date, $current_date]) }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>₹{{ number_format($last_month_total_sale, 2) }}</h3>
                            <p>Total Sale of Last Month</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <a href="{{ route('admin_view_orders', [$last_month_start_date, $last_month_end_date]) }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>₹{{ number_format($last_30days_total_sale, 2) }}</h3>
                            <p>Total Sale of Last 30 Days</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <a href="{{ route('admin_view_orders', [$last_30days_start_date, $current_date]) }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>₹{{ number_format($last_6months_total_sale, 2) }}</h3>
                            <p>Total Sale of Last 6 Months</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <a href="{{ route('admin_view_orders', [$last_6months_start_date, $current_date]) }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>₹{{ number_format($last_year_total_sale, 2) }}</h3>
                            <p>Total Sale of Last Year ({{ $last_year }})</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <a href="{{ route('admin_view_orders', [$last_year_start_date, $last_year_end_date]) }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>₹{{ number_format($this_year_total_sale, 2) }}</h3>
                            <p>Total Sale of This Year ({{ date('Y', strtotime($current_date)) }})</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <a href="{{ route('admin_view_orders', [$this_year_start_date, $current_date]) }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        // console.log('Hello, World!');
    </script>
@endsection

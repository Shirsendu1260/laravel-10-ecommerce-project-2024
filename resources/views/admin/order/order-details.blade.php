{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            @include('admin.message')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Unique Order ID: <b>{{ $order_details->unique_order_id }}</b></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_view_orders') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default Box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header pt-3">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <h1 class="h5 mb-3">Shipping Address</h1>
                                    <address>
                                        <strong>{{ $order_details->first_name . ' ' . $order_details->last_name }}</strong><br>
                                        {{ $order_details->house }}<br>
                                        {{ $order_details->address }}, {{ $order_details->city }}<br>
                                        {{ $order_details->state }}, {{ $order_details->country_name }}
                                        {{ $order_details->zip }}<br>
                                        Contact No.: {{ $order_details->phone }}<br>
                                        Email: {{ $order_details->email }}
                                    </address>
                                    @if (!empty($order_details->shipped_date))
                                        <div class="mt-4 mb-1">
                                            <strong class="h5">Shipped Date & Time</strong>
                                            <div>{{ date('d M, Y, h:m a', strtotime($order_details->shipped_date)) }}</div>
                                        </div>
                                    @endif
                                    @if (!empty($order_details->delivered_date))
                                        <div class="mt-4 mb-1">
                                            <strong class="h5">Delivered Date & Time</strong>
                                            <div>{{ date('d M, Y, h:m a', strtotime($order_details->delivered_date)) }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <br><br>
                                    <b>Order ID: </b>{{ $order_details->unique_order_id }}<br>
                                    <b>Total: </b>{{ $order_details->grand_total }} Rs.<br>
                                    <b>Payment Status: </b>
                                    @if ($order_details->payment_status == 'paid')
                                        <span class="badge bg-success" style="font-weight: 500;">Paid</span>
                                    @else
                                        <span class="badge bg-danger" style="font-weight: 500;">Not Paid</span>
                                    @endif
                                    <br>
                                    <b>Status: </b>
                                    @if ($order_details->status == 'pending')
                                        <span class="badge bg-warning text-dark" style="font-weight: 500;">Pending</span>
                                    @elseif($order_details->status == 'shipped')
                                        <span class="badge bg-secondary" style="font-weight: 500;">Shipped</span>
                                    @elseif($order_details->status == 'delivered')
                                        <span class="badge bg-success" style="font-weight: 500;">Delivered</span>
                                    @else
                                        <span class="badge bg-danger" style="font-weight: 500;">Cancelled</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_items as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>₹{{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>₹{{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <th>Subtotal:</th>
                                        <td>₹{{ number_format($order_details->subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <th>Shipping:</th>
                                        <td>₹{{ number_format($order_details->shipping, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <th>Discount:
                                            @if (!empty($order_details->coupon_code))
                                                <p style="font-size: 13.2px; font-weight: 400;" class="m-0 p-0">
                                                    Applied Coupon:
                                                    {{ $order_details->coupon_code }}
                                                </p>
                                            @endif
                                        </th>
                                        <td class="text-danger">₹{{ number_format($order_details->discount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <th>Total:</th>
                                        <td>₹{{ number_format($order_details->grand_total, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Order Status</h2>
                            <form id="change-order-status-form">
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending"
                                            {{ $order_details->status == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="shipped"
                                            {{ $order_details->status == 'shipped' ? 'selected' : '' }}>
                                            Shipped</option>
                                        <option value="delivered"
                                            {{ $order_details->status == 'delivered' ? 'selected' : '' }}>Delivered
                                        </option>
                                        <option value="cancelled"
                                            {{ $order_details->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="shipped-date">Shipped Date</label>
                                    <input type="text" name="shipped_date" id="shipped-date" class="form-control"
                                        value="{{ $order_details->shipped_date }}">
                                </div>
                                <div class="mb-3">
                                    <label for="delivered-date">Delivered Date</label>
                                    <input type="text" name="delivered_date" id="delivered-date" class="form-control"
                                        value="{{ $order_details->delivered_date }}">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_order_status"
                                        class="btn btn-sm btn-warning">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Send Invoice Email</h2>
                            <form id="send-invoice-email-form">
                                <div class="mb-3">
                                    <select name="send_invoice_email_usertype" id="send-invoice-email" class="form-control">
                                        <option value="customer">Customer</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="send_invoice_email"
                                        class="btn btn-sm btn-warning">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $('#shipped-date, #delivered-date').datetimepicker({
            format: 'Y-m-d H:i:s',
        });
    </script>

    <script>
        $("#change-order-status-form").submit(function(event) {
            event.preventDefault();
            $('button[name=update_order_status]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin_change_order_status', $order_details->unique_order_id) }}",
                type: "put",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        $('button[name=update_order_status]').prop('disabled', false);
                        window.location.reload();
                    } else {
                        alert(response.msg);
                    }
                },
                error: function() {
                    alert("Something went wrong while changing the order status!");
                },
            });
        });
    </script>

    <script>
        $("#send-invoice-email-form").submit(function(event) {
            event.preventDefault();
            $('button[name=send_invoice_email]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin_send_invoice_email', $order_details->unique_order_id) }}",
                type: "post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        $('button[name=send_invoice_email]').prop('disabled', false);
                        window.location.reload();
                    }
                },
                error: function() {
                    alert("Something went wrong while sending invoice email!");
                },
            });
        });
    </script>
@endsection

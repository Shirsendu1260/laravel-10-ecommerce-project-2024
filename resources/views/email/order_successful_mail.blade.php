<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{!! $mail_data['title'] !!}</title>
</head>

<body>
    @if ($mail_data['user_type'] == 'customer')
        <h3><b>{!! $mail_data['title'] !!}</b></h3>
        <br>
        {!! $mail_data['body'] !!}
        <br>
    @else
        <h3><b>{!! $mail_data['title'] !!}</b></h3>
        <br>
        <p>
            Dear <b>Laravel ECOM Admin</b>,<br><br>
            A new order has been successfully placed and is waiting your review and processing.<br><br>
            Best wishes,<br>from <b>Laravel ECOM</b> Team
        </p>
        <br>
    @endif
    <h4><b>Ordered Items:</b></h4>
    <table border="1">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mail_data['order_items'] as $item)
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
                <td>₹{{ number_format($mail_data['order_details']->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <th>Shipping:</th>
                <td>₹{{ number_format($mail_data['order_details']->shipping, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <th>Discount:
                    @if (!empty($mail_data['order_details']->coupon_code))
                        <p style="font-size: 13.2px; font-weight: 400;">
                            Applied Coupon:
                            {{ $mail_data['order_details']->coupon_code }}
                        </p>
                    @endif
                </th>
                <td>₹{{ number_format($mail_data['order_details']->discount, 2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <th>Total:</th>
                <td>₹{{ number_format($mail_data['order_details']->grand_total, 2) }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <h4><b>Shipping Address:</b></h4>
    <p>
        {{ $mail_data['order_details']->house }}<br>
        {{ $mail_data['order_details']->address }}, {{ $mail_data['order_details']->city }}<br>
        {{ $mail_data['order_details']->state }}, {{ $mail_data['order_details']->country_name }}
        {{ $mail_data['order_details']->zip }}<br>
    </p>
    <p>Recipient Name:
        <b>{{ $mail_data['order_details']->first_name . ' ' . $mail_data['order_details']->last_name }}</b>
    </p>
    <br>
    <p>Your Unique Order ID: <b>{!! $mail_data['unique_order_id'] !!}</b></p>
    <p>Total Order Price: <b>{!! $mail_data['order_price'] !!}</b> Rs.</p>
    <p>Payment Method: <b>{!! $mail_data['payment_method'] !!}</b></p>
    <p>Date: <b>{!! $mail_data['order_date'] !!}</b></p>
</body>

</html>

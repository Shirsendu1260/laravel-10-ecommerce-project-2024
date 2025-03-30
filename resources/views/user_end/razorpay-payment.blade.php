<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel ECOM</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/bootstrap.min.css') }}" />
</head>

<body>
    <div class="p-3">
        <span class="spinner-border spinner-border-sm" role="status"></span>
        <span>Please wait ...</span>
    </div>
    <script src="{{ asset('user-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function base64Encode(str) {
            return btoa(encodeURIComponent(str)); // Encode to Base64
        }
    </script>
    <script>
        let uniqueOrderId = "{{ $unique_order_id }}";

        var options = {
            "key": "{{ env('RAZORPAY_PUBLIC_KEY') }}", // Enter the Key ID generated from the Dashboard
            "amount": "{{ $amount }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": "Laravel ECOM", // Your business name
            "description": "Test Transaction",
            "image": "{{ asset('user-assets/images/site_name.png') }}",
            "order_id": "{{ $razorpay_order_id }}",
            // "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
            "prefill": { // We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                "name": "{{ $customer->name }}", // Your customer's name
                "email": "{{ $customer->email }}",
                "contact": "{{ $customer->phone }}" // Provide the customer's phone number for better conversion rates
            },
            "notes": {
                "address": "Laravel ECOM Team"
            },
            "theme": {
                "color": "#3399cc"
            },
            "handler": function(response) {
                let paymentId = response.razorpay_payment_id;
                let orderId = response.razorpay_order_id;
                let sign = response.razorpay_signature;

                window.location.href = "{{ route('userend_razorpay_callback') }}?payment_id=" +
                    base64Encode(payment_id.toString()) +
                    "&order_id=" + base64Encode(order_id.toString()) +
                    "&sign=" + base64Encode(sign.toString()) +
                    "&unique_order_id=" + base64Encode(uniqueOrderId.toString());
            },
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    </script>
</body>

</html>

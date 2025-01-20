@extends('includes.header')

@section('title', 'Book Now')

@section('content')
<br><br><br>
<div class="container">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<h3>Complete Your Payment</h3>
    <form id="razorpay-form" action="{{ route('handle.payment')}} " method="POST">
        @csrf
        <input type="hidden" name="appointment_id" value="{{ $appointmentId }}">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" value="{{ $orderId }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="name" value="{{ $request['name'] }}">
        <input type="hidden" name="mobile" value="{{ $request['mobile'] }}">
        <input type="hidden" name="email" value="{{ $request['email'] }}">
        <input type="hidden" name="date" value="{{ $request['date'] }}">
        <input type="hidden" name="time" value="{{ $request['time'] }}">

        <button class="btn btn-primary" type="button" id="pay-button">Pay ₹{{ $amount / 100 }}</button>
    </form>

    <script>
        document.getElementById('pay-button').addEventListener('click', function (e) {
            var options = {
                "key": "{{ $key }}", // Razorpay key
                "amount": "{{ $amount }}", // Amount in paise
                "currency": "INR",
                "order_id": "{{ $orderId }}", // Razorpay Order ID
                "handler": function (response) {
                    // Attach Razorpay Payment ID and submit form
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay-form').submit();
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });
    </script>
</div>
@endsection
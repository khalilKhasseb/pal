<!-- filepath: /Users/khalilkhasseb/Herd/dev.palgbc.org/resources/views/payment.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Initialization</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Initialize Payment</h1>
        <form action="{{ route('payment.initialize') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount" required>
            </div>
            <input type="hidden" name="callback_url" value="{{ url('/payment/callback') }}">
            <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
        </form>
    </div>
</body>
</html>
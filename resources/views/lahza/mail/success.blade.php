<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2d3748;
            text-align: center;
        }
        .payment-details {
            margin-top: 30px;
        }
        .payment-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .payment-details th, .payment-details td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .payment-details th {
            background-color: #f7fafc;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }
        .footer a {
            color: #3182ce;
            text-decoration: none;
        }
        .status {
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 4px;
        }
        .status.completed {
            background-color: #48bb78;
            color: white;
        }
        .status.pending {
            background-color: #ecc94b;
            color: white;
        }
        .status.failed {
            background-color: #e53e3e;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Payment Receipt</h2>
        <p>Dear {{ $payment->full_name }},</p>
        <p>Thank you for your payment. Below are the details of your transaction:</p>

        <div class="payment-details">
            <table>
                <tr>
                    <th>Reference</th>
                    <td>{{ $payment->reference }}</td>
                </tr>
                <tr>
                    <th>Full Name</th>
                    <td>{{ $payment->full_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $payment->email }}</td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td>{{ $payment->mobile }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $payment->address }}</td>
                </tr>
                <tr>
                    <th>Purpose</th>
                    <td>{{ $payment->purpose }}</td>
                </tr>
                <tr>
                    <th>Classification</th>
                    <td>{{ $payment->classification }}</td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="status @if($payment->status == 'completed') completed 
                            @elseif($payment->status == 'pending') pending
                            @else failed @endif">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>If you have any questions, feel free to <a href="mailto:support@yourdomain.com">contact us</a>.</p>
            <p>Thank you for choosing us!</p>
        </div>
    </div>

</body>
</html>

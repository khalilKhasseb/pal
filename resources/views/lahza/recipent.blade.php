<!DOCTYPE html>
<html dir="{{ $rtl ? 'rtl' : 'ltr' }}" lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ __('Payment Receipt') }}</title>
    <style>
        /* Using arabic-compatible font */
        @font-face {
            font-family: 'CustomArabic';
            src: url('{{ public_path('fonts/NotoSansArabic-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        @font-face {
            font-family: 'CustomArabic';
            src: url('{{ public_path('fonts/NotoSansArabic-Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        
        * {
            font-family: 'CustomArabic', DejaVu Sans, Arial, sans-serif;
            box-sizing: border-box;
        }
        
        body {
            direction: {{ $rtl ? 'rtl' : 'ltr' }};
            padding: 0;
            margin: 0;
            color: #333;
            line-height: 1.5;
            background-color: #fff;
            font-size: 12px; /* Reduced font size for better fit on one page */
        }
        
        .receipt-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
            position: relative;
        }
        
        /* Header with logo and organization info */
        .receipt-header {
            padding: 15px;
            background-color: #f9fcf7;
            border-bottom: 3px solid #78b843;
            text-align: center;
        }
        
        .logo-section {
            margin-bottom: 10px;
        }
        
        .logo-img {
            max-width: 120px;
            max-height: 60px;
            display: block;
            margin: 0 auto;
        }
        
        .header-text {
            text-align: center;
        }
        
        .receipt-title {
            color: #78b843;
            font-size: 22px;
            font-weight: bold;
            margin: 0 0 5px 0;
        }
        
        .receipt-subtitle {
            color: #4a6741;
            font-size: 14px;
            margin: 0 0 5px 0;
        }
        
        .receipt-number {
            font-size: 12px;
            color: #666;
            margin: 5px 0 0 0;
        }
        
        /* Main content */
        .receipt-content {
            padding: 15px;
            position: relative;
        }
        
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            position: relative;
            z-index: 1;
        }
        
        .details-table tr {
            border-bottom: 1px solid #eee;
        }
        
        .details-table tr:last-child {
            border-bottom: none;
        }
        
        .details-table td {
            padding: 8px;
            vertical-align: top;
        }
        
        .label {
            font-weight: bold;
            {{ $rtl ? 'text-align: right;' : 'text-align: left;' }}
            width: 40%;
            color: #4a6741;
        }
        
        .value {
            {{ $rtl ? 'text-align: left;' : 'text-align: right;' }}
            width: 60%;
        }
        
        /* Highlight the amount and status */
        .amount-value {
            font-size: 14px;
            font-weight: bold;
        }
        
        .success-status {
            color: #78b843;
            font-weight: bold;
        }
        
        .failed-status {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .pending-status {
            color: #f39c12;
            font-weight: bold;
        }
        
        /* Footer */
        .receipt-footer {
            padding: 15px;
            background-color: #f9fcf7;
            border-top: 1px solid #dbe9d3;
            font-size: 12px;
        }
        
        .contact-info {
            text-align: center;
            margin-bottom: 10px;
        }
        
        .contact-item {
            margin-bottom: 3px;
        }
        
        .contact-icon {
            color: #78b843;
            margin-right: 3px;
        }
        
        .transaction-info {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
            color: #777;
            border-top: 1px dashed #dbe9d3;
            padding-top: 10px;
        }
        
        .transaction-info p {
            margin: 3px 0;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(120, 184, 67, 0.07);
            z-index: 0;
            text-align: center;
            width: 100%;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- Header -->
        <div class="receipt-header">
            <div class="logo-section">
                <img src="{{ asset('/logo1.png') }}" alt="PALGBC Logo" class="logo-img">
            </div>
            <div class="header-text">
                <h1 class="receipt-title">{{ __('Payment Receipt') }}</h1>
                <p class="receipt-subtitle">{{ __('Official Transaction Record') }}</p>
                <div class="receipt-number">{{ __('Receipt No') }}: {{ $payment->reference }}</div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="receipt-content">
            <!-- Watermark -->
            <div class="watermark">{{ __('PAID') }}</div>
            
            <table class="details-table">
                <tr>
                    <td class="label">{{ __('Reference Number') }}:</td>
                    <td class="value">{{ $payment->reference }}</td>
                </tr>
                <tr>
                    <td class="label">{{ __('Date & Time') }}:</td>
                    <td class="value">{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td class="label">{{ __('Full Name') }}:</td>
                    <td class="value">{{ $payment->full_name }}</td>
                </tr>
                <tr>
                    <td class="label">{{ __('Email') }}:</td>
                    <td class="value">{{ $payment->email }}</td>
                </tr>
                <tr>
                    <td class="label">{{ __('Purpose') }}:</td>
                    <td class="value">{{ __(ucfirst($payment->purpose)) }}</td>
                </tr>
                <tr>
                    <td class="label">{{ __('Classification') }}:</td>
                    <td class="value">{{ __(ucfirst($payment->classification)) }}</td>
                </tr>
                <tr>
                    <td class="label">{{ __('Amount Paid') }}:</td>
                    <td class="value amount-value">{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</td>
                </tr>
                <tr>
                    <td class="label">{{ __('Status') }}:</td>
                    <td class="value success-status">{{ __(ucfirst($payment->status)) }}</td>
                </tr>
            </table>
        </div>
        
        <!-- Footer -->
        <div class="receipt-footer">
            <div class="contact-info">
                <div class="contact-item">
                    <span class="contact-icon">•</span> {{ __('Email') }}: admin@palgbc.org
                </div>
                <div class="contact-item">
                    <span class="contact-icon">•</span> {{ __('Address') }}: البيرة- شارع القدس- بالقرب من بلدية البيرة
                </div>
                <div class="contact-item">
                    <span class="contact-icon">•</span> {{ __('Working Days') }}: الأحد- الخميس
                </div>
            </div>
            
            <div class="transaction-info">
                <p>{{ __('This is an official receipt generated by') }} {{ config('app.name') }}</p>
                <p>{{ __('Transaction ID') }}: {{ $payment->id }}</p>
            </div>
        </div>
    </div>
</body>
</html>
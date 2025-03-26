<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Payment Receipt') }}</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f6f9fc; color: #333; {{ app()->getLocale() == 'ar' ? 'direction: rtl; text-align: right;' : 'direction: ltr; text-align: left;' }}">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="margin: 20px auto; background-color: #fff; border-radius: 5px;">
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #f9fcf7; padding: 20px; text-align: center; border-bottom: 3px solid #78b843;">
                            <img src="{{ $message->embed(public_path('/logo1.png')) }}" alt="PALGBC Logo" width="150" style="max-width: 150px;">
                            <h1 style="color: #78b843; margin: 10px 0 5px 0;">{{ __('Payment Receipt') }}</h1>
                            <p style="color: #4a6741; margin: 5px 0 0;">{{ __('Official Transaction Record') }}</p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 20px;">
                            <p>{{ __('Dear') }} {{ $payment->full_name }},</p>
                            <p>{{ __('Thank you for your payment. Below are the details of your transaction:') }}</p>
                            
                            <!-- Reference box -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 20px; background-color: #edf7e6; border-radius: 4px; {{ app()->getLocale() == 'ar' ? 'border-right: 4px solid #78b843;' : 'border-left: 4px solid #78b843;' }}">
                                <tr>
                                    <td style="padding: 10px;">
                                        <p style="margin: 0 0 5px 0;">{{ __('Your payment reference number is') }}</p>
                                        <span style="background-color: white; padding: 3px 8px; border-radius: 3px; border: 1px solid #dbe9d3; font-family: monospace; font-weight: bold;">{{ $payment->reference }}</span>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Payment details -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 20px; background-color: #f9fcf7; border-radius: 4px;">
                                <tr>
                                    <td style="padding: 15px; position: relative;">
                                        <!-- Watermark -->
                                        @if($payment->status == 'completed')
                                        <div style="position: absolute; top: 50%; left: 0; right: 0; text-align: center; color: rgba(120, 184, 67, 0.1); font-size: 50px; font-weight: bold; transform: rotate(-45deg);">{{ __('PAID') }}</div>
                                        @endif
                                        
                                        <!-- Details table -->
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="position: relative; z-index: 1;">
                                            <tr>
                                                <td width="40%" style="padding: 8px; border-bottom: 1px solid #dbe9d3; font-weight: bold; color: #4a6741;">{{ __('Reference') }}:</td>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3;">{{ $payment->reference }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3; font-weight: bold; color: #4a6741;">{{ __('Date & Time') }}:</td>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3;">{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3; font-weight: bold; color: #4a6741;">{{ __('Full Name') }}:</td>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3;">{{ $payment->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3; font-weight: bold; color: #4a6741;">{{ __('Email') }}:</td>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3;">{{ $payment->email }}</td>
                                            </tr>
                                            @if($payment->mobile)
                                            <tr>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3; font-weight: bold; color: #4a6741;">{{ __('Mobile') }}:</td>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3;">{{ $payment->mobile }}</td>
                                            </tr>
                                            @endif
                                            @if($payment->address)
                                            <tr>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3; font-weight: bold; color: #4a6741;">{{ __('Address') }}:</td>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3;">{{ $payment->address }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3; font-weight: bold; color: #4a6741;">{{ __('Purpose') }}:</td>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3;">{{ __(ucfirst($payment->purpose)) }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3; font-weight: bold; color: #4a6741;">{{ __('Classification') }}:</td>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3;">{{ __(ucfirst($payment->classification)) }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3; font-weight: bold; color: #4a6741;">{{ __('Amount') }}:</td>
                                                <td style="padding: 8px; border-bottom: 1px solid #dbe9d3; font-weight: bold; color: #78b843;">{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px; font-weight: bold; color: #4a6741;">{{ __('Status') }}:</td>
                                                <td style="padding: 8px;">
                                                    @if($payment->status == 'completed')
                                                    <span style="background-color: #def7ec; color: #046c4e; padding: 4px 8px; border-radius: 3px; font-weight: bold;">{{ __(ucfirst($payment->status)) }}</span>
                                                    @elseif($payment->status == 'pending')
                                                    <span style="background-color: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 3px; font-weight: bold;">{{ __(ucfirst($payment->status)) }}</span>
                                                    @else
                                                    <span style="background-color: #fee2e2; color: #b91c1c; padding: 4px 8px; border-radius: 3px; font-weight: bold;">{{ __(ucfirst($payment->status)) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fcf7; padding: 15px; text-align: center; border-top: 1px solid #dbe9d3; color: #4a6741; font-size: 13px;">
                            <p style="margin: 3px 0;">{{ __('Email') }}: <a href="mailto:admin@palgbc.org" style="color: #78b843; text-decoration: none;">admin@palgbc.org</a></p>
                            <p style="margin: 3px 0;">{{ __('Address') }}: {{ __('Al-Bireh, Jerusalem St., near Al-Bireh Municipality') }}</p>
                            <p style="margin: 3px 0;">{{ __('Working Days') }}: {{ __('Sunday-Thursday') }}</p>
                            <div style="margin-top: 10px; padding-top: 10px; border-top: 1px dashed #dbe9d3; font-size: 12px;">
                                <p style="margin: 3px 0;">{{ __('This is an official receipt generated by') }} {{ config('app.name') }}</p>
                                <p style="margin: 3px 0;">{{ __('Transaction ID') }}: {{ $payment->id }}</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
{{ $siteName }} verification code

Hello {{ $name }},

Your one-time password is: {{ $otp }}

This code expires in {{ $expiresInMinutes }} minutes ({{ $expiresAt->timezone(config('app.timezone'))->format('d M Y, h:i A') }}).

Never share this OTP with anyone. {{ $siteName }} will never ask for your verification code.

If you did not request this code, you can ignore this email.

<x-mail::message>
{{-- Logo --}}
<img src="{{asset('backend/assets/images/picg-logo.png')}}" alt="PICG Logo" width="120" style="margin-bottom: 20px;">

{{-- Greeting --}}
# Welcome to PICG!

{{-- Intro Text --}}
Hello {{ $user->name ?? 'User' }},

Thanks for signing up with PICG.  
Please verify your email address by clicking the button below:

{{-- Action Button --}}
<x-mail::button :url="$actionUrl" color="success">
Verify My Email
</x-mail::button>

{{-- Outro Text --}}
If you didn’t create this account, no further action is required.

{{-- Salutation --}}
Best regards,  
**The PICG Team**  
[www.picg.com](https://www.picg.com)

{{-- Subcopy --}}
<x-slot:subcopy>
If you're having trouble clicking the "Verify My Email" button, copy and paste the URL below into your web browser:  
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
</x-mail::message>

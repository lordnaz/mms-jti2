@component('mail::message')
# Hello!

Kindly refer below information and login through portal to proceed.

@component('mail::panel')
JTI No : # {{ $details['jti_no'] }}
<br>
Status: # {{ $details['status'] }}
<br>
Requester: {{ $details['requester'] }}
<br>
Assignee (PIC): {{ $details['pic_name'] }}
@endcomponent

@component('mail::button', ['url' => 'http://34.87.95.251/login', 'color' => 'success'])
To Portal
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

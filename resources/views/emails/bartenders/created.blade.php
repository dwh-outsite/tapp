@component('mail::message')
# Welcome to {{ config('app.name') }}

Hi bartender {{ $user->name }},

We created a TAPP account for you!
TAPP is used to keep track of all the bartenders but most importantly: it's the place where you can indicate you availability.
Once one of the bar schedulers chooses you as a bartender for a certain shift, TAPP will notify you!
Finally, you can always login to TAPP to quickly check your schedule.

You can login using your email **{{ $user->email }}** and the password **{{ $password }}**.

@component('mail::button', ['url' => config('app.url')])
Go to TAPP
@endcomponent

@component('mail::panel')
## IVA certificate

By the way, if you have an IVA certificate, please upload it in TAPP!
If we already have your certificate, we have already uploaded it for you.
You can upload a certificate or check whether it's already present in your **profile settings**.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# You Successfully Subscribed To Midi Plan

Congratulations {{ $user->name }} {{ $user->surname }}! You have successfully subscribed to our premium Midi Plan. You are now able to create 9 websites, have 500 photos
and 500 bits. You have subscribed to {{ $subscriptionType }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

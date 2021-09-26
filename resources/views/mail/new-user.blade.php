@component('mail::message')
# Welcome To Websiter

Welcome to Websiter {{ $user->name }} {{ $user->surname }}. Now, when you have verified your email address, it's time to build your first website using our awesome web building tools.
Feel free to give us a shout if you have any questions, any suggestions, or just say hi.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

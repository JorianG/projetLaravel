@component('mail::message')
# Welcome to {{ config('app.name') }}

Hello {{ $user->name }},

Thank you for joining our platform!

@component('mail::button', ['url' => config('app.url')])
Visit Our Site
@endcomponent

Best regards,<br>
{{ config('app.name') }}
@endcomponent 
@component('mail::message')
# New Grade Notification

Hello {{ $student->name }},

A new grade has been recorded for you.

- **Grade:** {{ $grade->note }}
- **Date:** {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}

@component('mail::button', ['url' => config('app.url')])
View Your Grades
@endcomponent

Best regards,<br>
{{ config('app.name') }}
@endcomponent 
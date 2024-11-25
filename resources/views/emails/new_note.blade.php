@component('mail::message')
# New Grade Notification

Bonjour {{ $student->nom }} {{ $student->prenom }},

Un nouvelle note vient d'être entrée.

- **Titre de l'évaluation :** {{ $grade->evaluation->titre }}
- **Date de l'évaluation:** {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
- **Module de l'évaluation :** {{ $grade->evaluation->module->name }}
- **Note:** {{ $grade->note }}

@component('mail::button', ['url' => config('app.url')])
Voir vos notes
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent 
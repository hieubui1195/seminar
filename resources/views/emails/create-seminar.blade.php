@component('mail::message')
# Introduction

@lang('custom.mail.invitation', [
	'seminar' => $seminar[0]->name,
	'start' => \Carbon\Carbon::parse($seminar[0]->start)->format('d F\, Y H:i A'),
	'end' => \Carbon\Carbon::parse($seminar[0]->end)->format('d F\, Y H:i A'),
	'code' => $seminar[0]->code,
])

@component('mail::button', ['url' => route('seminar.show', $seminar[0]->id) ])
@lang('custom.mail.goto')
@endcomponent

@lang('custom.mail.thanks'),<br>
{{ config('app.name') }}
@endcomponent

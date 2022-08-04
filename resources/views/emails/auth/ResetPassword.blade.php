@component('mail::message')
# Introduction

reset password in blood bank system

@component('mail::button', ['url' => 'http://127.0.0.1:8000/api/v1/reset_password'])
Button Text
@endcomponent

<p>your reset code is {{$code}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent


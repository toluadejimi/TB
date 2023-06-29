@component('mail::message')

Dear {{ $data1['name'] }},<br><br>

{{ __('Below are the details of your hosting') }}
<br><br>
{{ __('Hosting Data') }} <br>
<strong>{{ $data1['logdata'] }}</strong>.<br><br>


<br>

{{ __('Thank You') }}
 <br><br>
{{ config('app.name') }}

@component('mail::message')
  # {{$data['title']}}

  {{$data['body']}}

  {{$data['link']}}
  <br><br><br>

  {{$data['footer']}},<br>
  {{ config('app.name') }}
@endcomponent

@component('mail::message')
  # {{$data['title']}}

  {{$data['body']}}

  {{$data['link']}}
  <br><br><br>

  {{$data['footer']}},<br>
  {{ config('app.name') }}
@endcomponent
{{--<php>--}}
{{--  <!doctype html>--}}
{{--  <html lang="en">--}}
{{--  <head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--  </head>--}}
{{--  <body>--}}
{{--    test subscribe email--}}
{{--  </body>--}}
{{--  </html>--}}
{{--</php>--}}

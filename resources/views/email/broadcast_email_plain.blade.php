@extends('email.layout.layout')
@extends('email.layout.header')
@section('content')
  <div class="container">
    {!! $data['body'] !!}
  </div>
@endsection
@extends('email.layout.footer')
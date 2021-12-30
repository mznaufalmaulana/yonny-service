@extends('email.layout.layout')
@extends('email.layout.header')
@section('content')
  <div class="card">
    <div class="content-email">
      <div>
        <p class="title-email"><strong>Hello there,</strong><br> Thank you for your subscription. News product update will be ready for you.</p>
      </div>
      <div class="content-img">
        <img class="img-email" src="{{asset('image/contohBY.png')}}" alt="promo">
      </div>
      <div style="margin-top: 20px">
        Thank you, <br> <strong>BATUYONNY</strong>
      </div>
    </div>
  </div>
@endsection
@extends('email.layout.footer')

@extends('email.layout.layout')
@extends('email.layout.header')
@section('content')
  <div class="card">
    <div class="content-email">
      <div>
        <p class="title-email"><strong>Hello there,</strong><br> Thank you for your subscription. News update will be inform later.</p>
      </div>
      <div class="content-img">
        <img class="img-email" src="http://178.128.99.51:81/storage/promo/1638892412_contohBY.png" alt="promo">
      </div>
      <div style="margin-top: 20px">
        Thank you, <br> <strong>BATUYONNY</strong>
      </div>
    </div>
  </div>
@endsection
@extends('email.layout.footer')

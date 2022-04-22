@extends('email.layout.layout')
@extends('email.layout.header')
@section('content')
  <div class="card">
      <div class="content-email">
        <div>
          <p class="title-email"><strong>Hello there,</strong><br> New collection special for you . . . !!!</p>
        </div>
        <div class="content-img">
          <img class="img-email" src="{{'https://172.128.99.51:81/storage/'.$data['image']}}" alt="promo">
        </div>
        <div class="content-button">
          <a href="{{$data['link']}}">
            <button type="button" class="button-email"> LINK</button>
          </a>
        </div>
        <div>
          Thank you, <br> <strong>BATUYONNY</strong>
        </div>
      </div>
  </div>
@endsection
@extends('email.layout.footer')
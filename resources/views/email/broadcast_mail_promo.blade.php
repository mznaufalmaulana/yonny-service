@extends('email.layout.layout')
@extends('email.layout.header')
@extends('email.layout.footer')

@section('content')
  <div class="card">
    <div class="card-body">
      <div class="content-promo">
{{--        {{$data['photo']}}--}}
        <p class="card-title mt-2 mb-4"><strong>Hello there,</strong><br> New collection special for you . . . !!!</p>
        <img class="img-fluid rounded d-block mb-4 img-promo" src="http://178.128.99.51:81/storage/promo/1638892412_contohBY.png" alt="promo">
        <a href="{{$data['link']}}">
          <div class="text-center">
            <button type="button" class="btn btn-info mb-3 button-promo"> LINK</button>
          </div>
        </a>
        Thank you, <br> <strong>BATUYONNY</strong>
      </div>
    </div>
  </div>
@endsection
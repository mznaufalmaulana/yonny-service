<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Email</title>

  <style>
      .container{
          margin: 20px 50px;
      }
      .logo-by{
          margin: 0 auto;
          max-width: 300px;
      }

      .card {
          max-width: 800px;
          margin: 0 auto;
          float: none;
          margin-bottom: 30px;
      }

      .title-email{
          font-size: 14pt;
      }

      .content-email{
          padding: 30px 30px 30px 30px;
          background-color: white;
          border-radius: 5px;
      }

      .content-img{
          margin-top: 30px;
      }

      .img-email{
          max-width: 100%;
          border-radius: 5px;
      }

      .content-button{
          margin: 20px auto;
          background-color: white;
          text-align: center;
      }

      .button-email{
          width: 150px;
          height: 35px;
          border-radius: 5px;
          border: none;
      }

      .button-email:hover{
          color: #e8e5ef;
          background-color: #E69519;
          border-radius: 5px;
          border: none;
      }

      .footer-email{
          margin-bottom: 20px;
      }

      .footer-text{
          font-size: 9pt;
          text-align: center;
      }
  </style>

</head>
<body class="body">
  @yield('header')
  @yield('content')
  @yield('footer')

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
  

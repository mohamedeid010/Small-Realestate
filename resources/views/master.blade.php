<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('css/custom.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-8 col-xs-12">
      @yield('content')
    </div>
    <div class="col-md-4 col-xs-12">
      <ul class="list-group">
        <li class="list-group-item"><a href="/home">الرئيسية</a></li>
        <li class="list-group-item"><a href="{{route('details')}}">الخصائص</a></li>
        <li class="list-group-item"><a href="{{route('realestates')}}">العقارات</a></li>
        <li class="list-group-item"><a href="{{route('offers')}}">العروض</a></li>
      </ul>
  </div>
  </div>
</div>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script>
      @if(Session::has('success'))
        toastr.success('{{Session::get('success')}}');
      @endif
</script>
</body>
</html>

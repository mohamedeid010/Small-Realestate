<!DOCTYPE html>
<html lang="en">
<head>
  <title>العقارات</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link href="//db.onlinewebfonts.com/c/0387a0b8b59d6b26cb736ec76d5045b0?family=Cairo" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('css/custom.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid navbar-fluid-container">
  <nav class="container">
    <div class="navbar">
      <div class="navbar-header">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('images/logo.png')}}" alt="realestate"/>
        </a>
      </div>
      <ul class="nav navbar-nav">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right logout-dropdown" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('تسجيل خؤوج') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
      </ul>
    </div>
  </nav>
</div>
<div class="container main-contenrt">
  <div class="row">
    <div class="col-md-8 col-xs-12">
      @yield('content')
    </div>
    <div class="col-md-4 col-xs-12">
      <ul class="list-group">
        <li class="list-group-item"><a href="/home">الرئيسية</a></li>
        <li class="list-group-item"><a href="{{route('details')}}">الخصائص</a></li>
        <li class="list-group-item"><a href="{{route('realestates')}}">العقارات</a></li>
      </ul>
  </div>
  </div>
</div>
<div style="display:none">
  <div class="price-div1">
  <div class="row repeater">
    <div class="col-md-12"><a href="#" class="remove-season btn btn-danger">حذف</a></div>
    <div class="col-md-6"><span>السعر : </span><input type="text" name="price[]"/></div>
      <div class="col-md-6"><span>الموسم : </span><input type="text" name="seasonname[]"/></div>
      <div class="col-md-6"><span class="from">الي : </span><input type="date" name="to[]"/></div>
      <div class="col-md-6"><span class="from">من  : </span><input type="date" name="from[]"/></div>
  </div>
</div>

</div>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script>
      @if(Session::has('success'))
        toastr.success('{{Session::get('success')}}');
      @endif
  $('document').ready(function(){
    $('.addrepeat').click(function(){
      var repeated_content = $('.price-div1').html();
      $('.price-div').append(repeated_content);
      return false;
    });
    $(document.body).on('click', ".remove-season", function(){
        $(this).parents('.repeater').remove();
        return false;
    });
    //// ajax remove seasons
    $('.remove-active').click(function(){
      var hrefattrb= $(this).attr('href');
      alert(hrefattrb);
           $.ajax({
          type: "Get",
          url: "{{route('removeseason')}}",
          data: {'id':hrefattrb},
          cache: false,
          success: function(data){
             //$("#resultarea").text(data);
             console.log(data);
          }
        });

    });
  });
</script>
</body>
</html>

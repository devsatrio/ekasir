<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Lockscreen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition lockscreen">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <img src="{{asset('assets/dist/img/user1-128x128.jpg')}}" alt="User Image">
            <br>
            <a href="#"><b>E</b>-Kasir 1.0</a>
        </div>
        <div class="text-center">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/home') }}" class="btn btn-success">Home</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-danger">Register</a>
            @endif
            @endauth
            @endif

        </div>
        <div class="lockscreen-footer text-center">
            Dibuat oleh <b><a href="#" class="text-black">HambaAllah</a></b>
        </div>
    </div>
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
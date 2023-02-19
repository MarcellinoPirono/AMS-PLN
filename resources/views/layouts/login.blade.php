<!DOCTYPE html>
<html>
<head>
	<title>Login Sipakainga - PLN UP3-MAKASSAR SELATAN</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/') }}./asset/frontend/images/icon.svg" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link href="{{ asset('/') }}./asset/frontend/css/login_style.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>



	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body id="particles-js">
    @include('sweetalert::alert')
    <div class="animated bounceInDown">
      <div class="container">
        <span class="error animated tada" id="msg"></span>
        <form method="POST" action="{{ route('login')}}" name="form1" class="box" onsubmit="return checkStuff()">
          @csrf
          <h4>SIPAKAINGA <span>PLN UP3 MKS-SELATAN</span></h4>
          <h5>Silahkan Login Dengan Akun Anda.</h5>
            <input type="text" name="username" placeholder="username" autocomplete="off">
            <i class="typcn typcn-eye" id="eye"></i>
            <input type="password" name="password" placeholder="Passsword" id="password" autocomplete="off">
            {{-- <label>
              <input type="checkbox">
              <span></span>
              <small class="rmb">Remember me</small>
            </label> --}}
            {{-- <a href="#" class="forgetpass">Forget Password?</a> --}}
            {{-- <input type="submit" value="Sign in" class="btn1"> --}}
            <button type="submit" class="btn1" >Log In</button>
          </form>
            {{-- <a href="#" class="dnthave">Don’t have an account? Sign up</a> --}}
      </div>

    </div>


    <script src="https://cldup.com/S6Ptkwu_qA.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/login.js"></script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN</title>
	<link href="{{ asset('img/prod.png') }}" rel="icon">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrapp.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/utill.css">
	<link rel="stylesheet" type="text/css" href="css/mainn.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('img/image.jpg');">
			<div class="wrap-login100">
        <img class="img-fluid  d-block mx-auto" src="img/pro.png" alt="">
				<span class="login100-form-title p-b-34 p-t-27">
					Log in
				</span>
        <div id="login-page">
          <div class="container">
            <form class="form-login" method="POST" action="{{ url(action('LoginController@postLogin')) }}">
              <div class="login-wrap">
                <input title="E-mail Or Username" type="text" autocomplete="off" class="form-control" id="inputEmailUser" name="inputEmailUser" {{ old('inputEmailUser') }} placeholder="E-mail Or Username" autofocus required><br>
                <input title="password" type="password" class="form-control" id="myInput" name="password" placeholder="Password" minlength="6" required>
                <p style="color:#ffff;"><input type="checkbox" onclick="myFunction()"> Show Password</p>
                <div class="container-login100-form-btn">
                  <button class="login100-form-btn" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                  {{ csrf_field() }}
                  @include('formerrors')
                </div>
              </form><hr>
              <!-- <center><a style="color:#ffff;" data-toggle="modal" href="#myModal">Forgot Password?</a></center> -->
              <div class="registration text-center" style="font-weight: bold;color:white">
                <label for=""> Don't have an account yet?</label>
                <a href="daftar" style="color:#01ffff">
                  Create an account
                </a>
              </div>
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>
	
  <!-- Modal Forgot Password -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Forgot Password ?</h4>           
        </div>
        <form>
        <div class="modal-body">
            <p>Enter your e-mail address below to reset your password.</p>
            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
            <input type="text" placeholder="Masukan Username anda" class="form-control">

        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
          <button class="btn btn-primary" type="button">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/bootstrapp.min.js"></script>
	<script src="js/mainn.js"></script>
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
</body>
</html>
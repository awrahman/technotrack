<!DOCTYPE html>
<html lang="en">
<head>
<title>Techno Track | Reset Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Custom Theme files -->
<link href="{{asset('public/assets/frontend/css/firstLogin.css')}}" rel="stylesheet" type="text/css" media="all" />
<link rel="shortcut icon" href="{{asset("public/assets/frontend/images/techno/favicon/favicon2.png")}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="{{asset("public/assets/frontend/css/bootstrap.min.css")}}">
<link rel="stylesheet" href="{{asset("public/assets/frontend/css/fontawesome.css")}}">
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<!-- //web font -->

<style>
    input[type=checkbox]{
  visibility: hidden;
  opacity: 0;
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  display: none;
}

input[type=checkbox] ~ label {
  position: relative;
  padding-left: 24px;
  cursor: pointer;
}

input[type=checkbox] ~ label:before {
  content: "";
  font-family: 'Font Awesome 5 free';
  font-weight: 700;
  position: absolute;
  left: 0;
  top: 5px;
  border: 1px solid #dddddd;
  height: 15px;
  width: 15px;
  line-height: 1;
  font-size: 13px;
}

input[type=checkbox]:checked ~ label {
  color: #1cb9c8;
}

input[type=checkbox]:checked ~ label:before {
  content: "\f00c";
  color: #1cb9c8;
  border-color: #1cb9c8;
}
</style>

</head>
<body>
	<!-- main -->
	<div class="main-agile">
		<h3>Welcome to Techno Track</h3>
		<div class="content">
			<div class="top-grids" style="margin: auto">
				<div class="top-grids-right">
					<div class="signin-form reset-password">
						<h3>Login</h3>
						<form action="{{ route('login') }}" method="post">
						    @csrf
							<input type="text" placeholder="Phone Number" name="phone" required autocomplete="phone">
							<input type="password" placeholder="Repeat Password" name="password" required autocomplete="current-password">
							<input name="remember" type="checkbox" class="form-check-input1 checkbox" id="exampleCheck1" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label checkmark" for="exampleCheck1">{{ __('Remember Me') }}</label>
							<input type="submit" class="send" value="Login">
						</form>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		<div class="copyright">
			<p> © 2021 TechnoTrack Solutions BD. All rights reserved.</p>
		</div>
	</div>	
	<!-- //main --> 
	
	<!-- Js Files -->
    <script src="{{asset('public/assets/frontend/js/jquery.min.js')}}"></script>
   
    <script src="{{asset('public/assets/frontend/js/bootstrap.min.js')}}"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
              toastr.error('{{ $error }}','Error',{
                  closeButton:true,
                  progressBar:true,
               });
        @endforeach
    @endif
</script>
</body>
</html>
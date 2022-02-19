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
<!-- //Custom Theme files -->
<!-- web font -->
<!--<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">-->
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-agile">
		<h3>Welcome to Techno Track. This is your first time login</h3>
		<div class="content">
			<div class="top-grids">
				<div class="top-grids-right">
					<div class="signin-form reset-password">
						<h3>Reset Password</h3>
						<form action="{{route('password_reset')}}" method="post">
						    @csrf
							<input type="password" placeholder="Password" name="resetPassword" required="" autocomplete="false">
							<input type="password" placeholder="Repeat Password" name="repeatResetPassword" required="" autocomplete="false">
							<input type="submit" class="send" value="Update Password">
						</form>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		<div class="copyright">
			<p> © 2022 TechnoTrack Solutions BD. All rights reserved.</p>
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
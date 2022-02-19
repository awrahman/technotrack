@extends('frontend.layout.app3')
@section('title','Login')
@push('css')
@endpush
@section('content')
@if(session()->has('message'))
    <div class="alert alert-success text-center">
        {{ session()->get('message') }}
    </div>
@endif

<!--Login-->
		<section class="w3l-forms-main-61">
			<div class="form-inner">
				<div class="container">
					<div class="form-bg-blur">
						<div class="form-61">
							<h4 class="form-head">TechnoTrack LOGIN</h4>

							<form  id="reg_form" action="{{ route('login') }}" method="post">
							    @csrf
								<div class="mb-3">
									<p class="text-head">Username</p>
									<input type="number" name="phone" pattern=".{11,11}" class="input" value="{{ old('phone') }}" required autocomplete="phone" autofocus />
								</div>
								<div class="mb-3">
									<p class="text-head">Password</p>
									<input type="password" name="password" class="input" required autocomplete="current-password" />
								</div>
								<label class="remember">
									<input type="checkbox" name="remember">
									<span class="checkmark"></span>Keep me logged in
								</label>
								<button type="submit" class="signinbutton btn">Get started</button>
								<!--<p class="signup">Forgot password?<a href="#forgot" class="signuplink">Click here</a>-->
								</p>
							</form>
						</div>
					</div>
					
					<div class="go-to-home text-center">
						<p>Don't have an account yet? <a class="btn" href="{{route('user_registration')}}"> Signup </a></p>
					</div>
				</div>
			</div>
		</section>
		<!-- //login-->

@endsection
@push('js')
@endpush

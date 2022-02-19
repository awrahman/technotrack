@extends('frontend.layout.app3')
@section('title','Registration')
@push('css')
    <style>
        .note{
            text-align: center;
            background: -webkit-linear-gradient(left, #f15922, #ce3600);
            color:
            #fff;
            font-weight: bold;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .form-content {
            background:
            white;
            padding: 4%;
            border: 1px solid
            #ced4da;
            margin-bottom: 2%;
        }
        #reg_form .form-group input {
            background: rgba(22, 70, 158, .18);
            color: #17479e;
        }
        .custom-select {
            background: rgba(22, 70, 158, .18);
            color: #17479e;
        }
    </style>
@endpush

@section('content')

@if(session()->has('message'))
    <div class="alert alert-success text-center">
        {{ session()->get('message') }}
    </div>
@endif

        <section class="w3l-forms-main-61">
            <div class="row">
                <div class="col-mid-12" style="margin: auto;">
			        <div class="form-inner">
				        <div class="container">
					        <div class="form-register">
						        <div class="form-61">
							        <h4 class="form-head">Register New Account</h4>
							        <h8 class="text-danger text-center">All field's are required below</h8>
							
							        <form id="reg_form" method="POST" action="{{route('user_registration_store')}}">
                                    @csrf
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="mb-3">
                                                    <p class="text-head">Name <span class="text-danger">*</span></p>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="mb-3">
                                                    <p class="text-head">Address <span class="text-danger">*</span></p>
                                                    <input type="text" class="form-control" id="par_add" name="par_add" placeholder="Enter your address details"  autocomplete="off" value="{{ old('par_add') }}">
                                                    @if ($errors->has('par_add'))
                                                        <span class="text-danger">{{ $errors->first('par_add') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="mb-3">
                                                    <p class="text-head">E-mail <span class="text-danger">*</span></p>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your valid email address" value="{{ old('email') }}" autocomplete="off">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="mb-3">
                                                    <p class="text-head">Mobile Number <span class="text-danger">*</span></p>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">+88</div>
                                                        </div>
                                                        <input type="text" pattern=".{11,11}" max="11" class="form-control" id="phone" name="phone" placeholder="Enter your mobile number" autocomplete="off">
                                                        @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="mb-3">
                                                    <p class="text-head">Password  <span class="text-danger">*</span></p>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Your password" autocomplete="off">
                                                </div>
                                                @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="mb-3">
                                                    <p class="text-head">Retype Password  <span class="text-danger">*</span></p>
                                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Confirm password" autocomplete="new-password">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="mb-3">
                                                    <p class="text-head">Vehicle Registration number  <span class="text-danger">*</span></p>
                                                    <input type="text" class="form-control"  placeholder="Vehicle Registration Number"  name="car_number">

                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="mb-3">
                                                    <p class="text-head">Vehicle Type  <span class="text-danger">*</span></p>
                                                    <input type="text" class="form-control"  placeholder="Vehicle Brand & Model" id="car_model" name="car_model" value="{{ old('car_model') }}">
                                                    @if ($errors->has('car_model'))
                                                        <span class="text-danger">{{ $errors->first('car_model') }}</span>
                                                 @endif
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="save" class="signinbutton btn" data-bs-hover-animate="pulse">
                                            Register
                                        </button>
                                    </form>
					            </div>
					        </div>
							    <div class="go-to-home text-center">
					                <p>Already have an account? <a class="btn" href="{{route('user_login')}}"> Login </a></p>
				                </div>
				        </div>
			        </div>
		        </div>
		    </div>
		</section>

@endsection
@push('js')
@endpush

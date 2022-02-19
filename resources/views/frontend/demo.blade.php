@extends('frontend.layout.app3')
@section('title','Demo Account')
@push('css')
@endpush

@section('content')



		<!--/contact-->

		<!-- /contact-form -->
		<section class="w3l-contact-main">
			<div class="contact-infhny py-5">
				<div class="container py-lg-3">
					<div class="title-content text-center mb-lg-4 mb-4">
						<h3 class="hny-title">Request a <span>Demo</span> account</h3>
					</div>
					<div class="row align-form-map">
		                <div class="map col-lg-6 pl-lg-5 text-center mb-5">
			                <img src="{{asset('public/assets/frontend/images/techno/demo.jpg')}}" width="430" alt="" class="image-fluid" />
					    </div>
						
						<div class="col-lg-6 form-inner-cont">
							<form action="{{ route('demo_add') }}" method="post" class="signin-form">
							    @csrf
								<div class="form-input">
									<label for="name">Name*</label>
									<input type="text" name="name" id="name" placeholder="You name Sir?" />
								</div>
								<div class="form-input">
									<label for="senderPhone">Phone Number*</label>
									<input type="number" name="phone"  pattern=".{11,11}" id="senderPhone" placeholder="May we have your phone number sir?" required="" />
								</div>
								<div class="form-input">
									<label for="senderEmail">Email*</label>
									<input type="email" name="email" id="senderEmail" placeholder="Enter your email and rest assured we never spam" required="" />
								</div>
								<div class="form-input">
									<label for="senderSocial">Social media</label>
									<input type="text" name="social" id="senderSocial" placeholder="Facebook@TechnoTrackBD"/>
								</div>

								<button type="submit" class="btn btn-contact">Submit</button>

							</form>
						</div>
					</div>
				</div>
		</section>
		<!-- //contact-form -->
		<!--//contact-->
@endsection
@push('js')
@endpush

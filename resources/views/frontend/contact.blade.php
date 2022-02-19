@extends('frontend.layout.app3')
@section('title','Contact us')
@push('css')
@endpush
@section('content')

		<!--/contact-->
		@if($contact->count() > 0)
		<!-- /contact-blocks -->
		<section class="w3l-contact-main">
			<div class="contant11-top-bg py-5">
				<div class="container py-md-5">
					<div class="row contact-info-left text-center">
						<div class="col-lg-4 col-md-6 contact-info">
							<div class="contact-gd">
								<span class="fa fa-location-arrow" aria-hidden="true"></span>
								<h4>Address</h4>
								<p>{{$contact->first()->address}}</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 contact-info">
							<div class="contact-gd">
								<span class="fa fa-phone" aria-hidden="true"></span>
								<h4>Phone</h4>
								<p><a href="tel:{{$contact->first()->header_phone_1}}">Sales: {{$contact->first()->header_phone_1}}</a></p>
								<p><a href="tel:{{$contact->first()->header_phone_3}}">Support: {{$contact->first()->header_phone_3}}</a></p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 contact-info">
							<div class="contact-gd">
								<span class="fa fa-envelope-open-o" aria-hidden="true"></span>
								<h4>Mail</h4>
								<p><a href="mailto:{{$contact->first()->email}}" class="email">{{$contact->first()->email}}</a></p>
							</div>
						</div>
					</div>
				</div>
		</section>
		<!-- //contact-blocks -->
		@endif
		<!-- /contact-form -->
		<section class="w3l-contact-main">
			<div class="contact-infhny py-5">
				<div class="container py-lg-3">
					<div class="title-content text-left mb-lg-4 mb-4">
						<h3 class="hny-title">Get in touch <span>with us</span></h3>
					</div>
					<div class="row align-form-map">
						<div class="col-lg-6 form-inner-cont">
							<form action="{{ route('contact_us') }}" method="post" class="signin-form">
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
									<label for="senderMessage">Message*</label>
									<textarea placeholder="How may we help you sir?" name="message" id="senderMessage" required=""></textarea>
								</div>

								<button type="submit" class="btn btn-contact">Submit</button>

							</form>
						</div>
						<div class="map col-lg-6 pl-lg-5">
							<iframe
								src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCsYCzALgQI48K_I_Zwsg8mqxunNejTY0c&q=place_id:EiVLYWxseWFucHVyIE1haW4gUmQsIERoYWthLCBCYW5nbGFkZXNoIi4qLAoUChIJCdIPKb_AVTcR7CmQ192DGMkSFAoSCYFrAoewuFU3EcIEWd27Y6WP&key=AIzaSyBTT_u2HcERrbpkHiHndrfSnteAul0FQrU"
								frameborder="0" allowfullscreen=""></iframe>
						</div>
					</div>
				</div>
		</section>
		<!-- //contact-form -->
		<!--//contact-->
@endsection
@push('js')
@endpush

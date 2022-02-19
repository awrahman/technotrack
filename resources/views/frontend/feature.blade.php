@extends('frontend.layout.app3')
@section('title','Feature')
@push('css')
@endpush
@section('content')




<!--services-2-->
		<section class="w3l-services-2 w3l-services-1">
			<div class="services-2-content py-5" id="services">
				<div class="container py-lg-5 py-md-4">
					<div class="title-head text-center mb-lg-5 mb-4">
						<h3 class="hny-title">Our <span>Features</span> </h3>
						<p class="ser-para">Lorem ipsum dolor sit amet consectetur adipisicing elit.<span class="p-ab">
								Eligendi suscipit
								hic, aut aperiam
								alias
								corporis. Lorem ipsum dolor sit amet, elit. Quasi?</span></p>
					</div>
					<!-- /give-set1-->
					<div class="give-set1 mb-5 pt-3">
						<h4 class="hny-title mb-3">Vehicle <span>Security</span></h4>
						<div class="row">
	                        @foreach($feature as $data)
							<div class="col-md-3 col-6 mt-4">
								<a href="#">
									<div class="serhny-item">
										<!--<span class="fa fa-plug" aria-hidden="true"></span>-->
										<img src="{{asset('storage/app/public/feature/'.$data->image)}}" style="padding: 10px" width="auto">
										<p>{{$data->name}}</p>
									</div>
								</a>
							</div>
	                        @endforeach
						</div>
					</div>
					<!-- /give-set1-->
					{{--<div class="give-set1 mt-lg-4 mb--sm-5 mb-4 pt-sm-4 pt-3">
						<h4 class="hny-title mb-3">Laundry <span>Services</span></h4>
						<div class="row">
							<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
								<a href="services.html">
									<div class="serhny-item">
										<span class="fa fa-eraser" aria-hidden="true"></span>
										<p>Carpet Wash</p>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-6 mt-4">
								<a href="services.html">
									<div class="serhny-item">
										<span class="fa fa-columns" aria-hidden="true"></span>
										<p>Curtain Wash</p>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
								<a href="services.html">
									<div class="serhny-item">
										<span class="fa fa-folder-open" aria-hidden="true"></span>
										<p>Wash & Fold</p>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
								<a href="services.html">
									<div class="serhny-item">
										<span class="fa fa-database" aria-hidden="true"></span>
										<p>Steam Iron</p>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
								<a href="services.html">
									<div class="serhny-item">
										<span class="fa fa-columns" aria-hidden="true"></span>
										<p>Dry Cleaning</p>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
								<a href="services.html">
									<div class="serhny-item">
										<span class="fa fa-chain-broken" aria-hidden="true"></span>
										<p>24/7 Tracking using all type of devices</p>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
								<a href="services.html">
									<div class="serhny-item">
										<span class="fa fa-chain-broken" aria-hidden="true"></span>
										<p>Shoe Laundry</p>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
								<a href="services.html">
									<div class="serhny-item">
										<span class="fa fa-chain-broken" aria-hidden="true"></span>
										<p>Shoe Laundry</p>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
								<a href="services.html">
									<div class="serhny-item">
										<span class="fa fa-chain-broken" aria-hidden="true"></span>
										<p>Shoe Laundry</p>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
								<a href="services.html">
									<div class="serhny-item">
										<span class="fa fa-chain-broken" aria-hidden="true"></span>
										<p>Shoe Laundry</p>
									</div>
								</a>
							</div>
							<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
								<a href="services.html">
									<div class="serhny-item mt-2">
										<span class="fa fa-chain-broken" aria-hidden="true"></span>
										<p>Shoe Laundry</p>
									</div>
								</a>
							</div>


						</div>
						<!-- /give-set1-->
						<div class="give-set1 mt-lg-4 mb-5 pt-5">
							<h4 class="hny-title mb-3">Cleaning <span>Services</span></h4>
							<div class="row">
								<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
									<a href="services.html">
										<div class="serhny-item">
											<span class="fa fa-eraser" aria-hidden="true"></span>
											<p>Carpet Cleaning</p>
										</div>
									</a>
								</div>
								<div class="col-md-3 col-6 mt-4">
									<a href="services.html">
										<div class="serhny-item">
											<span class="fa fa-columns" aria-hidden="true"></span>
											<p>Curtain Wash</p>
										</div>
									</a>
								</div>
								<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
									<a href="services.html">
										<div class="serhny-item">
											<span class="fa fa-folder-open" aria-hidden="true"></span>
											<p>Wash & Fold</p>
										</div>
									</a>
								</div>
								<div class="col-md-3 col-sm-6 col-6 mt-sm-4 mt-3">
									<a href="services.html">
										<div class="serhny-item mt-2">
											<span class="fa fa-bed" aria-hidden="true"></span>
											<p>Sofa Cleaning</p>
										</div>
									</a>
								</div>
							</div>
						</div>--}}
						<!-- /give-set1-->
					</div>
				</div>
		</section>
		<!-- //services-1-->

		<!--w3l-faq-6 -->
		<section class="w3l-faq-6">
			<div class="faqhny-content py-5">
				<div class="container py-lg-4">
					<div class="far-grids-top">
						<div class="faq-left">
							<span class="sub-title-1">FAQs</span>
							<h3 class="hny-title two">
								Quality service and Top class product.
							</h3>
						</div>

						<div class="faq-pagev">
							<ul>
							    @foreach($faq as $data)
								<li>
									<input type="checkbox" checked>
									<i></i>
									<h4>{{$data->title}}</h4>
									<p>{{$data->content}}</p>
								</li>
								@endforeach
							</ul>
						</div>
					</div>

				</div>
		</section>
		<!-- //w3l-faq-6-->

@endsection
@push('js')
@endpush

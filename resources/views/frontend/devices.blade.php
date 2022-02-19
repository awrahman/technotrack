@extends('frontend.layout.app3')
@section('title','Devices')
@push('css')
    <style>
        .card-body h5{
            font-weight: bold;
            text-align: center;
        }
    </style>
@endpush
@section('content')

<!--services-2-->
		<section class="w3l-services-2 w3l-services-1">
			<div class="services-2-content py-5" id="services">
				<div class="container py-lg-5 py-md-4">
					<div class="title-head text-center mb-lg-5 mb-4">
						<h3 class="hny-title">Our <span>Devices</span> </h3>
						<p class="ser-para">Lorem ipsum dolor sit amet consectetur adipisicing elit.<span class="p-ab">
								Eligendi suscipit
								hic, aut aperiam
								alias
								corporis. Lorem ipsum dolor sit amet, elit. Quasi?</span></p>
					</div>
					<!-- /give-set1-->
					<div class="give-set1 mb-5 pt-3">
						<h4 class="hny-title mb-3"><span>GPS</span> Tracking devices</h4>
						<div class="row">
	                        @foreach($device as $data)
							<div class="col-md-3 col-6 mt-4">
								<a href="#">
									<div class="serhny-item">
										<!--<span class="fa fa-plug" aria-hidden="true"></span>-->
										<img src="{{asset('storage/app/public/tracking_device/'.$data->image)}}" height="70px" style="padding: 10px" width="auto">
										<p>{{$data->device_name}}</p>
										<p class="card-text">{{$data->description}}</p>
									</div>
								</a>
							</div>
	                        @endforeach
						</div>
					</div>
					<!-- /give-set1-->
					
					<div class="title-head text-center mb-lg-5 mb-4">
						<h3 class="hny-title"><span>Features</span> Offered</h3>
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
										<img src="{{asset('storage/app/public/feature/'.$data->image)}}" height="70px" style="padding: 10px" width="auto">
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

@endsection
@push('js')
@endpush

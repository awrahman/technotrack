@extends('frontend.layout.app3')@section('title','Home')@push('css')@endpush@section('content')		<!-- main-slider -->		<section class="w3l-main-slider position-relative" id="home">			<div class="companies20-content">				<div class="owl-one owl-carousel owl-theme">					<div class="item">						<li>							<div class="slider-info banner-view">								<div class="banner-info">									<div class="container">										{{--<div class="banner-info-bg text-center">											<h4 class="sub-font">Live tracking</h4>											<h5>Tracking data is updated every single second! </h5>											<div class="banner-buttons mt-4">												<a class="btn btn-style-1 btn-primary" href="{{route('price_list')}}">Packages</a>											</div>										</div>--}}									</div>								</div>							</div>						</li>					</div>					{{--<div class="item">					    <video autobuffer controls autoplay>                            <source src="{{asset('public/assets/frontend/images/techno/ban27082020techno.mp4')}}" type="video/mp4">                            Your browser does not support the video tag.                        </video>					</div>					<div class="item">						<li>							<div class="slider-info  banner-view banner-top1 bg bg2">								<div class="banner-info">									<div class="container">										<div class="banner-info-bg text-center">											<h4 class="sub-font">Discover the Great Benefits</h4>											<h5>We Are the best Cleaning Service Provider</h5>											<div class="banner-buttons mt-4">												<a class="btn btn-style-1 btn-primary" href="#">Our													Services</a>											</div>										</div>									</div>								</div>							</div>						</li>					</div>					<div class="item">						<li>							<div class="slider-info banner-view banner-top2 bg bg2">								<div class="banner-info">									<div class="container">										<div class="banner-info-bg text-center">											<h4 class="sub-font">Easy Online Scheduling</h4>											<h5>We Cover Large Range of Cleaning Services </h5>											<div class="banner-buttons mt-4">												<a class="btn btn-style-1 btn-primary" href="#url">Our													Services</a>											</div>										</div>									</div>								</div>							</div>						</li>					</div>					<div class="item">						<li>							<div class="slider-info banner-view banner-top3 bg bg2">								<div class="banner-info">									<div class="container">										<div class="banner-info-bg text-center">											<h4 class="sub-font">Discover the Great Benefits</h4>											<h5>We Are the best Cleaning Service Provider</h5>											<div class="banner-buttons mt-4">												<a class="btn btn-style-1 btn-primary" href="#url">Our													Services</a>											</div>										</div>									</div>								</div>							</div>						</li>					</div>--}}				</div>			</div>		</section>		<!-- //banner-slider-->				@if(count($feature) > 0)		<!-- /featured-services-->		<section class="w3l-features-4" id="services">			<div class="features4-block py-5">				<div class="container py-lg-3">					<div class="title-head text-center mb-lg-5 mb-4">						<h6 class="sub-title">Most Popular</h6>						<h3 class="hny-title">							Our <span>Quality</span> Services</h3>					</div>					<div class="features4-grids text-left row">					@foreach($feature as $key=>$data)					@break($key== 6)						<div class="features4-grid">							<div class="features4-grid-inn">								<div class="mb-2">									<span><img src="{{asset('storage/app/public/feature/'.$data->image)}}" height="70px" /></span>								</div>								<h5><a href="{{route('feature')}}">{{$data->name}}</a></h5>							{{--	<p>{{$data->name}}</p>--}}								<div class="read-arrow text-right mt-md-4 mt-3">									<a href="{{route('feature')}}"><span class="fa fa-arrow-right"											aria-hidden="true"></span></a>								</div>							</div>						</div>					@endforeach					</div>				</div>			</div>		</section>		<!-- //featured-services-->		@endif				<!-- /content-6-section -->		<section class="w3l-wecome-content-6">			<!-- /content-6-section -->			<div class="ab-content-6-mian py-5">				<div class="container py-lg-3">					<div class="title-head text-left mb-4">						<h6 class="sub-title">Our Introduction</h6>						<h3 class="hny-title">							The Best <span>Tracking Services</span> </h3>					</div>					@foreach($service as $key=>$data)					@break($key== 4)					@if ($loop->odd)					@if($loop->last)					<div class="align-items-center row">					@else					<div class="align-items-center row" style="margin-bottom: 5%;">					@endif					    <div class="col-lg-6 imgshow mx-auto">							<img src="{{asset('storage/app/public/service/'.$data->image)}}" class="img-fluid mt-lg-0 mt-3" alt="" />						</div>						<div class="col-lg-6 mb-lg-0">						    <p class="mb-4"><h6 class="sub-title">{{$data->title}}</h6></p>							<p class="mb-4 text-justify">{{str_limit($data->description,600)}}</p>							<a class="btn btn-style btn-primary mt-lg-4 mt-3" href="#url">Read More</a>						</div>						<div class="col-lg-6 imghide">							<img src="{{asset('storage/app/public/service/'.$data->image)}}" class="img-fluid mt-lg-0 mt-3" alt="" />						</div>					</div>					@else					@if($loop->last)					<div class="align-items-center row">					@else					<div class="align-items-center row" style="margin-bottom: 5%;">					@endif					    <div class="col-lg-6">							<img src="{{asset('storage/app/public/service/'.$data->image)}}" class="img-fluid mt-lg-0 mt-3" alt="" />						</div>					    <div class="col-lg-6 mb-lg-0">						    <p class="mb-4"><h6 class="sub-title">{{$data->title}}</h6></p>							<p class="mb-4 text-justify">{{str_limit($data->description,600)}}</p>							<a class="btn btn-style btn-primary mt-lg-4 mt-3" href="#">Read More</a>						</div>					</div>					@endif                    @endforeach				</div>			</div>		</section>		<!-- //content-6-section -->        <!--pricing-16-->		<section class="w3l-pricing-16-sec">			<div class="pricing-content py-5">				<div class="container py-lg-3">					<div class="title-content text-center mb-lg-5 mt-4">						<h6 class="sub-title">Price List</h6>						<h3 class="hny-title">Our <span>Packages</span></h3>					</div>					<div class="row w3l-pricing-grids mt-lg-5 mt-4">					    @foreach($price as $key=>$data)						<div class="price-main-hny-16">						    @if($data->id == 4)							<div class="pricehny-box active">							@else							    <div class="pricehny-box">							@endif								    <div class="price-top text-center">						                <div class="pricehny-icon">									        @if($data->id == 3)										    <span class="fa fa-{{$data->icon}}"></span>										    <span class="fa fa-{{$data->icon}}"></span>									    	@else										    <span class="fa fa-{{$data->icon}}"></span>							                @endif										</div>		    							<h3 class="price-heading">{{$data->name}}</h3>			    						<div class="price-text-top position-relative">				    						<h4>			        							<span class="price-symbol">Tk.</span>				        						<span class="price-number">{{$data->monthly_charge}}</span>					        					<span class="price-frequency">Monthly</span>						    			   </h4>						    			</div>							    		<h8><span style="color: var(--theme-hover)">Device price Tk.</span> <span style="color: var(--theme-color)">{{$data->device_price}}/-</span></h8>					    			</div>	    							<div class="price-bottom text-left">		    							<div class="pricehny-content">                                        @php($sub_cat = \App\Price_sub_category::where('price_id',$data->id)->get())                                        @foreach($sub_cat as $key=>$sub_data)                                            @break($key == 6)                                            @if($sub_data->active_status == 1)                                                <div style="text-transform: capitalize;" class="price-text-info">						    					    <span class="fa fa-check-circle"></span>							    				    {{$sub_data->name}}								    		    </div>                                            @else								                <div style="text-transform: capitalize;" class="price-text-info">										    	    <span class="fa fa-times-circle"></span>    											    {{$sub_data->name}}	    									    </div>                                            @endif                                        @endforeach				    					</div>					    			</div>					    			<div><p><a href="{{route('price_list')}}">More..</a></p></div>	    							<div class="buy-button">		    							<a class="btn btn-style btn-primary mt-3"			    						@if(\Illuminate\Support\Facades\Auth::check())                                            href="{{route('user.payment',$data->id)}}"                                        @else                                            href="{{route('guest_customer_order',$data->id)}}"                                        @endif>Buy Now</a>    								</div>	    						</div>	    					</div>	    					@endforeach		    			</div>		    		</div>	    		</div>            </div>	    </section>	    <!-- //pricing-16 -->		<!-- /content-4-section -->		<section class="w3l-content-4">			<!-- /content-6-section -->			<div class="content-4-main py-5">				<div class="container py-lg-5">					<div class="title-head text-center mb-4">						<h6 class="sub-title">Our Process</h6>						<h3 class="hny-title">How It <span>Works</span></h3>					</div>					<div class="content-info-in row">						<div class="content-left col-lg-6">							<img src="{{asset('public/assets/frontend/images/new/ab2.jpg')}}" class="img-fluid mt-lg-0 mt-3" alt="">						</div>						<div class="content-right col-lg-6 pl-lg-5">													<div class="row content4-right-grids mb-3">								<div class="col-md-2 content4-right-icon">									<div class="content4-icon">										<span class="fa fa-file-text"></span>									</div>								</div>								<div class="col-md-10 content4-right-info pl-lg-0 list1">									<h6><a href="#">Book Service</a></h6>									    <p><ul>									        <li><span class="fa fa-shopping-cart"></span> Compare and pick your package that best suits you from our versatile options available <a href="https://www.technotrack.com.bd/price_list" style="color:blue" target="_blank">HERE</a>!</li>									        <li><span class="fa fa-facebook"></span> Order from our 24/7 accessable sales team available at your service via our official <a href="https://www.facebook.com/TechnoTrackBD" style="color:blue" target="_blank">facebook page</a></li>									        <li><span class="fa fa-phone"></span> Or call us at <a href="tel:01712212518" style="color:blue">01712212518</a> whenever you need!</li>									    </ul></p>								</div>							</div>							<div class="row content4-right-grids mb-3">								<div class="col-md-2 content4-right-icon">									<div class="content4-icon">										<span class="fa fa-sliders"></span>									</div>								</div>								<div class="col-md-10 content4-right-info pl-lg-0">									<h6><a href="#">											Service Delivery</a></h6>											<p><ul>									        <li><span class="fas fa-toolbox"></span> Soon as you place your order a TechnoTrack agent will contact you to confirm your order! Once confirmed a technitian will be at your service no matter wherever your are, at our cost!</li>									        <li><span class="fas fa-info"></span> Our technitian will help you with installing the app and guide you through how it works.</li>									        </ul></p>								</div>							</div>							<div class="row content4-right-grids">								<div class="col-md-2 content4-right-icon">									<div class="content4-icon">										<span class="fa fa-thumbs-up"></span>									</div>								</div>								<div class="col-md-10 content4-right-info pl-lg-0">									<h6><a href="#">											Payment & Track</a></h6>											<p><ul>									        <li><span class="fas fa-money-check-alt"></span> Once installed you may pay by cash, bKash, Nagad or Rocket for the installed device.</li>									        <li><span class="fas fa-bookmark"></span> A monthly service charge is also payable by your convenient payment method mentioned above.</li>									        <li><span class="fas fa-handshake"></span> <span class="rainbow-text">Congratulations!</span> We made it together. Now let's track the vehicle using our tracking <a href="http://176.9.100.216/authentication/create" style="color:blue;" target="_blank">tools</a> </li>									        </ul></p>								</div>							</div>						</div>					</div>				</div>			</div>		</section>		<!-- //content-4-section -->		<!-- portfolio -->		<section class="w3l-portfolio-8 py-5">			<div class="portfolio-main py-lg-3">				<div class="container-fluid">					<div class="title-content text-center">						<h6 class="sub-title">Our Service range</h6>						<h3 class="hny-title">Vehicles We<span>TRACK</span></h3>					</div>					<div class="row galler-top mt-4">					    @foreach($coverages as $data)						<div class="col-lg-4 col-md-6 hover14 mb-4 text-center">							<a href="{{asset('storage/app/public/coverages/'.$data->image)}}" data-lightbox="example-set"							data-title="{{$data->name}}">								<figure  class="imghvr-fold-up">									<img style="display: inline-block;" src="{{asset('storage/app/public/coverages/'.$data->image)}}" alt="techno track {{$data->name}}" class="img-fluid">								</figure>							</a>							{{--<p>{{$data->name}}</p>--}}						</div>						@endforeach					</div>				</div>			</div>		</section>		<!-- //portfolio -->		{{--<!-- /w3l-newsletter-->		<section class="w3l-newsletter">			<div class="form-25-mian py-5">				<div class="container py-lg-4">					<div class="forms-25-info">						<span class="sub-title-1">Stay Updated!</span>						<h3 class="hny-title two">Lets Stay <span>In Touch</span></h3>						<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p>								<form action="#" method="post" class="signin-form mt-4 mb-2">							<div class="forms-gds">										<input type="email" name="" placeholder="Email address" required />										<button class="btn"><span class="fa fa-envelope-o" aria-hidden="true"></span></button>							</div>							<p class="action-link">Subscribe to our free weekly newsletter for new update releases (no								spam)</p>								</form>					</div>				</div>			</div>		</section>		<!-- //w3l-newsletter-->--}}		<!-- /content-4-section -->		<section class="w3l-content-4">			<!-- /content-6-section -->			<div class="content-4-main py-5">				<div class="container py-lg-5">					<div class="title-head text-center mb-4">						<h6 class="sub-title">Our partners</h6>						<h3 class="hny-title">Device <span>Partners</span></h3>					</div>					<!-- Our DevicePartners -->                    @php($partners= \App\partner_showcase::where('status', 1)->where('partner_type', 1)->take(9)->inRandomOrder()->get())                    @if(count($partners)>0)                    <div class="row">                    @foreach($partners as $partners)                        <div class="col-lg-4 col-md-6 hover14 mb-4 text-center">                            <img class="res image-fluid" width="360" height="186" src="{{asset('storage/app/public/partner_image/'.$partners->image)}}" alt="">                        </div>                    @endforeach                    </div>                    @endif                    <!--// Our DevicePartners -->				</div>				<div class="container py-lg-5">					<div class="title-head text-center mb-4">						<h3 class="hny-title">Telecom <span>Partners</span></h3>					</div>					<!-- Telecom Partners -->                    @php($partners= \App\partner_showcase::where('status', 1)->where('partner_type', 2)->take(9)->inRandomOrder()->get())                    @if(count($partners)>0)                    <div class="row">                    @foreach($partners as $partners)                        <div class="col-lg-4 col-md-6 hover14 mb-4 text-center">                            <img class="res image-fluid" width="360" height="186" src="{{asset('storage/app/public/partner_image/'.$partners->image)}}" alt="">                        </div>                    @endforeach                    </div>                    @endif                    <!--// Telecom Partners -->				</div>			</div>		</section>		<!-- //content-4-section -->		@php($posts = \App\Blog_post::where('blog_status', 1)->inRandomOrder()->get())        @if(count($posts)>0)		<!-- /blognhy-grids-->		<section class="w3l-postnhy-grids">			<div class="postnhy-grids-inner py-5">				<div class="container py-lg-3">					<div class="title-head text-center mb-lg-5 mb-4">						<h6 class="sub-title">View Posts</h6>						<h3 class="hny-title">							Our <span>Latest</span> Posts</h3>					</div>					<!-- /owl-slider-->					<div class="posthny-slides pb-lg-5 pb-4">						<div class="owl-two owl-carousel owl-theme">							@foreach($posts as $blogs)							<div class="item">								<div class="posthny-grid mb-4">									<div class="posthny-grid-inn">										<a href="{{route('post_id',$blogs->id)}}"><img src="{{asset('storage/app/public/blogs/'.$blogs->blog_image)}}" class="img-fluid"												alt=""></a>										<h5><a href="{{route('post_id',$blogs->id)}}">{{$blogs->blog_title}}</a></h5>										<p>{{str_limit($blogs->blog_content,200)}}</p>										<div class="read-arrow text-right mt-md-4 mt-3">											<a href="{{route('post_id',$blogs->id)}}"><span class="fa fa-arrow-right"													aria-hidden="true"></span></a>										</div>									</div>								</div>							</div>                            @endforeach						</div>					</div>					<!-- //owl-slider-->				</div>			</div>		</section>		<!-- //posts-->		@endif		{{--<!-- middle -->		<div class="w3l-middle py-5">			<div class="container py-xl-5 py-lg-3">				<div class="row align-items-center">					<div class="welcome-left col-lg-6">						<div class="title-head text-left">							<h6 class="sub-title-1">We fix it</h6>							<h3 class="hny-title two">								Repairing the world one <span>light bulb </span> at a time.</h3>							<p class="mt-3">Lorem ipsum viverra feugiat. <span class="p-ab">Pellen tesque libero ut justo,								ultrices in ligula. Semper at tempufddfel.Lorem ipsum viverra feugiat. Pellen tesque								libero ut justo,.</span> </p>						</div>					</div>					<div class="welcome-right text-lg-right col-lg-6">						<a href="contact.html" class="btn btn-style-1 btn-primary mt-sm-5 mt-4">Contact Us</a>					</div>				</div>			</div>		</div>		<!-- //middle -->--}}		<!-- stats -->		<section class="w3l-stats py-5" id="stats">			<div class="gallery-inner container py-md-4">			    <div class="title-head text-center mb-4">					<h6 class="sub-title">Our Records</h6>					<h3 class="hny-title"><span>Connecting</span> Bangladesh</h3>				</div>				<div class="row stats-con text-white">					<div class="col-md-2 col-sm-4 stats_info counter_grid mt-md-0 mt-5">					    <span><img src="{{asset('public/assets/frontend/images/iconFont/cars64.png')}}"></span><br>						<p class="counter">{{count($cars)+982}}</p>						<h6>Cars connected</h6>					</div>					<div class="col-md-2 col-sm-4 stats_info counter_grid1 mt-md-0 mt-5">					    <span><img src="{{asset('public/assets/frontend/images/iconFont/motorcycle64.png')}}"></span><br>						<p class="counter">{{count($motorcycle)+714}}</p>						<h6>Motorbikes secured</h6>					</div>					<div class="col-md-2 col-sm-4 stats_info counter_grid2 mt-md-0 mt-5">					    <span><img src="{{asset('public/assets/frontend/images/iconFont/truck64.png')}}"></span><br>						<p class="counter">{{count($truck)+653}}</p>						<h6>Trucks connected</h6>					</div>					<div class="col-md-2 col-sm-4 stats_info counter_grid mt-md-0 mt-5">					    <span><img src="{{asset('public/assets/frontend/images/iconFont/excavator64.png')}}"></span><br>						<p class="counter">{{count($excavator)+count($cng)+304}}</p>						<h6>Excavators tracked</h6>					</div>					<div class="col-md-2 col-sm-4 stats_info counter_grid1 mt-md-0 mt-5">					    <span><img src="{{asset('public/assets/frontend/images/iconFont/clients64.png')}}"></span><br>						<p class="counter">{{count($users)+584}}</p>						<h6>Happy Clients</h6>					</div>					<div class="col-md-2 col-sm-4 stats_info counter_grid2 mt-md-0 mt-5">					    <span><img src="{{asset('public/assets/frontend/images/iconFont/cities64.png')}}"></span><br>						<p class="counter">65</p>						<h6>Cities covered</h6>					</div>				</div>			</div>		</section>		<!-- //stats -->				<!--/testimonials-->		<section class="w3l-testimonials">			<div class="testimonials py-5">				<div class="container text-center py-lg-3">					<div class="title-content text-center mb-lg-5 mb-4">						<h6 class="sub-title">Testimonials</h6>						<h3 class="hny-title">What <span>our clients</span> say?</h3>					</div>					<div class="row">						<div class="col-lg-10 mx-auto">							<div class="owl-testimonial owl-carousel owl-theme">                                @foreach($testimonials as $data)                                <div class="item">                                    <div class="slider-info position-relative mt-lg-4 mt-3">                                        <div class="img-circle">                                            <img src="{{asset('storage/app/public/testimonials/'.$data->client_image)}}" class="img-fluid rounded"                                                alt="client image">                                        </div>                                        <div class="quote"><span class="fa fa-quote-left" aria-hidden="true"></span></div>                                        <div class="message">{{$data->client_fedback}}</div>                                        <div class="name">- {{$data->client_name}}</div>                                    </div>                                </div>                                @endforeach							</div>						</div>					</div>				</div>			</div>		</section>		<!--//testimonials-->			</div>@endsection@push('js')<!-- script for banner slider-->	<script src="{{asset('public/assets/frontend/js/owl.carousel.js')}}"></script>	<script>		$(document).ready(function () {			$('.owl-one').owlCarousel({				loop: true,				margin: 0,				nav: false,				responsiveClass: true,				autoplay: true,				autoplayTimeout: 5000,				autoplaySpeed: 1000,				autoplayHoverPause: false,				afterAction: function(current) {                current.find('video').get(0).play();                },				responsive: {					0: {						items: 1,						nav: false					},					480: {						items: 1,						nav: false					},					667: {						items: 1,						nav: true					},					1000: {						items: 1,						nav: true					}				}			})		})	</script>	<!-- //script -->	<!-- /script-blogs-->	<script>		$(document).ready(function () {			$('.owl-two').owlCarousel({				loop: true,				margin: 30,				nav: false,				responsiveClass: true,				autoplay: true,				autoplayTimeout: 5000,				autoplaySpeed: 1000,				autoplayHoverPause: false,				responsive: {					0: {						items:2,						nav: false					},					480: {						items:2,						nav: false					},					700: {						items: 2,						nav: false					},					1090: {						items: 3,						nav: false					}				}			})		})	</script>	<!-- //script-blogs-->	<!-- script for owlcarousel -->	<script>		$(document).ready(function () {			$('.owl-testimonial').owlCarousel({				loop: true,				margin: 0,				nav: false,				responsiveClass: true,				autoplay: true,				autoplayTimeout: 5000,				autoplaySpeed: 1000,				autoplayHoverPause: false,				responsive: {					0: {						items: 1,						nav: false					},					480: {						items: 1,						nav: false					},					667: {						items: 1,						nav: false					},					1000: {						items: 1,						nav: false					}				}			})		})	</script>	<!-- script for owlcarousel -->@endpush
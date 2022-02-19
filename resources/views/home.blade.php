@extends('frontend.layout.app2')
@section('title','Home')
@push('css')
    <style>

    .top {
    	overflow: hidden;
    	/*background: #f7931e;*/
    	text-align: center;
    	color: #fff;
        height: 200px;
    }
    .top h3 {
    	display: block;
    	/*margin-top: 22px;*/
    	line-height: 1;
    	font-size: 20px;
    	/*margin-bottom: 29px;*/
    }
    .top h4 {
    	font-size: 16px;
    	/*margin-top: 20px;*/
    	/*margin-bottom: 15px !important;*/
    }
    .newPrice {
    	font-size: 25px;
    	color: #000;
    	line-height: 1.4;
    }
    .oldPrice {
    	font-size: 22px;
    	color: #999;
    	text-decoration: line-through;
    	line-height: 1;
    }
    .packPrice {
    	width: 163px;
    	margin: 0 auto;
    	margin-bottom: 0px;
    	padding: 26px 0px;
    	background: #fff;
    	color: #333;
    	border-radius: 50%;
    	transform: rotate(-15deg);
    	margin-bottom: 15px !important;
    	position: relative;
    	box-shadow: -1px 1px 21px rgba(0, 0, 0, 0.4);
    	line-height: 1;
    }
    .packPrice::before {
    	border-color: #D225CC;
    }
    .packPrice::before {
    	width: calc(100% + 14px);
    	position: absolute;
    	content: "";
    	left: -7px;
    	top: -7px;
    	height: calc(100% + 14px);
    	border: 3px solid #FFBE4F;
    	border-top-color: rgb(255, 190, 79);
    	border-right-color: rgb(255, 190, 79);
    	border-bottom-color: rgb(255, 190, 79);
    	border-left-color: rgb(255, 190, 79);
    	border-radius: 50%;
    }
    .packInfo {
    	line-height: 1.2;
    	text-align: center;
    	font-size: 15px;
    	color: #000;
    	margin-top: 12px;
    	font-weight: 400;
    }
    .packInfo span {
    	color: #FF4F51;
    	font-weight: bold;
    	font-size: 20px;
    }
    .tm-pricebox-body ul li i.fa-check {
    	background-color: #7BD11F;
    }
    .tm-pricebox-body ul li i.fa {
    	color: #fff;
    	text-align: center;
    	width: 19px;
    	padding: 4px 0px;
    	height: auto;
    	border-radius: 50%;
    	font-size: 11px;
    	margin-right: 10px;
    }
    .tm-pricebox-body ul li i.fa-times {
    	background-color: #ff6259;
    }
    .tm-pricebox-body ul li i.fa {
    	color: #fff;
    	text-align: center;
    	width: 19px;
    	padding: 4px 0px;
    	height: auto;
    	border-radius: 50%;
    	font-size: 11px;
    	margin-right: 10px;
    }

        .top_header{
            padding: 6px;
            font-weight: bold;
            font-size: 23px;
        }
        .title_border_buttom{
            border-bottom: 3px solid #f15922;
            font-weight: bold;
            font-size: 28px;
        }

    </style>
@endpush

@section('content')

<!--banner-->
<section class="banner-top">
    <div class="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                   
                </div>
                <div class="carousel-item item2">
                    
                </div>
                <div class="carousel-item item3">
                    
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- banner-bottom -->
        @if(count($offers) > 0)
        <div class="banner-bottom">
            <div class="container">
                <div class="row">
                @foreach($offers as $data)
                    <div class="col-lg-4 agileits_banner_bottom_left">
                        <div class="agileinfo_banner_bottom_pos">
                            <div class="w3_agileits_banner_bottom_pos_grid">
                                <div class="col-xs-3 wthree_banner_bottom_grid_left">
                                    <div class="agile_banner_bottom_grid_left_grid hvr-radial-out">
                                        <span class="fas fa-{{$data->image}}" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="col-xs-9 wthree_banner_bottom_grid_right">
                                    <h4>{{$data->title}}</h4>
                                    <p>{{$data->content}}</p>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                @endforeach
                </div>
            </div>
        </div>
        @endif
    <!-- //banner-bottom -->
    </div>
</section>
<!--//banner-->

<!-- features -->
@if(count($feature) > 0)
@if(count($offers) > 0)
<section class="feature2" id="about">
@else
<section class="feature" id="about">
@endif
    <div class="w3-head-all  mb-5">
            <h3>Features we offer</h3>
    </div>
    <div class="container">
        <div class="row">
            @foreach($feature as $key=>$data)
                @break($key== 12)
                <div class="col-sm-6 col-xs-6 col-lg-2 text-justify" style="padding-top: 30px">
                    <div class="card text-center" style="padding: 20px; max-height: 160px; min-height: 160px;">
                        <p style="margin-bottom: 0px">
                        <img src="{{asset('storage/app/public/feature/'.$data->image)}}" height="70px" style="padding: 10px" width="auto" />
                        <br />
                        <h6 style="text-transform: capitalize !important;">{{$data->name}}</h6>
                        </p>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"> </div>
        </div>
    </div>
</section>
@endif
<!-- //feature -->

<!--main pricing table-->
@if(count($price) > 0)
<section class="main  py-5" id="pricing">   
    <div class="container py-md-3">
        <div class="w3-head-all  mb-5">
            <h3>Packages</h3>
        </div>
        <div class="priceing-table">
            <div class="priceing-table-main">
                @foreach($price as $main_key=>$data)
                @break($main_key == 8)
                <div class="price-grid">
                    <div class="price-block agile">
                        <div class="price-gd-top pric-clr{{$data->id}}">
                            <h4>{{$data->name}}</h4>
                            @if($data->bg_image==null)
                            
                            @else
                            <div class="top" style="background-image: url('{{asset('storage/app/public/price_list/'.$data->bg_image)}}') !important;background-repeat: no-repeat; background-size: 100% 100%;"></div>
                            @endif
                            <h5>Device price {{$data->device_price}} Tk. and Monthly Charge {{$data->monthly_charge}} Tk.</h5>
                        </div>
                        <div class="price-gd-bottom">
                            <div class="price-list">
                                <ul>
                                    @php($sub_cat = \App\Price_sub_category::where('price_id',$data->id)->get())
                                    @foreach($sub_cat as $key=>$sub_data)

                                        @break($key == 5)

                                        @if($sub_data->active_status == 1)
                                        <li style="text-transform: capitalize;"><span class="badge badge-success"><i class="fa fa-check"></span></i> {{$sub_data->name}}</li>
                                        @else
                                        <li style="text-transform: capitalize;"><span class="badge badge-danger" style="text-transform: capitalize;"><i class="fa fa-times"></span></i> {{$sub_data->name}}</li>
                                        @endif

                                        @endforeach


                                </ul>
                            </div>
                            <a href="{{route('price_list')}}" class="link"> Show More</a>
                            <a type="button" class="btn btn-success bttn pric-sclr{{$data->id}}"
                               @if(\Illuminate\Support\Facades\Auth::check())
                                   href="{{route('user.payment',$data->id)}}"
                                   @else

                                 href="{{route('guest_customer_order',$data->id)}}"
                                   @endif

                            >Buy Now<b style="top: -32px; left: 64.2813px;"></b></a>
                        </div>   
                    </div>
                </div>
                <div class="clear"> </div>
                @endforeach
            </div>  
        </div>
        <div class="clear"> </div>
    </div>
</section>
@endif
<!-- main pricing table -->


<!-- Coverage -->
<section class="coverage">
    <div class="w3-head-all  mb-5">
        <h3>Our coverage</h3>
    </div>
    <div class="container">
        <div class="row">
            @foreach($coverages as $data)
            <div class="col-md-3 col-sm-12 mt-2">
                <div class="coverage_img" style="padding: 0 12px">
                    <img src="{{asset('storage/app/public/coverages/'.$data->image)}}" alt="" height="200">
                    <span><p>{{$data->name}}</p></span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</Section>
<!--// Coverage -->

<!-- Our DevicePartners -->
@php($partners= \App\partner_showcase::where('status', 1)->where('partner_type', 1)->take(9)->inRandomOrder()->get())
@if(count($partners)>0)
<section class="device_partner">
    <div class="w3-head-all  mb-5">
        <h3>Device partners</h3>
    </div>
    <div class="container">
        <div class="row">
            @foreach($partners as $partners)
            <div class="col-md-4 col-sm-12 mt-2">
                <img class="res" width="428" height="186" src="{{asset('storage/app/public/partner_image/'.$partners->image)}}" alt="">
            </div>
            @endforeach
        </div>
    </div>
</Section>
@endif
<!--// Our DevicePartners -->

<!-- Our TelecomPartners -->
@php($partners= \App\partner_showcase::where('status', 1)->where('partner_type', 2)->take(9)->inRandomOrder()->get())
@if(count($partners)>0)
<section class="telecom_partner">
    <div class="w3-head-all  mb-5">
        <h3>Telecom partners</h3>
    </div>
    <div class="container">
        <div class="row">

            @foreach($partners as $partners)
            <div class="col-md-4 col-sm-12">
                <img class="res" width="428" height="186" src="{{asset('storage/app/public/partner_image/'.$partners->image)}}" alt="">
            </div>
            @endforeach
        </div>
    </div>
</Section>
@endif
<!--// Our TelecomPartners -->

<!-- Our clients -->
@if(count($happy_client)>0)
<section class="clients">
    <div class="w3-head-all  mb-5">
        <h3>Our Corporate Clients</h3>
    </div>
    <div class="container">
        <div class="row">
            @foreach($happy_client as $happy_client)
            <div class="col-md-2 col-sm-12 row_btm">
                <img class="res" src="{{asset('storage/app/public/happy_client/'.$happy_client->image)}}" alt="">
            </div>
            @endforeach
        </div>
    </div>
</Section>
@endif
<!--// Our Clients -->

<!--/testimonials-->
    <section class="w3l-testimonials">
        <div class="testimonials py-5">
            <div class="container text-center py-lg-3">
                <div class="w3-head-all mb-5">
                    <h3>What our clients say?</h3>
                </div>
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="owl-testimonial owl-carousel owl-theme">
                            @foreach($testimonials as $data)
                            <div class="item">
                                <div class="slider-info position-relative mt-lg-4 mt-3">
                                    <div class="img-circle">
                                        <img src="{{asset('storage/app/public/testimonials/'.$data->client_image)}}" class="img-fluid rounded"
                                                alt="client image">
                                    </div>
                                    <div class="quote"><span class="fa fa-quote-left" aria-hidden="true"></span></div>
                                    <div class="message">{{$data->client_fedback}}</div>
                                    <div class="name">- {{$data->client_name}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//testimonials-->

<!-- stats -->
<section class="stats" id="about">
    <div class="w3-head-all  mb-5">
        <h3>Connecting bangladesh</h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-2  col-sm-4 stats_left">
                <span><img src="{{asset('public/assets/frontend/images/iconFont/car48.png')}}"></span><br>
                <p class="counter">{{count($cars)+982}}</p><i>+</i>
                <h3>Cars connected</h3>
            </div>

            <div class="col-md-2 col-sm-4 stats_left">
                <span><img src="{{asset('public/assets/frontend/images/iconFont/motorcycle48.png')}}"></span><br>
                <p class="counter">{{count($motorcycle)+714}}</p><i>+</i>
                <h3>Motorbikes secured</h3>
            </div>

            <div class="col-md-2 col-sm-4 stats_left">
                <span><img src="{{asset('public/assets/frontend/images/iconFont/truck48.png')}}"></span><br>
                <p class="counter">{{count($truck)+653}}</p><i>+</i>
                <h3>Trucks connected</h3>
            </div>

            <div class="col-md-2 col-sm-4 stats_left">
                <span><img src="{{asset('public/assets/frontend/images/iconFont/excav48.png')}}"></span><br>
                <p class="counter">{{count($excavator)+count($cng)+304}}</p><i>+</i>
                <h3>Excavators tracked</h3>
            </div>

            <div class="col-md-2 col-sm-4 stats_left">
                <span><img src="{{asset('public/assets/frontend/images/iconFont/customer48.png')}}"></span><br>
                <p class="counter">{{count($users)+584}}</p><i>+</i>
                <h3>Clients served</h3>
            </div>
            <div class="col-md-2 col-sm-4 stats_left">
                <span><img src="{{asset('public/assets/frontend/images/iconFont/cities48.png')}}"></span><br>
                <p class="counter">65</p><i>+</i>
                <h3>Cities covered</h3>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    
</section>
<!-- //stats -->

<!-- /contact us -->
<section class="w3-contact py-5" id="contact">
    <div class="container py-md-3">
        <div class="w3-head-all  mb-5">
            <h3>Contact us</h3>
        </div>
    </div>
    <div class="w3l-map">
        <iframe width="600" height="450" frameborder="0" style="border: 1px #ddd;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCsYCzALgQI48K_I_Zwsg8mqxunNejTY0c&q=place_id:EiVLYWxseWFucHVyIE1haW4gUmQsIERoYWthLCBCYW5nbGFkZXNoIi4qLAoUChIJCdIPKb_AVTcR7CmQ192DGMkSFAoSCYFrAoewuFU3EcIEWd27Y6WP&key=AIzaSyBTT_u2HcERrbpkHiHndrfSnteAul0FQrU" allowfullscreen></iframe>
    </div>
</section>
<!-- //contact us -->


<!-- Count Down Area -->
{{--
            <div class="tm-section funfact-area tm-padding-section mt-30 bg-white"
                data-black-overlay="8">
                <div class="funfact-areashape" style="background: whitesmoke !important;">
               <img src="{{asset('public/assets/frontend/images/funfact/funfact-shape.png')}}" alt="funfact area shape">
                </div>
                <div class="container-fluid">
                    <div class="row mt-30-reverse justify-content-center">

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/man.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="1500"></span ><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Happy Clients</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/car.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="1600"></span><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Cars</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/truck.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="1600"></span><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Truck & Bus</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/bike.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="500"></span><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Bikes</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/auto-ricksaw.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="2000"></span><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Auto Ricksaw</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                        <!-- Funfact Single -->
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12 mt-30">
                            <div class="tm-funfact">
                                <span class="tm-funfact-icon">
                                    <img src="{{asset('public/assets/frontend/images/bg/work.png')}}" alt="" height="80px">
                                </span>
                                <div class="tm-funfact-content">
                                    <span class="odometer" data-count-to="75"></span><span style="font-size: 32px;margin-top: 21px;font-weight: bold;">+</span>
                                    <h5>Corporate Clients</h5>
                                </div>
                            </div>
                        </div>
                        <!--// Funfact Single -->

                    </div>
                </div>
            </div>
--}}
<!--// Count Down Area -->

@endsection
@push('js')



<script>
function showfullprice(id){
    console.log(id);
    $(".show_details_"+id).show(800);
    $("#show"+id).hide();
}
</script>
@endpush
















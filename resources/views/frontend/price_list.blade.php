@extends('frontend.layout.app3')
@section('title','Pricing & Packages')
@push('css')
@endpush
@section('content')

<!--pricing-16-->
		<section class="w3l-pricing-16-sec">
			<div class="pricing-content py-5">
				<div class="container py-lg-3">
					<div class="title-content text-center mb-lg-5 mt-4">
						<h6 class="sub-title">Price List</h6>
						<h3 class="hny-title">Our <span>Packages</span></h3>
					</div>
                    
					<div class="row w3l-pricing-grids mt-lg-0 mt-4">
					    @foreach($price as $key=>$data)
						<div class="price-main-hny-16">
						    @if($data->id == 4)
							<div class="pricehny-box active">
							@else
							<div class="pricehny-box">
							@endif
								<div class="price-top text-center">
									<div class="pricehny-icon">
									    @if($data->id == 3)
										<span class="fa fa-{{$data->icon}}"></span>
										<span class="fa fa-{{$data->icon}}"></span>
										@else
										<span class="fa fa-{{$data->icon}}"></span>
										@endif
									</div>
									<h3 class="price-heading">{{$data->name}}</h3>
									<div class="price-text-top position-relative">
										<h4>
										<span class="price-symbol">Tk.</span>
										<span class="price-number">{{$data->monthly_charge}}</span>
										<span class="price-frequency">Monthly</span>
									   </h4>
									</div>
									<h8><span style="color: var(--theme-hover)">Device price Tk.</span> <span style="color: var(--theme-color)">{{$data->device_price}}/-</span></h8>
								</div>
								<div class="price-bottom text-left">
									<div class="pricehny-content">
                                    @php($sub_cat = \App\Price_sub_category::where('price_id',$data->id)->get())
                                    @foreach($sub_cat as $sub_data)
                                        @if($sub_data->active_status == 1)
                                            <div style="text-transform: capitalize;" class="price-text-info">
											    <span class="fa fa-check-circle"></span>
											    {{$sub_data->name}}
										    </div>
                                        @else
								            <div style="text-transform: capitalize;" class="price-text-info">
											    <span class="fa fa-times-circle"></span>
											    {{$sub_data->name}}
										    </div>
                                        @endif
                                    @endforeach
									</div>
								</div>
								<div class="buy-button">
									<a class="btn btn-style btn-primary mt-3"
									@if(\Illuminate\Support\Facades\Auth::check())
                                        href="{{route('user.payment',$data->id)}}"
                                    @else
                                        href="{{route('guest_customer_order',$data->id)}}"
                                    @endif>Buy Now</a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
	</div>
	</section>
	<!-- //pricing-16 -->


@endsection
@push('js')


@endpush

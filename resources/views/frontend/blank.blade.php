@extends('frontend.layout.app2')
@section('title','Login')
@push('css')
@endpush
@section('content')

<!--/testimonials-->
        <section class="w3l-testimonials">
            <div class="testimonials py-5">
                <div class="container text-center py-lg-3">
                    <div class="title-content text-center mb-lg-5 mb-4">
                        <h6 class="sub-title">Testimonials</h6>
                        <h3 class="hny-title">What <span>our clients</span> say?</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 mx-auto">
                            <div class="owl-testimonial owl-carousel owl-theme">

                                <div class="item">
                                    <div class="slider-info position-relative mt-lg-4 mt-3">
                                        <div class="img-circle">
                                            <img src="{{asset('public/assets/frontend/images/team/team-image-1.jpg')}}" class="img-fluid rounded"
                                                alt="client image">
                                        </div>
                                        <div class="quote"><span class="fa fa-quote-left" aria-hidden="true"></span>
                                        </div>
                                        <div class="message">Lorem
                                            ipsum dolor sit amet consectetur adipisicing elit. Ea sit
                                            id
                                            accusantium
                                            officia quod quasi necessitatibus perspiciatis Harum error provident
                                            quibusdam tenetur.</span></div>
                                        <div class="name">- Jenkins</div>

                                    </div>
                                </div>
                                <div class="item">
                                    <div class="slider-info position-relative mt-lg-4 mt-3">
                                        <div class="img-circle">
                                            <img src="{{asset('public/assets/frontend/images/bg/default.png')}}" class="img-fluid rounded"
                                                alt="client image">
                                        </div>
                                        <div class="quote"><span class="fa fa-quote-left" aria-hidden="true"></span>
                                        </div>
                                        <div class="message">Lorem
                                            ipsum dolor sit amet consectetur adipisicing elit. Ea sit
                                            id
                                            accusantium
                                            officia quod quasi necessitatibus perspiciatis Harum error provident
                                            quibusdam tenetur.</span></div>
                                        <div class="name">- Jenkins</div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--//testimonials-->


@endsection
@push('js')
@endpush

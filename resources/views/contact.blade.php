@extends('frontend.layout.app')
@section('title','Contact us')
@push('css')
        <style>
        .note{
            text-align: center;
            background: -webkit-linear-gradient(left, #f15922, #ce3600);
            color:
            #fff;
            font-weight: bold;
            padding-top: 22px;
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


       <!-- Breadcrumb Area -->
    <div class="row tm-padding-section">

        @if($contact->count() > 0)

        <div class="container mb-3">
                    <div class="row justify-content-center mt-30-reverse">

                        <div class="col-lg-4 col-md-6 col-sm-6 mt-30">
                            <div class="tm-contact-block text-center">
                                <span class="tm-contact-icon">
                                    <i class="flaticon-placeholder"></i>
                                </span>
                                <h5>Address</h5>
                                <p>{{$contact->first()->address}}</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 mt-30">
                            <div class="tm-contact-block text-center">
                                <span class="tm-contact-icon">
                                    <i class="flaticon-call"></i>
                                </span>
                                <h5>Phone</h5>
                                <p>Contact: <a href="tel://{{$contact->first()->header_phone_1}}">{{$contact->first()->header_phone_1}}</a></p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 mt-30">
                            <div class="tm-contact-block text-center">
                                <span class="tm-contact-icon">
                                    <i class="flaticon-email-1"></i>
                                </span>
                                <h5>Email</h5>
                                <p>Email: <a href="mailto:{{$contact->first()->email}}">{{$contact->first()->email}}</a></p>
                            </div>
                        </div>

                    </div>
                </div>

        @endif


                <div class="col-md-12">
                    <div class="row">
                        <div class="container register-form">
                            <div class="form">
                                <form action="{{ route('contact_us') }}" method="get">
                                <div class="note">
                                    <p style="font-weight: 600; font-size: 25px">Contact US</p>
                                </div>
                                <div class="card">
                                    {{--<iframe width="600" height="450" frameborder="0" style="border: 1px #ddd;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCsYCzALgQI48K_I_Zwsg8mqxunNejTY0c&q=place_id:EiVLYWxseWFucHVyIE1haW4gUmQsIERoYWthLCBCYW5nbGFkZXNoIi4qLAoUChIJCdIPKb_AVTcR7CmQ192DGMkSFAoSCYFrAoewuFU3EcIEWd27Y6WP&key=AIzaSyBTT_u2HcERrbpkHiHndrfSnteAul0FQrU" allowfullscreen></iframe>--}}

                                        <div class="form-content">
                                        <div class="row">

                                            <div class="col-sm-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="name">Your name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required="">
                                            </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required="">
                                                <small id="emailHelp" class="form-text text-muted">Your privacy is our utmost priority.</small>
                                            </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="mobile">Mobile number</label>
                                                <input type="text" name="phone" pattern=".{11,11}" class="form-control" id="mobile" placeholder="Mobile number" required="">
                                            </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="message">Your message</label>
                                                <textarea class="form-control" name="message" id="message" rows="3" placeholder="Write your message" required=""></textarea>
                                            </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>

                                        </div>
                                        </div>

                                </div>
                                    </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!--// Breadcrumb Area -->
@endsection
@push('js')
@endpush

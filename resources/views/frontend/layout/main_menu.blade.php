 <!-- Header Bottom Area -->
            <div class="header-bottomarea">
                <div class="container" style="background: #7be5ff">
                    <div class="header-bottominner">
                        <div class="header-logo">
                            <a href="{{url('/')}}">
                                <img src="{{asset("public/assets/backend/img/technologo.png")}}" alt="logo" style="height: 45px;">
                            </a>
                        </div>
                        <nav class="tm-navigation">
                            <ul>
                                <li class="tm-navigation-dropdown"><a href="{{url('/')}}">Home</a></li>
                                <li><a href="{{route('feature')}}">Features</a></li>
                                <li><a href="{{route('price_list')}}">Pricing</a></li>
                                <li><a href="{{route('our_devices')}}">Tracking Devices</a></li>
                                <li><a href="{{route('Pay_bill')}}">Pay Bill</a></li>
                                <li><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header-icons">
                            <ul>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    @if(Auth::check() && Auth::user()->role==0)
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false"><a style="color: #fff" href="{{ route('admin.adminDashboard') }}">Admin Dashboard</a></button>
                                    </div>
                                    @elseif(Auth::check() && Auth::user()->role==2)
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success" aria-haspopup="true" aria-expanded="false"><a style="color: #fff" href="{{ route('user.user_dashboard') }}">User Dashboard</a></button>
                                    </div>
                                    @endif
                                    @else
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-info dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('user_login')}}">Client Login</a>
                                            <a class="dropdown-item" href="{{route('user_registration')}}">Registration</a>
                                            <!--<a class="dropdown-item" target="null" href="http://tracksolid.com/">Tracksolid Login</a>-->
                                        </div>
                                    </div>
                                @endif
                            </ul>
                        </div>
                        <div class="header-searchbox">
                            <div class="header-searchinner">
                                <form action="#" class="header-searchform">
                                    <input type="text" placeholder="Enter search keyword..">
                                </form>
                                <button class="search-close"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="header-mobilemenu clearfix">
                        <div class="tm-mobilenav"></div>
                    </div>
                </div>
            </div>
            <!--// Header Bottom Area -->

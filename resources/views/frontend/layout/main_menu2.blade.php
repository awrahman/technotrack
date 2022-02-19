
<!--<div class="se-pre-con"></div>-->
    
<header>
  <div class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="{{url('/')}}"><span><i class="fab logo"><img src="{{asset('public/assets/backend/img/technologo.png')}}" alt="TechnoTrack" class="img-responsive img-fluid" /></i></span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active"><a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a></li>
          <li class="nav-item"><a class="nav-link scroll" href="{{route('feature')}}">Features</a></li>
          <li class="nav-item"><a class="nav-link scroll" href="{{route('price_list')}}">Pricing</a></li>
          <li class="nav-item"><a class="nav-link scroll" href="{{route('our_devices')}}">Tracking Devices</a></li>
          {{--<li class="nav-item"><a class="nav-link scroll" href="{{route('Pay_bill')}}">Pay Bill</a></li>--}}
          <li class="nav-item"><a class="nav-link scroll" href="{{route('contact')}}">Contact</a></li>
        </ul>
        <div class="navbar-text">
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
        </div>
      </div>
    </nav>
  </div>
</header>

	<style>
	    .dropdown-menu a{
	        color: #1ebbd7;
	    }
	    .dropdown-menu a:hover{
	        color: #005073;
	        transition: background-position 275ms ease;
	    }
	    .hidden{
	        display: none;
	    }
	    @media (max-width:600px) {
            .search-right{
                display: none;
            }
            .hidden{
                display: inline-block;
            }
	    }
	</style>
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<h3>Menu</h3>

		<ul>
			<li><a href="{{url('/')}}">Home</a></li>
		    <li><a href="{{route('feature')}}">Features</a></li>
			<li><a href="{{route('price_list')}}">Pricing</a></li>
			<li><a href="{{route('our_devices')}}">Tracking Device</a></li>
			<li><a href="#billPay">Bill Pay</a></li>
		    <li><a href="{{route('contact')}}">Contact</a></li>
		    <li><a href="#demo">Demo Account</a></li>
			<li><div class="btn-group dropdown hidden" style="margin: 10px 0 0 20px;">
				<button type="button" class="btn btn-info dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="{{route('user_login')}}">Client Login</a>
					<a class="dropdown-item" href="{{route('user_registration')}}">Registration</a>
                    <a class="dropdown-item" target="_blank" href="http://176.9.100.216/">GPS Server Login</a>
				</div>
			</div></li>
		</ul>
	</nav>
	<div class="main buttonset">
		<!--/tophny-header-->
		<div class="tophny-header">
			<div class="container">
				<div class="hny-topgds">
					<div class="menu-notify">
						<button id="showLeftPush"><span class="fa fa-bars" aria-hidden="true"></span></button>

					</div>
					<div class="logo text-center">
						<!--<h1><a class="navbar-brand" href="main.html">
								AbodeDesk
							</a></h1>-->
						<a class="navbar-brand" href="{{url('/')}}">
							<img src="{{asset('public/assets/frontend/images/techno/TechnoLogo.png')}}" alt="TechnoTrack" title="TechnoTrack" style="height:55px;" />
						</a>
							
					</div>
					<div class="menu-override text-center">
						<ul>
							<li><a href="{{url('/')}}">Home</a></li>
			                <li><a href="{{route('feature')}}">Features</a></li>
			                <li><a href="{{route('price_list')}}">Pricing</a></li>
			                <li><a href="{{route('our_devices')}}">Tracking Device</a></li>
			                <li><a href="#billPay">Bill Pay</a></li>
			                <li><a href="{{route('contact')}}">Contact</a></li>
						</ul>
					</div>

					<div class="icon-left search-right text-right">
						<div class="btn-group dropdown">
							<button type="button" class="btn btn-info dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="{{route('user_login')}}">Client Login</a>
								<a class="dropdown-item" href="{{route('user_registration')}}">Registration</a>
                                <a class="dropdown-item" target="_blank" href="http://176.9.100.216/">GPS Server Login</a>
							</div>
						</div>
						<button type="button" style="margin-left: 2px;" class="btn btn-info" >Demo Account</button>
					</div>
				</div>
			</div>
			<!--//tophny-header-->
		</div>
		<!--//tophny-header-->
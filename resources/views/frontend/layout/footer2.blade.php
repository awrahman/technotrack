<!-- footer-28 block -->
	<section class="w3l-footer">
		<footer class="footer-28">
			<div class="footer-bg-layer">
				<div class="container py-lg-3">
					<div class="row footer-top-28">
						<div class="col-lg-6 col-md-5 footer-list-28 mt-5">
							<h6 class="footer-title-28">Contact information</h6>
							@php($contact = \App\Contact_info::all())
                                @if(count($contact) > 0)
                                @php($contact_data = \App\Contact_info::all()->first())
							<ul class="address">
								<li><i class="fa fa-map-marker" style="font-size: 1.5em; margin-right: 10px;"></i>{{$contact_data->address}}</li>
								<li><i class="fa fa-envelope-square"></i>Email: <a href="mailto:{{$contact_data->email}}">{{$contact_data->email}}</a></li>
								<li><i class="fa fa-phone"></i> Sales: <a href="tel:{{$contact_data->header_phone_1}}">{{$contact_data->header_phone_1}}</a></li>
								<li><i class="fa fa-phone"></i> Billing: <a href="tel:{{$contact_data->header_phone_2}}">{{$contact_data->header_phone_2}}</a></li>
								<li><i class="fa fa-phone"></i> Support: <a href="tel:{{$contact_data->header_phone_3}}">{{$contact_data->header_phone_3}}</a></li>
							</ul>
                                @endif
							<div class="main-social-footer-28 mt-3">
								<ul class="social-icons">
									<li class="facebook">
										<a href="https://web.facebook.com/TechnoTrackBD" target="_blank" title="Facebook">
											<span class="fa fa-facebook" aria-hidden="true"></span>
										</a>
									</li>
									<li class="twitter">
										<a href="#link" title="Twitter">
											<span class="fa fa-twitter" aria-hidden="true"></span>
										</a>
									</li>
									<li class="dribbble">
										<a href="#link" title="Instagram">
											<span class="fa fa-instagram" aria-hidden="true"></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6 col-md-7">
							<div class="row">
								<div class="col-sm-4 col-6 footer-list-28 mt-5">
									<h6 class="footer-title-28">Quick Links</h6>
									<ul>
										<li><a href="#">About Us</a></li>
										<li><a href="{{route('blogs')}}">Blog Posts</a></li>
										<li><a href="#">Servies</a></li>
										<li><a href="{{route('price_list')}}">Pricing</a></li>
									</ul>
									<div style="margin-top: 1%;">
                                <a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=technotrack.com.bd','SiteLock','width=600,height=600,left=160,top=170');" ><img class="img-responsive" alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/technotrack.com.bd" /></a>
                                </div>
								</div>
								<div class="col-sm-6 col-6 footer-list-28 mt-5">
									<h6 class="footer-title-28">Follow us on facebook</h6>
									<div>
                                        <iframe height="181" width="280" class="fbplugin" src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTechnoTrackBD%2F&amp;tabs&amp;width=280&amp;height=181&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                                        <iframe class="fblike" src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fweb.facebook.com%2FTechnoTrackBD&width=162&layout=button_count&action=like&size=large&share=true&height=46&appId" width="162" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                                    </div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="midd-footer-28 align-center py-lg-4 py-3 mt-5">
					<div class="container">
						<p class="copy-footer-28 text-center"> &copy; 2020 TechnoTrack. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</footer>

		<!-- move top -->
		<button onclick="topFunction()" id="movetop" title="Go to top">
			<span class="fa fa-arrow-up" aria-hidden="true"></span>
		</button>
		<script>
			// When the user scrolls down 20px from the top of the document, show the button
			window.onscroll = function () {
				scrollFunction()
			};

			function scrollFunction() {
				if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
					document.getElementById("movetop").style.display = "block";
				} else {
					document.getElementById("movetop").style.display = "none";
				}
			}

			// When the user clicks on the button, scroll to the top of the document
			function topFunction() {
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			}
		</script>
		<!-- /move top -->
	</section>
	<!-- //footer-28 block -->
    </div>


	<script src="{{asset('public/assets/frontend/js/jquery-3.3.1.min.js')}}"></script>
	<!--/top-nav-->
	<script src="{{asset('public/assets/frontend/js/jquery-2.1.4.min.js')}}"></script>
	<script src="{{asset('public/assets/frontend/js/modernizr.custom.js')}}"></script>
	<script src="{{asset('public/assets/frontend/js/classie.js')}}"></script>
	<script>
		var menuLeft = document.getElementById('cbp-spmenu-s1'),
			showLeftPush = document.getElementById('showLeftPush'),
			body = document.body;

		showLeftPush.onclick = function () {
			classie.toggle(this, 'active');
			classie.toggle(body, 'cbp-spmenu-push-toright');
			classie.toggle(menuLeft, 'cbp-spmenu-open');
			disableOther('showLeftPush');
		};

		function disableOther(button) {
			if (button !== 'showLeftPush') {
				classie.toggle(showLeftPush, 'disabled');
			}
		}
	</script>
	<!--//top-nav-->
	<!-- disable body scroll which navbar is in active -->

            <!-- Js Files -->
    <script src="{{asset('public/assets/frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/frontend/js/popper.min.js')}}"></script>    
    <script src="{{asset('public/assets/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/frontend/js/plugins.js')}}"></script>
    <script src="{{asset('public/assets/frontend/js/main.js')}}"></script>
    
    <!-- libhtbox -->
	<script src="{{asset('public/assets/frontend/js/lightbox-plus-jquery.min.js')}}"></script>
	<!-- count up -->
	<script src="{{asset('public/assets/frontend/js/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('public/assets/frontend/js/jquery.countup.js')}}"></script>
	<script>
		$('.counter').countUp();
	</script>


    <!-- Toaster message -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
              toastr.error('{{ $error }}','Error',{
                  closeButton:true,
                  progressBar:true,
               });
        @endforeach
    @endif
</script>
<!-- stats -->
    <!--// Js Files -->
    </body>
</html>


<!-- footer-28 block -->
	<section class="w3l-footer">
		<footer class="footer-28">
			<div class="footer-bg-layer">
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
<script src="{{asset('public/assets/frontend/js/jquery.waypoints.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
 <script src="{{asset('public/assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <!--// Js Files -->
    </body>
</html>


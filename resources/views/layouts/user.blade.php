
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BKACAD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/user/css/open-iconic-bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/user/css/animate.css') }}">
    
    <link rel="stylesheet" href="{{ asset('public/user/css/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/user/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/magnific-popup.css') }} ">

    <link rel="stylesheet" href="{{ asset('public/user/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('public/user/css/ionicons.min.css') }} ">
    
    <link rel="stylesheet" href="{{ asset('public/user/css/flaticon.css') }} ">
    <link rel="stylesheet" href="{{ asset('public/user/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/style.css') }} ">
  </head>
  <body>
	  <div class="bg-top navbar-light">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-center align-items-stretch">
    			<div class="col-md-4 d-flex align-items-center py-4">
    				<a class="navbar-brand" href="{{ route('home')}}">BKACAD <span></span></a>
    			</div>
	    		<div class="col-lg-8 d-block">
		    		<div class="row d-flex">
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
					    	<div class="text">
					    		<span>Email</span>
						    	<span>contact@bkacad.edu.vn</span>
						    </div>
					    </div>
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <div class="text">
						    	<span>Call</span>
						    	<span>Call Us: + 036 779 1116</span>
						    </div>
					    </div>
              @if (Auth::guard('teacher')->check())
					    <div class="col-md topper d-flex align-items-center justify-content-end">
					    	<i class="fa fa-user" aria-hidden="true"></i>
                    <div class="dropdown name">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <a href="">Hello! {{Auth::guard('teacher')->user()->name}}</a>
                                </button>
                        <div class="dropdown-menu logout" aria-labelledby="triggerId">
                            <a href="{{ route('home.logout') }}" class="logout">logout</a>
                        </div>
                    </div>
					    </div>
              @endif
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container d-flex align-items-center px-4">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <form action="#" class="searchform order-lg-last">
          <div class="form-group d-flex">
            <input type="text" class="form-control pl-3" placeholder="Search">
            <button type="submit" placeholder="" class="form-control search"><span class="ion-ios-search"></span></button>
          </div>
        </form>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav mr-auto">
	        	<li class="nav-item active"><a href="{{ route('home')}}" class="nav-link pl-0">Home</a></li>
	        	<li class="nav-item"><a href="{{ route('mysalary')}}" class="nav-link">My Salary</a></li>
	          <li class="nav-item"><a href="{{ route('staff')}}" class="nav-link">Teacher</a></li>
            <li class="nav-item"><a href="{{ route('contact')}}" class="nav-link">Feedback</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
   @yield('user')
		
    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6 col-lg-3">
            <div class="ftco-footer-widget mb-5">
            	<h2 class="ftco-heading-2">BKACAD</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">	P214, Tòa nhà A17 Bách Khoa, 17 Tạ Quang Bửu, Hai Bà Trưng, Hà Nội</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+ 036 779 1116</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">contact@bkacad.edu.vn</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
          
          <div class="col-md-6 col-lg-3">
            <div class="ftco-footer-widget mb-5 ml-md-4">
              <h2 class="ftco-heading-2">Links</h2>
              <ul class="list-unstyled">
                <li><a href="{{ route('home')}}"><span class="ion-ios-arrow-round-forward mr-2"></span>Home</a></li>
                <li><a href="{{ route('mysalary')}}"><span class="ion-ios-arrow-round-forward mr-2"></span>My Salary</a></li>
                <li><a href="{{ route('staff')}}"><span class="ion-ios-arrow-round-forward mr-2"></span>Teacher</a></li>
                <li><a href="{{ route('contact')}}"><span class="ion-ios-arrow-round-forward mr-2"></span>Contact</a></li>
                
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="ftco-footer-widget mb-5">
            	<h2 class="ftco-heading-2">BKACAD TRÊN FACEBOOK</h2>
              <form action="#" class="subscribe-form">
                <div class="form-group">
                  <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fbkacad&amp;tabs=timeline&amp;width=340&amp;height=215&amp;small_header=true&amp;adapt_container_width=true&amp;hide_cover=true&amp;show_facepile=true&amp;appId" width="100%" height="215" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> Học viện Công nghệ BKACAD <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">love</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="{{ asset('public/user/js/jquery.min.js') }}"></script>
  <script src="{{ asset('public/user/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('public/user/js/popper.min.js') }}"></script>
  <script src="{{ asset('public/user/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/user/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('public/user/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('public/user/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('public/user/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('public/user/js/jquery.magnific-popup.min.js') }}"></script>
  
  <script src="{{ asset('public/user/js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('public/user/js/scrollax.min.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{ asset('public/user/js/google-map.js') }}"></script>
  <script src="{{ asset('public/user/js/aos.js') }}"></script>
<script src="{{ asset('public/user/js/main.js') }}"></script>
    @yield('js')
  </body>
</html>
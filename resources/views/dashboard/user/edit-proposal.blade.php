<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ceylon Petroleum Corporation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- Side Bar -->
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    
    <link rel="stylesheet" href="/css/style1.css">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+94 11 5455455</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>secratariat[at]ceypetco.gov.lk</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

        <!-- Start Side Bar -->

        <aside class="sidebar">
      <div class="toggle">
        <a href="#" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
              <span></span>
            </a>
      </div>
      <div class="side-inner">

        <div class="profile">
          <img src="/img/Ceylon_Petroleum_Corporation_logo.png" alt="Logo" class="img-fluid">
          <h3 class="name">{{ Auth::guard('web')->user()->name }}</h3>
        </div>

        
        <div class="nav-menu">
          <ul>
            <li><a href="/user/add-proposal"><span class="icon-notifications mr-3"></span>Add Proposals</a></li>
            <li><a href="/user/manage-proposals"><span class="icon-location-arrow mr-3"></span>Manage Proposals</a></li>
            <li><a href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="icon-sign-out mr-3"></span>Log out</a></li>
          </ul>
        </div>
      </div>
      
    </aside>

    <!-- End Side Bar -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand ml-lg-3">
                <h3 class="m-0 display-5 text-uppercase text-primary"><img src="/img/Ceylon_Petroleum_Corporation_logo.png" height="100px" width="100px">Ceylon Petroleum Corporation</i></h3>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="/user/home" class="nav-item nav-link">Home</a>
                    <a href="/user/add-proposal" class="nav-item nav-link active">Proposal Evaluation</a>
                    <a href="#" class="nav-item nav-link">Service</a>
                </div>
                <a href="" class="btn btn-primary py-2 px-4 d-none d-lg-block">Get A Quote</a>
            </div>
            <a href="#">Hi {{ Auth::guard('web')->user()->name }} </a> &nbsp &nbsp
                <a href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Proposal Evaluation</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Proposal Evaluation</p>
            </div>
        </div>
    </div>
    <!-- Header End -->



    <div class="container mt-5 m-auto">  
    <br>
    <h2 style="font-size:35px;"> Add Proposal </h2> <br>
        <form class="row g-3" method="post" action="/updateProposal">

        {{csrf_field()}}

        <input type="hidden" name="id" value="{{$data->id}}">

            <div class="col-md-12">
                <label class="form-label"> <b> Reference Number </b> </label>
                <input type="text" class="form-control py-2" name="reference_number" value="{{$data->reference_number}}" readonly>
            </div>
			
			<div class="col-md-12">
                <label class="form-label"> <b> Subject </b> </label>
                <input type="text" class="form-control py-2" name="subject" value="{{$data->subject}}">
                <span class="text-danger">@error('subject'){{ $message }} @enderror </span>
            </div>
			
			<div class="col-md-6">
                <label class="form-label"> <b> Status </b> </label>
                <select class="form-control inputstl" name="status">
                        <option>{{$data->status}}</option>
                        <option> Sample Status 1 </option>
                        <option> Sample Status 2 </option>
                        <option> Sample Status 3 </option>
                        <option> Sample Status 4 </option>
                </select>
                <span class="text-danger">@error('status'){{ $message }} @enderror </span>
            </div>

            <div class="col-md-6">
                <label class="form-label"> <b> Team </b> </label>
                <select class="form-control inputstl" name="team">
                        <option>{{$data->team}}</option>
                        <option> 1 </option>
                        <option> 2 </option>
                        <option> 3 </option>
                        <option> 4 </option>
                </select>
                <span class="text-danger">@error('team'){{ $message }} @enderror </span>
            </div>

            <div class="col-md-6">
                <label class="form-label"> <b> Organized by </b> </label>
                <select class="form-control inputstl" name="organized_by">
                        <option>{{$data->organized_by}}</option>
                        <option> 1 </option>
                        <option> 2 </option>
                        <option> 3 </option>
                        <option> 4 </option>
                </select>
                <span class="text-danger">@error('organized_by'){{ $message }} @enderror </span>
            </div>
			
            <div class="col-md-6">
                <label class="form-label"> <b> Mobile Number </b> </label>
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" class="form-control py-2" value="+94" readonly>
                    </div>

                    <div class="col-md-10">
                        <input type="text" class="form-control py-2" name="mobile" value="{{$data->mobile}}">
                    </div>
                </div> 
                <span class="text-danger">@error('mobile'){{ $message }} @enderror </span>
            </div>

			<div class="col-md-12">
                <label class="form-label"> <b> Entered Date & Time </b> </label>
                <input type="date" class="form-control py-2" name="data_time" value="{{$data->entered_date_time}}">
                <span class="text-danger">@error('data_time'){{ $message }} @enderror </span>
            </div>

            <div class="col-md-12">
                <label class="form-label"> <b> Entered by </b> </label>
                <input type="text" class="form-control py-2" name="entered_by" value="{{ Auth::guard('web')->user()->name }}" readonly>
                <span class="text-danger">@error('entered_by'){{ $message }} @enderror </span>
            </div>
            
			<br><br><br><br>
            <div class="col-12">
                <button class="btn btn-success" type="submit">Update</button>
                <button class="btn btn-warning" type="reset">Clear</button>
            </div>  
            <br><br><br><br>
        </div>        
        </form>



    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-7 col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h3 class="text-primary mb-4">Get In Touch</h3>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                        <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h3 class="text-primary mb-4">Quick Links</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Services</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Pricing Plan</a>
                            <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Newsletter</h3>
                <p>Rebum labore lorem dolores kasd est, et ipsum amet et at kasd, ipsum sea tempor magna tempor. Accu kasd sed ea duo ipsum. Dolor duo eirmod sea justo no lorem est diam</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Your Email Address">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: #3E3E4E !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">Your Site Name</a>. All Rights Reserved. 
				
				<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
				Designed by <a href="https://htmlcodex.com">HTML Codex</a>
                <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/lib/easing/easing.min.js"></script>
    <script src="/lib/waypoints/waypoints.min.js"></script>
    <script src="/lib/counterup/counterup.min.js"></script>
    <script src="/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/mail/jqBootstrapValidation.min.js"></script>
    <script src="/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/js/main.js"></script>
    <script src="/js/Sidebar/jquery-3.3.1.min.js"></script>
    <script src="/js/Sidebar/popper.min.js"></script>
    <script src="/js/Sidebar/main.js"></script>
  
</body>

</html>    
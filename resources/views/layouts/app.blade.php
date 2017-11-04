<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from hencework.com/theme/dexter/fixed-width-light/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Oct 2017 23:48:22 GMT -->
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Fonovitta I Fonoaudiologia de Excelência</title>
	<meta name="description" content="Dexter is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Dexter Admin, Dexteradmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- vector map CSS -->
	<link href="{{ URL::asset('vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
	
	
	
	<!-- Custom CSS -->
	<link href="{{ URL::asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
</head>


<body>
	
	<!--Preloader-->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!--/Preloader-->
	
	<div class="wrapper pa-0">
	
		<header class="sp-header">
			
			<div class="sp-logo-wrap pull-left">
				<a href="{{ url('/') }}">
					<img class="brand-img mr-10" src="{{ URL::asset('dist/img/logo.png') }}" alt="brand"/>
					<span class="brand-text">Fonovitta</span>
				</a>
			</div>
			
				
			
			<!-- Right Side Of Navbar -->
			<div class="form-group mb-0 pull-right">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
						<span class="inline-block pr-10">Não possui uma conta?</span>
						<a class="inline-block btn btn-primary btn-rounded btn-outline" href="{{ url('/register') }}">Cadastrar</a>
						<a class="inline-block btn btn-default btn-rounded btn-outline ml-15 mr-25" href="{{ url('/login') }}">Login</a>
                    @else
						
						{{ Auth::user()->name }}
                        <a class="inline-block btn btn-default btn-rounded btn-outline ml-15 mr-25" href="{{ url('/logout') }}">Logout</a>
						
                    @endif
                </ul>
			</div>
			
			<div class="clearfix"></div>
		</header>
		
		<!-- Main Content -->
		<div class="page-wrapper pa-0 ma-0 auth-page">
			<div class="container-fluid">
				<!-- Row -->
				<div class="table-struct full-width full-height">
					<div class="table-cell vertical-align-middle auth-form-wrap">
						<div class="auth-form  ml-auto mr-auto no-float">
							<div class="row">
								<div class="col-sm-12 col-xs-12">
									
									 @yield('content')
									 
								</div>	
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->	
			</div>
			
		</div>
		<!-- /Main Content -->

		

    <!-- JavaScripts -->
	<!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	-->
	
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
	
	
	<!-- JavaScript -->
		
	<!-- jQuery -->
	<script src="{{ URL::asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
	
	<!-- Bootstrap Core JavaScript -->
	<script src="{{ URL::asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="{{ URL::asset('dist/js/jquery.slimscroll.js') }}"></script>
	
	<!-- Init JavaScript -->
	<script src="{{ URL::asset('dist/js/init.js') }}"></script>
	
	
	
	
	
</body>
</html>

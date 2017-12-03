<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from bootstrapwizard.info/Theme/clarity/home-portfolio.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Apr 2016 13:01:33 GMT -->
<head>
		<meta charset="utf-8">
		<title>Fonovitta - Home </title>
		<!-- Mobile Meta -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->   
		<meta name="description" content="Clarity is a Bootstrap-based, Responsive HTML5 Template">
		<meta name="author" content="bootstrapwizard.info">
					
		<!-- Font Awesome CSS -->
		<link href="{{ URL::asset('clarity/css/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
		
		<!-- Simple Line Icons -->
		<link href="{{ URL::asset('clarity/css/simple-line-icons/simple-line-icons.css') }}" rel="stylesheet">
		
		<!-- Bootstrap main CSS -->
		<link href="{{ URL::asset('clarity/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
			
		<!-- Web Fonts  -->
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
		
		<!-- yamm3 -->
		<link href="{{ URL::asset('clarity/css/yamm.css') }}" rel="stylesheet">
			
		<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('clarity/plugins/rs-plugin/css/settings.css') }}" media="screen" />
		
		<!-- Animate -->
		<link href="{{ URL::asset('clarity/css/animate/animate.min.css') }}" rel="stylesheet">
		
		<!-- owl-carousel -->
		<link href="{{ URL::asset('clarity/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('clarity/plugins/owl-carousel/owl.theme.css') }}" rel="stylesheet">
		
		<!-- magnific-popup -->
		<link href="{{ URL::asset('clarity/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
		
		<!-- flexslider -->
		<link href="{{ URL::asset('clarity/plugins/flexslider/flexslider.css') }}" rel="stylesheet">
		
		<!-- morris -->
		<link href="{{ URL::asset('clarity/plugins/morris/morris.css') }}" rel="stylesheet">
		
		<!-- Hover -->
		<link href="{{ URL::asset('clarity/css/hover/hover.min.css') }}" rel="stylesheet">
		
		<!-- prettify  -->
		<script src="../../../google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>		
		<link href="{{ URL::asset('clarity/css/prettify/prettify.css') }}" rel="stylesheet">
		
		<!-- style -->
		<link href="{{ URL::asset('clarity/css/style.css') }}" rel="stylesheet">
		
		<!-- switcher -->
		<link href="{{ URL::asset('clarity/switcher/switcher.css') }}" rel="stylesheet">
		
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('clarity/css/colors/blue.css') }}" id="colors">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
    
	<body class="wide">
    	
		<!-- wrapper -->
		<div class="wrapper">
		
			<!-- Preloader -->
			<div id="preloader">
				
				<div class="preloader-wrap">
					<!-- Animação -->
					<div id="status">&nbsp;</div>
					<!-- Mensagens -->
				  	<div class="percentage" id="precent"></div>
				</div>

			</div>
			<!-- //Preloader -->
			
			<!-- scrollToTop -->	
			<a href="#" class="scrollToTop">
				<i class="fa fa-angle-up fa-2x"></i>
			</a>
			<!-- ./scrollToTop -->
		
			<!-- header -->
			<header id="header">
			
				
				<!-- navbar -->
				<div class="navbar navbar-v1 navbar-transparent navbar-fixed-top yamm" role="navigation">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#home"><img src="img/logo-white.png" alt="Fonovitta"></a>
							<!--<a class="navbar-brand" href="#"><span>c</span>larity</a>-->   
						</div>
						<div class="navbar-collapse collapse">
							<ul class="nav navbar-nav navbar-right">
								<li class="active"><a href="#home" > Home </a></li>
								<li class=""><a href="#sobre" > Sobre </a></li>
								<li class=""><a href="#servico" > Serviço </a></li>
								<li class=""><a href="#equipe" > Equipe </a></li>
								<li class=""><a href="#depoimentos" > Depoimentos </a></li>
								<li class=""><a href="#contato" > Contato </a></li>
								<li class=""><a href="restrito/" > Portal </a></li>

								<!-- <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">Blog <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown-menu" role="menu">
										<li class="dropdown-submenu">
											<a tabindex="-1" href="#">Basic</a>
											<ul class="dropdown-menu">
												<li><a href="blog-basic-left.html"> Left Sidebar</a></li>
												<li><a href="blog-basic-right.html"> Right Sidebar</a></li>
												<li><a href="blog-basic-full.html"> Full Width</a></li>
											</ul>
										</li>
										<li class="dropdown-submenu">
											<a tabindex="-1" href="#">Grid</a>
											<ul class="dropdown-menu">
												<li><a href="blog-grid2.html"> 2 Column</a></li>
												<li><a href="blog-grid3.html"> 3 Column</a></li>
												<li><a href="blog-grid4.html"> 4 Column</a></li>
												<li><a href="blog-grid-left.html"> Left Sidebar</a></li>
												<li><a href="blog-grid-right.html"> Right Sidebar</a></li>
											</ul>
										</li>
										<li class="dropdown-submenu">
											<a tabindex="-1" href="#">Medium</a>
											<ul class="dropdown-menu">
												<li><a href="blog-medium-left.html"> Left Sidebar</a></li>
												<li><a href="blog-medium-right.html">  Right Sidebar</a></li>
												<li><a href="blog-medium-full.html"> Full Width</a></li>
											</ul>
										</li>
										<li class="dropdown-submenu">
											<a tabindex="-1" href="#">Single</a>
											<ul class="dropdown-menu">
												<li><a href="blog-single-left.html"> Left Sidebar</a></li>
												<li><a href="blog-single-right.html">  Right Sidebar</a></li>
												<li><a href="blog-single-full.html"> Full Width</a></li>
											</ul>
										</li>
									</ul>
								</li> -->
								<!--menu li end here-->

								
								<!-- dropdown-search -->
								<!-- <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
									<div class="dropdown-menu dropdown-menu-right dropdown-search">									
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Procurar por...">
											<span class="input-group-btn">
												<button class="btn btn-theme" type="button">Procurar</button>
											</span>
										</div>									
									</div>
								</li> -->
								<!-- //dropdown-search -->		
							
							</ul>
						</div><!--/.nav-collapse -->
											
					</div><!-- ./container -->
				</div>
				<!-- //navbar -->
				
				
			</header>
			<!-- /header -->
			

			<!-- fixed-banner -->	
			<section id="home" class="static-banner banner-v3 bg-fixed">
				
				<div class="banner-content text-center">
					<div class="container">
						<div class="row">
							<h1 class="wow fadeInUp">@yield('titulo')</h1>
							<p class="wow fadeInUp">@yield('sub_titulo')</p>
							<a data-scroll href="#sobre" class="btn-banner circle wow fadeInUp">
								<i class="fa fa-angle-down"></i>
								<br><br>
							</a>
						</div><!-- ./row -->	
					</div>
				</div>
					
			</section>
			<!-- ./fixed-banner -->	
			
			<!-- SOBRE -->	
			<section id="sobre" class="padd-tb-60">
				<div class="container">
				
					<div class="heading text-center padd-b-30 wow fadeIn">
						<h3>SOBRE</h3>
						<div class="separator center"></div>
						<p> @yield('sobre') </p>
					</div>
				
					<div class="row wow fadeInUp">
						<div class="col-md-4 col-sm-4 no-padd">
							<div class="feature-box4 padd-30 bg-blue no-margin">
								<i class="icon icon-puzzle"></i>
								<h4>Nossa Missão</h4>	
								<p> @yield('missao') </p>
								
							</div>
						</div>
						<div class="col-md-4 col-sm-4 no-padd">
							<div class="feature-box4 padd-30 bg-green no-margin">
								<i class="icon icon-plane"></i>
								<h4>Nossa Visão</h4>	
								<p> @yield('visao') </p>
								
							</div>
						</div>
						<div class="col-md-4 col-sm-4 no-padd">
							<div class="feature-box4 padd-30 bg-dark-blue no-margin">
								<i class="icon icon-globe"></i>
								<h4>Nossos Valores</h4>	
								<p> @yield('valores') </p>
								
							</div>
						</div>					
					</div><!-- ./row -->
					
			
				</div><!-- ./container -->
			</section>
			<!-- ./SOBRE -->
			
			<section class="padd-tb-60 bg-gray">
				<div class="container">
					
						<div class="row">
						
							<div class="col-md-5 col-md-offset-1 wow fadeInUp">
								<h4>Quem somos</h4>
								
								<p>A Fonovitta é uma empresa de serviços de fonoaudiologia focado no tratamento de distúrbios da deglutição causado pelas mais diversas doenças, como Parkinson, Alzheimer, Câncer e outros.</p>
								<blockquote>
									<p>Nossa equipe conta com profissionais formados nas mais renomadas universidades de fonoaudiologia do país.</p>
								</blockquote>
								<hr>
								<a href="http://www.facebook.com/fonovittafonoaudiologia" target="_blank" class=""><i class="fa fa-facebook-official fa-2x"></i> &nbsp; Siga-nos no Facebook</a>
															
							</div>
							<div class="col-md-5 wow fadeInUp">
								<h4>Nossa História</h4>
								<p>Nosso serviço começou em 2014 e vem crescendo a cada ano. Hoje atendemos a demanda de fonoaudiologia de dois hospitais da região de Campinas e atendemos também em um consultório.</p>
								
							</div>
							
							<!-- <div class="col-md-4 wow fadeInUp">
								<h4>O Que Buscamos</h4>
								<p></p>
							</div> -->
													
						</div><!-- ./row -->
											
				</div><!-- ./container -->
			</section>
			
						
			<!-- NOSSOS SERVIÇOS -->	
			<section id="servico" class="padd-tb-60">
				<div class="container">
				
					<div class="heading text-center padd-b-30 wow fadeIn">
						<h2><strong>NOSSOS SERVIÇOS</strong></h2>
						<div class="separator center"></div>
						
					</div>
					<div class="row wow fadeInUp">
						<div class="col-md-4 col-sm-4">
							<div class="feature-box4 padd-30 text-center">
								<!-- <i class="icon icon-check"></i> -->
								<h4>Distúrbios da Deglutição</h4>	
								<p>Reabilitamos os distúrbios da deglutição em paciente idosos, câncer de cabeça e pescoço e doenças neurológicas, através da reintrodução, monitoramento e gerenciamento da alimentação via oral de maneira segura e eficiente ao paciente.</p>								
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="feature-box4 padd-30 text-center">
								<!-- <i class="icon icon-check"></i> -->
								<h4>Distúrbios Oromiofuncionais</h4>	
								<p>Atuamos de maneira complementar aos distúrbios oromiofuncionais com foco na musculatura facial e cervical afim de maximizar as funções de fala, mastigação, mímica facial e deglutição.</p>
								
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="feature-box4 padd-30 text-center">
								<!-- <i class="icon icon-check"></i> -->
								<h4>Reabilitação Vocal</h4>	
								<p>Trabalhamos as alterações vocais por meio de técnicas baseadas em evidências para melhorar a qualidade vocal do sujeito e garantir maior eficiência na sua comunicação.</p>								
							</div>
						</div>
				
					</div><!-- ./row -->
					<div class="row wow fadeInUp">
						<div class="col-md-6 col-sm-6">
							<div class="feature-box4 padd-30 text-center">
								<!-- <i class="icon icon-check"></i> -->
								<h4>Cuidados Paliativos em Fonoaudiologia</h4>	
								<p>Os cuidados paliativos tem como filosofia dar conforto e qualidade de vida ao paciente em momentos difíceis da doença. Atuamos com objetivo de zelar pela qualidade de vida e conforto de pacientes em doenças com estagio avançado com foco na alimentação e comunicação.</p>
								
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="feature-box4 padd-30 text-center">
								<!-- <i class="icon icon-check"></i> -->
								<h4>Consultoria Estratégica</h4>	
								<p>Com uma equipe de alta capacidade técnica e conhecimento prático e teórico na área de gestão em saúde, a Fonovitta oferece um trabalho de consultoria estratégica e especializada para serviços de fonoaudiologia hospitalar e domiciliar, atuando na estruturação de novos negócios, desenvolvimento de processos padrões, melhoria contínua e indicadores.</p>
								
							</div>
						</div>
				
					</div><!-- ./row -->


					
			
				</div><!-- ./container -->
			</section>
			<!-- ./NOSSOS SERVIÇOS -->
			

			<!-- NOSSA EQUIPE -->	
			<section id="equipe" class="bg-dark padd-tb-80 image-v1 bg-fixed">
				<div class="container">
				
					<div class="heading text-center padd-b-30 wow fadeIn">
						<h2><strong>NOSSA EQUIPE</strong></h2>
						<div class="separator center"></div>
						
					</div>
					<div class="row">

						@yield('colaboradores')

					</div><!-- ./row -->
					
					
					
					<div class="padd-t-60">
						<div class="row">
							
							<div class="col-md-3 col-sm-6">							
								<div class="counter-box wow fadeInUp">
									<div class="icon-holder bg-red extra-large circle"><i class="icon-heart"></i></div>
									<h4>Hospitais</h4>
									<span class="counter">2</span>
								</div>							
							</div>
							
							<div class="col-md-3 col-sm-6">								
								<div class="counter-box wow fadeInUp">
									<div class="icon-holder bg-blue extra-large circle"><i class="icon-user"></i></div>
									<h4>Pacientes</h4>
									<span class="counter">{{ $pacientes }}</span>
								</div>							
							</div>
							
							<div class="col-md-3 col-sm-6">							
								<div class="counter-box wow fadeInUp">
									<div class="icon-holder bg-orange extra-large circle"><i class="icon-pencil"></i></div>
									<h4>Avaliações</h4>
									<span class="counter">{{ $avaliacoes }}</span>
								</div>							
							</div>
							
							<div class="col-md-3 col-sm-6">								
								<div class="counter-box wow fadeInUp">
									<div class="icon-holder bg-purple extra-large circle"><i class="icon-speech"></i></div>
									<h4>Terapias</h4>
									<span class="counter">{{ $terapias }}</span>
								</div>							
							</div>
							
						</div><!-- ./row -->
					</div>	
						
			
				</div><!-- ./container -->
			</section>
			<!-- ./NOSSA EQUIPE -->
			

			<!-- DEPOIMENTOS -->
			<section id="depoimentos" class="bg-gray padd-tb-60">
				<div class="container">
					<div class="heading text-center padd-b-30 wow fadeIn">
						<h3>DEPOIMENTOS</h3>
						<div class="separator center large"></div>
					</div>

					<div class="row">
						@yield('depoimento_1')
						@yield('depoimento_2')
					</div><!-- ./row -->

					<div class="row">
						@yield('depoimento_3')
						@yield('depoimento_4')
					</div><!-- ./row -->
						
				</div>		
			</section>
			<!-- ./DEPOIMENTOS -->		


			<!-- CONTATO -->
			<section id="contato" class="bg-dark padd-tb-60">
				<div class="container">
				
					<div class="heading text-center padd-b-30 wow fadeIn">
						<h2><strong>ENTRE EM CONTATO</strong></h2>
						<div class="separator center"></div>						
					</div>
				
					<div class="row wow fadeInUp">
					<!--  Working Contact Form With Validation -->					
					
						<div class="col-md-8 col-md-offset-2">
							<form  name="sentMessage" id="contactForm" novalidate>
									
									<div class="control-group form-group">
										<div class="controls">
											<label>Nome</label>
											<input type="text" class="form-control dark" id="name"  required data-validation-required-message="Please enter your name.">
											<p class="help-block"></p>
										</div>
									</div>
									<div class="control-group form-group">
										<div class="controls">
											<label>Email</label>
											<input type="email" class="form-control dark" id="email"  required data-validation-required-message="Please enter your email address.">
											<p class="help-block"></p>
										</div>
									</div>
								
								<div class="control-group form-group">
									<div class="controls">
										<label>Mensagem</label>
										<textarea class="form-control dark" rows="7" id="message"  required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
										<p class="help-block"></p>
									</div>
								</div>
								<div id="success"></div>
								<div class="pull-right">
								<button type="submit" class="btn btn-theme btn-lg">Enviar</button>
								</div>
							</form>
							<div class="clearfix"></div>
						</div>
					
					<!--  ./ Working Contact Form With Validation -->
					</div><!-- ./row -->
					
				</div>			
			</section>

			<!-- footer -->
			<footer class="footer bg-dark padd-tb-60">
				<div class="container">
					<div class="row">
						<div class="col-md-4 mvs-30 wow fadeIn">
							<div class="padd-b-20">
								<a href="#"><img src="{{ URL::asset('dist/img/logo.png') }}" alt="footer logo"> &nbsp; Fonovitta</a>
							</div>
							<p>Fonovitta é um serviço de fonoaudiologia focado no tratamento de distúrbios da deglutição causado pelas mais diversas doenças, como Parkinson, Alzheimer, Câncer e outros.</p>
						</div>
						<div class="col-md-4 mvs-30 wow fadeIn" data-wow-delay=".3s">
							<!-- footer-blog-list -->
							<h4>Endereço</h4>
							<div class="separator"></div>

							<p> Rua Dr. Emílio Ribas, 1.058 - Cambuí <br> 
								Campinas - SP <br> 
								13025-142 <br>
								Telefone: (19) 3294-1470 <br>
								<i>
								De segunda à sexta das 8:00 às 19:00hrs<br>
								Sábados das 8:00 às 12:00hrs
								</i>
							</p>

							<!-- <ul class="list-block">
								<li>
									<a href="#">Blog post for the monthe of August </a> <br>
									<i class="icon icon-calendar"></i> <span class="small">August 22, 2015</span> 
								</li>
								<li>
									<a href="#">Blog post for the monthe of July  </a> <br>
									<i class="icon icon-calendar"></i> <span class="small">July 18, 2015</span> 
								</li>
								<li>
									<a href="#">Blog post for the monthe of June </a> <br>
									<i class="icon icon-calendar"></i> <span class="small">June 9, 2015</span> 
								</li>
								<li>
									<a href="#">Blog post for the monthe of May  </a> <br>
									<i class="icon icon-calendar"></i> <span class="small">May 1, 2015</span> 
								</li>
							</ul>
							<a href="#" class="btn-more">View More</a> -->
							<!-- ./footer-blog-list-->	
						</div>
						<div class="col-md-4 mvs-30 wow fadeIn" data-wow-delay=".6s">
							
							<!-- sitemap -->
							<h4>Mapa do site</h4>
							<div class="separator"></div>
							<ul class="list-block">
								<li><i class="fa fa-angle-right"></i><a href="#home" >Home</a></li>
								<li><i class="fa fa-angle-right"></i><a href="#sobre" >Sobre</a></li>
								<li><i class="fa fa-angle-right"></i><a href="#servico" >Serviço</a></li>
								<li><i class="fa fa-angle-right"></i><a href="#equipe" >Equipe</a></li>
								<li><i class="fa fa-angle-right"></i><a href="#depoimentos" >Depoimentos</a></li>
								<li><i class="fa fa-angle-right"></i><a href="#contato" >Contato</a></li>
							</ul>
							<!-- ./sitemap -->

							<!-- subscribe -->
							<!-- <h4>Inscrever</h4>
							<div class="separator"></div>
							Acompanhe o que estamos fazendo.
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Email...">
								<span class="input-group-btn">
									<button class="btn btn-theme" type="button"><i class="fa fa-check"></i></button>
								</span>
							</div>	 -->
							<!-- ./subscribe -->

						</div>
						
					</div><!-- ./row -->
										
				</div><!-- ./container -->
			</footer>
			<!-- ./footer -->
			
			<!-- footer-sub -->
			<div class="footer-sub bg-light-dark padd-tb-10">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="copyright">
								2014 &copy; Todos direitos reservados.
							</div>
						</div>
						<div class="col-md-6">
							<ul class="list-inline pull-right">
								<li><a href="http://www.facebook.com/fonovittafonoaudiologia" target="_blank" class="icon-holder small circle"><i class="fa fa-facebook"></i></a></li>
								<!-- <li><a href="#" class="icon-holder small circle"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" class="icon-holder small circle"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#" class="icon-holder small circle"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#" class="icon-holder small circle"><i class="fa fa-youtube-play"></i></a></li> -->
							</ul>
						</div>	
					</div><!-- ./row -->
				</div><!-- ./container -->
			</div>
			<!-- ./footer-sub -->
						
				
		</div>
		<!-- //wrapper -->
		
						
		<!-- Styles Switcher  please remove this in production-->
		
		<!-- <div id="style-switcher">
			<h2>Style Switcher <a href="#"></a></h2>
			
			<div><h3>Predefined Colors</h3>
				<ul class="colors" id="color1">
					<li><a href="#" class="green" title="Green"></a></li>
					<li><a href="#" class="blue" title="Blue"></a></li>
					<li><a href="#" class="orange" title="Orange"></a></li>
					<li><a href="#" class="red" title="Red"></a></li>
					<li><a href="#" class="purple" title="Red"></a></li>
					<li><a href="#" class="aqua" title="Aqua"></a></li>
					<li><a href="#" class="brown" title="Brown"></a></li>
					<li><a href="#" class="dark-blue" title="Dark-Blue"></a></li>
					<li><a href="#" class="light-green" title="Light-Green"></a></li>
					<li><a href="#" class="dark-red" title="Dark-Red"></a></li>
					<li><a href="#" class="teal" title="Teal"></a></li>
					<li><a href="#" class="dark-purple" title="Dark-Purple"></a></li>
				</ul>

				
			<h3>Layout Style</h3>
			<div class="layout-style">
				<select id="layout-switcher">
					<option value="wide">Wide</option>
					<option value="boxed">Boxed</option>					
				</select>
			</div>
			
			<h3>Background Image</h3>
				 <ul class="colors bg" id="bg">
					<li><a href="#" class="image-v1"></a></li>
					<li><a href="#" class="image-v2"></a></li>
					<li><a href="#" class="image-v3"></a></li>
				</ul>
				
			<h3>Background Color</h3>
				<ul class="colors bgsolid" id="bgsolid">
					<li><a href="#" class="green-bg" title="Green"></a></li>
					<li><a href="#" class="blue-bg" title="Blue"></a></li>
					<li><a href="#" class="orange-bg" title="Orange"></a></li>
					<li><a href="#" class="red-bg" title="Red"></a></li>
					<li><a href="#" class="purple-bg" title="Red"></a></li>
					<li><a href="#" class="aqua-bg" title="Aqua"></a></li>
					<li><a href="#" class="brown-bg" title="Brown"></a></li>
					<li><a href="#" class="dark-blue-bg" title="Dark-Blue"></a></li>
					<li><a href="#" class="light-green-bg" title="Light-Green"></a></li>
					<li><a href="#" class="dark-red-bg" title="Dark-Red"></a></li>
					<li><a href="#" class="teal-bg" title="Teal"></a></li>
					<li><a href="#" class="dark-purple-bg" title="Dark-Purple"></a></li>

				</ul></div>
			
		</div> -->
		<!-- ./Styles Switcher -->	
		
		
					
		<!-- jquery -->
		<script src="{{ URL::asset('clarity/js/jquery-1.11.3.min.js') }}"></script>	
		<script src="{{ URL::asset('clarity/js/bootstrap.min.js') }}"></script>
	
		<!-- morris -->	
		<script src="../../../cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/morris/morris.min.js') }}"></script>  
		
		<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>  
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
		
		<!-- validator  -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/validator/validator.min.js') }}"></script> 
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/validator/form-scripts.js') }}"></script> 
			
		<!-- magnific-popup -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
		
		<!-- owl-carousel -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
		
		<!-- wow -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/wow/wow.js') }}"></script>
		
		<!-- appear -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/appear/jquery.appear.js') }}"></script>
		
		<!-- waypoints -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
				
		<!-- counter-up -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/counterup/jquery.counterup.min.js') }}"></script>
		
		<!-- countdown -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/countdown/jquery.countdown.min.js') }}"></script> 
		
		<!-- gmaps  -->
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/gmaps/gmaps.js') }}"></script>	  
	
		<!-- smooth-scroll -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/smooth-scroll/smooth-scroll.js') }}"></script> 
		
		<!-- flexslider -->
		<script type="text/javascript" src="{{ URL::asset('clarity/plugins/flexslider/jquery.flexslider-min.js') }}"></script> 
		

		<!-- switcher -->
		<script type="text/javascript" src="{{ URL::asset('clarity/switcher/switcher.js') }}"></script> 
		
		<!-- main -->		
		<script src="{{ URL::asset('clarity/js/main.js') }}"></script>
		
			
	</body>

<!-- Mirrored from bootstrapwizard.info/Theme/clarity/home-portfolio.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Apr 2016 13:01:33 GMT -->
</html>
			
			
			
			
		

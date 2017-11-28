@extends('layouts.site')


	@section('titulo')
		FONOVITTA
	@endsection

	@section('sub_titulo')
		Fonoaudiologia de Excelência
	@endsection


	<!-- SOBRE O SERVIÇO -->
	@section('sobre')
		Nós amamos o que fazemos e para quem fazemos.
	@endsection

	@section('missao')
		<b>Compromisso</b> em garantir um serviço fonoaudiológico de <b>excelência</b> com <b>integridade</b> promovendo qualidade de vida aos nossos clientes.
	@endsection

	@section('visao')
		Ser uma empresa referência no mercado, capaz de desenvolver estudos e técnicas que contribuam para o desenvolvimento da ciência fonoaudiológica.
	@endsection

	@section('valores')
		Respeito pelas pessoas que confiam suas vidas à nossa equipe.<br><br>
	@endsection


	<!-- NOSSA EQUIPE -->
	@section('colaboradores')

		<!-- FAZER UM 'for' PARA PASSAR POR TODOS COLABORADORES -->
		@foreach($usuarios as $usuario)
		<div class="col-sm-6 col-md-4">
			<div class="team wow fadeInUp">
				<img src="{{ URL::asset('dist/img/avatar/' . $usuario->foto ) }}" class="img-responsive" alt="">
				<div class="content">
					{{ $usuario->nome }} <br>
					<small>{{ $usuario->cargo }}</small>
					<ul class="list-inline">
						<li><a href="#" class="icon-holder facebook medium circle"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" class="icon-holder twitter medium circle"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" class="icon-holder skype medium circle"><i class="fa fa-skype"></i></a></li>
						<li><a href="#" class="icon-holder linkedin medium circle"><i class="fa fa-linkedin"></i></a></li>
					</ul>
				</div>								
			</div>
		</div>
		@endforeach

	@endsection


	<!-- DEPOIMENTOS -->
	@section('depoimento_1')
		<div class="col-md-6">
			<div class="testimonial light wow fadeInUp">
				<div class="image-box">
					<!-- <img src="{{ URL::asset('clarity/img/face1.jpg') }}" class="img-circle img-responsive" alt="image"> -->
					<i class="fa fa-4x fa-thumbs-up"></i>
				</div>
				<div class="content-box">
					<p>Então, depois que comecei o atendimento de fonoaudiologia, melhorou muito, com o estilo dela. Eu acho que ela vai indo por um bom caminho. Eu gosto muito dela, ela não deixa a peteca cair. Os exercícios melhoraram pra mim, principalmente aqueles da voz. Ajudou bastante na voz. E não vejo nenhum aspecto negativo, só positivo.<p>
					<strong>Maria de Lourdes G. F.</strong>
					<span>Reabilitação de voz e deglutição, Parkinson.</span>
				</div>
			</div>
		</div>
	@endsection

	@section('depoimento_2')
		<div class="col-md-6">
			<div class="testimonial light wow fadeInUp">
				<div class="image-box">
					<!-- <img src="img/face2.jpg" class="img-circle img-responsive" alt="image"> -->
					<i class="fa fa-4x fa-thumbs-up"></i>
				</div>
				<div class="content-box">
					<p>
						Eu adorei porque senti a evolução, lenta, em função do meu problema, mas assim, muito eficaz, em função de quem tá trabalhando comigo, que é uma pessoa maravilhosa, que eu adoro, sabe trabalhar. Ela é competente e o trabalho está sendo muito bem feito, eu tenho sentido... Hoje eu tô feliz, eu senti os músculos que não tavam sendo sentidos, não são usados. Eu tô muito satisfeita, agradeço de coração essa funcionária que Deus colocou na minha vida. Obrigada.<p>
					<strong>Maria Eliza G. V.</strong>
					<span>Paralisia facial pós TCE</span>
				</div>
			</div>
		</div>
	@endsection

	@section('depoimento_3')
		<div class="col-md-6">
			<div class="testimonial light wow fadeInUp">
				<div class="image-box">
					<!-- <img src="img/face3.jpg" class="img-circle img-responsive" alt="image"> -->
					<i class="fa fa-4x fa-thumbs-up"></i>
				</div>
				<div class="content-box">
					<p>Eu não tinha experiência com a fonoaudiologia e, depois que fui diagnosticado com Doença de Parkinson, comecei a ter problemas de fala e deglutição, a terapia fonoaudiológica me ajudou muito. Eu sempre fui da área da comunicação, trabalhava no comércio e teatro, sempre precisei da voz e se ela falha eu fico deprimido. Então, além do efeito terapêutico obtive melhora psicológica.<p>
					<strong>Vicente Camargo X. </strong>
					<span>Reabilitação de voz e deglutição, Parkinson.</span>
				</div>
			</div>
		</div>		
	@endsection

	@section('depoimento_4')
		
	@endsection
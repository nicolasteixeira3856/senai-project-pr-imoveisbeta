<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta name="description" content=" Pr Imóveis Beta trabalha com Casas, Apartamentos, Sobrados, Kitinete, Flat, Pontos Comercias, Loja, Barração e Terrenos" >
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta name="google-site-verification" content="-zyKIhnGnKZ0yagpq-gKw4cnTFzQUR2b-aZoIWJUBqY" />
		<meta charset="utf-8">
		<meta name="robots" content="index,nofollow">
        <meta property="og:locale" content="pt_BR">
        <meta name="keywords" content="Casas, Apartamentos, Sobrados, Kitinete, Flat, Pontos Comercias, Loja, Barração, Terrenos, Paraná, Curitiba, Venda, Aluguel">
        <meta property="og:description" content="A Pr Imóveis Beta é sua solução para imóveis?">
        <title>PR Imóveis Beta - Casas, Apartamentos, Sobrados, Kitinete, Flat, Pontos Comercias, Loja, Barração e Terrenos</title>
		<link rel="StyleSheet" href="assets/css/bootstrap.css">
		<link rel="StyleSheet" href="assets/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Acme|Fjalla+One|Open+Sans|Slabo+27px" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-82252894-1', 'auto');
			ga('send', 'pageview');
		</script>
	</head>
	<body>
	<style>
	.titulo{
	font-family: 'Open Sans', sans-serif;
	font-size: 23px;
	}
	.outrasinfo{
	font-family: 'Slabo 27px', serif;
	font-size: 19px;
	}
	.Foco{
	font-family: 'Acme', sans-serif;
		font-size: 31px;
	}
	.atencao{
		font-family: 'Acme', sans-serif;
		font-size: 18px;
	}
	.letraslide{
		font-family: 'Fjalla One', sans-serif;
		font-size: 32px;
	}
	</style>
		<?php
                include'assets/menu.php';
		?>
		<!-- Carousel -->
		<div id="myCarousel" class="carousel slide container" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		  </ol>
		  <div class="carousel-inner" role="listbox">
			<div class="item active">
			  <img class="first-slide" src="assets/img/img4.jpg" alt="Agende uma consulta com nossos corretores e impulsione a sua felicidade.">
			  <div class="">
				<div class="carousel-caption">
				  <h2 class="letraslide">Seja feliz com a sua família.</h2>
				  <p class="atencao">Agende uma visita com nossos corretores e impulsione a sua felicidade.</p>
				  <p><a class="btn btn-lg btn-primary" href="cadastrologin.php" role="button">Cadastrar-se</a></p>
				</div>
			  </div>
			</div>
			<div class="item">
			  <img class="second-slide" src="assets/img/img2.jpg" alt="Visite e avalie o interior de nossos imóveis.">
			  <div class="">
				<div class="carousel-caption">
				  <h2 class="letraslide">Visite e avalie o interior de nossos imóveis.</h2>
				  <p class="atencao">Agende uma consulta com nossos corretores, é fácil e gratuito.</p>
				  <p><a class="btn btn-lg btn-primary" href="cadastrologin.php" role="button">Cadastrar-se</a></p>
				</div>
			  </div>
			</div>
			<div class="item">
			  <img class="third-slide" src="assets/img/img3.jpg" alt="Criamos uma página especial para quem deseja nos conhecer melhor.">
			  <div class="">
				<div class="carousel-caption">
				  <h2 class="letraslide" >Deseja conhecer nossa empresa?</h2>
				  <p class="atencao">Criamos uma página especial para quem deseja nos conhecer melhor.</p>
				  <p><a class="btn btn-lg btn-primary" href="sobre.php" role="button">Visite-a</a></p>
				</div>
			  </div>
			</div>
		  </div>
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
		</div><!-- /.carousel -->
		<hr style="border:2px solid #1A5E86;">
		<!-- Começo dos imóveis destacados -->
		<div class="container">
			<p class="Foco">Recentemente cadastrados</p>
			<p class="bg-info">
				<strong class="atencao" style="font-size:15px !important">Confira abaixo os imóveis recentemente cadastrados em nosso site.</strong>
			</p>
			<br>
			<?php
				include_once "assets/phpbd/connection.php";
			
				/*Selecionar as tabelas*/
				
				$sql = "SELECT * FROM Imoveis_tb
				JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
				JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
				JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
				ORDER BY Imoveis_tb.id_imovel DESC LIMIT 5";
					
				$listarimovel = $conet -> prepare($sql);
				$listarimovel -> execute();
					
					
				foreach($listarimovel as $lsimv){	
				$valor = number_format($lsimv['valor'],2,",",".");				
					echo"<div class='row'>
							<div class='col-md-4'>
								<img src='assets/img/fotosimoveis/".$lsimv['foto_principal']."' alt='Imóvel' width='300px' height='250px' class='img-rounded'><br><br>
							</div>
							<div class='col-md-6'>
							
							<p class='titulo'>	".$lsimv['titulo']."<br></p>
								<p class='outrasinfo'>Cidade: ".$lsimv['nome_cidade']."<br>
								Bairro: ".$lsimv['nome_bairro']."<br>
								Valor: ".$valor."<br></p>
                            </div>
                            <div class='col-md-4'>
								<a href='imovel.php?id=".$lsimv['id_imovel']."'><button type='submit' class='btn colorbck' id='button' value='CONFIRMAR' style='width:65%; margin-bottom:15px;'>Visualizar imovel</button></a>
							</div>
						</div>
					";
				}
			?>		
		</div><br>
		<!-- Final dos imóveis destacados -->
		<!-- Footer -->
		<?php
               include'assets/footer.php';
		?>
		<!-- Footer -->
	</body>
</html>
	
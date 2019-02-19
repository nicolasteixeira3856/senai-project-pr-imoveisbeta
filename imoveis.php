<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta name="description" content=" Pr Imóveis Beta trabalha com Casas, Apartamentos, Sobrados, Kitinete, Flat, Pontos Comercias, Loja, Barração e Terrenos" >
        <meta name="viewport" content="width=device-width, user-scalable=no">
         <meta name="robots" content="index,follow">
		<meta charset="utf-8">
        <title>Imóveis</title>
		 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
		 <link href="https://fonts.googleapis.com/css?family=Acme|Fjalla+One|Open+Sans|Slabo+27px" rel="stylesheet">
		<link rel='stylesheet prefetch' href='https://cdn.gitcdn.link/cdn/angular/bower-material/v1.1.3/angular-material.css'>
		<link rel='stylesheet prefetch' href='https://material.angularjs.org/1.1.3/docs.css'>

		<link rel="StyleSheet" href="assets/css/bootstrap.css">
		<link rel="StyleSheet" href="assets/css/style.css">
		<link rel="StyleSheet" href="assets/css/form-cdst-elements.css">
		<script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="../../../assets/js/jquery.maskMoney.js" type="text/javascript"></script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-82252894-1', 'auto');
		  ga('send', 'pageview');

		</script>
	
	</head>
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
	.descricao{
	font-family: 'Slabo 27px', serif;
	font-size: 19px;
	  text-align: justify;
    text-justify: inter-word;
	}
.img:hover
{
        -webkit-transform: scale(1.3);
        -ms-transform: scale(1.3);
        transform: scale(1.3);
}
	</style>

	<body  style="color:black">
		<?php
			include_once'assets/menu.php';
		?>
		<?
		include_once "assets/phpbd/connection.php"; 
		$sql="SELECT MAX(valor) FROM Imoveis_tb";
		$max= $conet -> prepare($sql);
		$max-> execute();
		foreach($max as $mx){
		$novomax = explode('.',$mx['MAX(valor)']);
		$_SESSION['maximo'] = $novomax;
		$_SESSION['maximo'] = intval($_SESSION['maximo'][0]);
		}
		$max = $_SESSION['maximo'];
		
				$sql2="SELECT MIN(valor) FROM Imoveis_tb";
		$min= $conet -> prepare($sql2);
		$min-> execute();
		foreach($min as $mn){
			$novomin = explode('.',$mn['MIN(valor)']);
			$_SESSION['minimo'] = $novomin;
			 $_SESSION['minimo'] = intval($_SESSION['minimo'][0]);
		}
		$min = $_SESSION['minimo'];
		?>
        		<!--Inicio do menu lateral -->
	<div id="site-wrapper" style="height:auto;">
		<div id="site-canvas">
			<div id="site-menu">
				<h2>Filtro</h2>
				<p class="lead">Selecione o Filtro</p>

			<form method="POST" action="">  
				<div ng-controller="AppCtrl" ng-cloak="" class="sliderdemoBasicUsage" ng-app="MyApp" style="background-color: #428bca" layout="column" >
					<md-content style="background-color: #428bca" layout="column">
					<h2 style="text-align: center; color: #444">Valor</h2>
					<md-slider-container ng-disabled="isDisabled" layout="column">
					<md-input-container>
						R$<input flex="" type="number" ng-disabled="true" name="slider" id="slider" ng-model="disabled1" aria-label="green" aria-controls="green-slider" style="width:100px">
					</md-input-container>
					<md-slider ng-model="disabled1" aria-label="Disabled1" min="<?php echo $min;?>" max="<?php echo $max;?>" flex=""  ng-readonly="readonly" style="width:90%"></md-slider>
				</div>
			<br><br>
			<div id="hearts">
				<a href="#" data-transition="ease"><span class="glyphicon glyphicon-search pesquisa" style="margin-left:280px; color: #250096;" aria-hidden="true"></span></a><br><br><br><br>
			</div>
			
			   <select class="form-selected " name="negociacao" id="negociacao">
				    <option value="negociacao" disabled selected hidden>Negociação...</option> 
				    <option value="1">Venda</option> 
				    <option value="2">Aluguel</option> 
				</select><br><br>
                <select class="form-selected" name="tipo">
				    <option value="tipo" disabled selected hidden>Tipo...</option> 
				    <option value="1">Casa</option> 
				    <option value="2">Apartamento</option> 
				    <option value="3">Sobrado</option> 
				    <option value="4">Kitinete</option> 
				    <option value="5">Flat</option> 
				    <option value="6">Ponto comercial</option> 
                    <option value="7">Loja</option> 
				    <option value="8">Barracão</option> 
				    <option value="9">Terreno</option> 
				</select><br><br>
				<select class="form-selected" name="finalidade">
					<option value="finalidade" disabled selected hidden>Finalidade...</option> 
					<option value="1">Residencial</option> 
					<option value="2">Comercial</option> 
					<option value="3">Industrial</option> 
				</select><br><br>
                <select class="form-selected" name="regiao">
				    <option value="regiao" disabled selected hidden>Região...</option> 
                    <option value="1">Norte</option> 
				    <option value="2">Sul</option> 
				    <option value="3">Leste</option> 
				    <option value="4">Oeste</option> 
				</select><br><br>
				<select class="form-selected" name="cidade" id="cidade">
					<option value="cidade" disabled selected hidden>Cidade...</option> 
					<?php
					/*Lista todas as cidades do banco*/
					include_once "assets/phpbd/connection.php";

					$sqlcidade = "SELECT * FROM Cidade_tb order by nome_cidade asc";

					$listacidade = $conet -> prepare($sqlcidade);
					$listacidade -> execute();

					foreach($listacidade as $lsc){
					echo "<option value=".$lsc['id_cidade'].">".$lsc['nome_cidade']."</option> ";
					}
					?>
				</select><br><br>
				<br><input type="submit" name="vtc" class="btn" id="vtc" style="width:100%; background-color:#1A5E86; color:white;" value="Filtrar">
			</form>
			</div>
			<div id="hearts">
				<a href="#" data-transition="ease"><i class="fa fa-heart"><span class="glyphicon glyphicon-search" style="color: #250096;" aria-hidden="true">Pesquisar</span></i></a><br><br><br><br>
        </div>
	<!--FIm do menu -->
<div class="container">
            <?php
				include_once "assets/phpbd/connection.php";
				
				if(isset($_POST['vtc'])){
					
					//item_pesquisa ira pegar o campo
					$negociacao = $_POST['negociacao'];
					$slider = $_POST['slider'];
					$tipo = $_POST['tipo'];
					$regiao = $_POST['regiao'];
					$finalidade = $_POST['finalidade'];
					$cidade = $_POST['cidade'];
					
					if($n_quartos == ""){
						$n_quartos = NULL;
					}
					
					if($aream2 == ""){
						$aream2 = NULL;
					}
					
					if ($slider == 0){
						$slider = "99999999999999999.00";

					}
					
					/*Limita o número de registros a serem mostrados por página*/
					$limite_img = 12;
					
					/*Se pg não existe atribui 1 a variável pg*/
					$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1 ;
					
					/*Atribui a variável inicio o inicio de onde os registros vão ser mostrados por página, exemplo 0 à 12, 12 à 24 e assim por diante*/
					$inicio = ($pg * $limite_img) - $limite_img;
					
					//aqui faz o comando sql LIKE que pegara o que o usuario digitou
					/*Seleciona as tabelas*/
					$sql = "SELECT * FROM Imoveis_tb
							JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
							JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
							JOIN Finalidade_tb ON Imoveis_tb.id_fin = Finalidade_tb.id_fin
							JOIN Tipo_tb ON Imoveis_tb.id_tipo = Tipo_tb.id_tipo
							JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
							JOIN Regiao_tb ON Imoveis_tb.id_regiao = Regiao_tb.id_regiao
							WHERE Imoveis_tb.id_nego LIKE '%$negociacao%'
							AND Imoveis_tb.id_tipo LIKE '%$tipo%'
							AND Imoveis_tb.id_fin LIKE '%$finalidade%'
							AND Imoveis_tb.id_cidade LIKE '%$cidade%'
							AND Imoveis_tb.id_regiao LIKE '%$regiao%'
							AND Imoveis_tb.valor < '$slider'";
					
					$limite = $conet -> prepare("$sql LIMIT $inicio,$limite_img");
					$limite -> execute();

					
					if( $limite -> rowCount() > 0){
						/*Exibindo os imoveis*/
						while ($lsimv = $limite->fetch(PDO::FETCH_ASSOC)) {									
								$valor = number_format($lsimv['valor'],2,",",".");
								echo"<div class='row'>
										<div class='col-md-6'>
											<a href='imovel?id=".$lsimv['id_imovel']."'><img src='assets/img/fotosimoveis/".$lsimv['foto_principal']."' alt='Destaque1' width='420px' height='300px'><br><br></a>
										</div>
										<div class='col-md-6'>
										
											<p class='titulo'> ".$lsimv['titulo']."<br></p>
											<p class='outrasinfo'>
											Área m²: ".$lsimv['aream2']."<br>
											Valor: R$ ".$valor."<br></p>
											<p class='descricao'>Descrição:  ".$lsimv['descricao']."<br></p>
										</div>
	

								";
						}
					}else{
						echo"<h3 style='color:red;'>Nada encontrado</h3>";
					}
					$sql_total = "SELECT * FROM imoveis_tb 
								WHERE imoveis_tb.id_nego 
								LIKE '%$negociacao%' 
								AND imoveis_tb.valor LIKE '%$valor%'
								AND imoveis_tb.id_tipo LIKE '%$tipo%'
								AND imoveis_tb.id_regiao LIKE '%$regiao%'
								";
					
					
					$total = $conet -> prepare($sql_total);
					$total -> execute();
					
					$query_result = $total->fetchAll(PDO::FETCH_ASSOC);
	   
					/*conta quantos registros tem no banco de dados*/
					$query_count =  $total->rowCount(PDO::FETCH_ASSOC);
					  
					/*calcula o total de paginas a serem exibidas*/
					$qtdPag = ceil($query_count/$limite_img);
					
					$anterior = $pg -1;
					$proximo = $pg +1;
				?>

	<nav aria-label="Page navigation">
					<ul class="pagination ">
				<?php
						if($pg>1){
							echo"<li>
								<a href='imoveis.php?pg=".$anterior."' aria-label='Previous'>
								<span aria-hidden='true'>&laquo;</span>
							</a>
							</li>";
						}else{
							echo"<li class='disabled'>
								<a aria-label='Previous'>
								<span aria-hidden='true'>&laquo;</span>
							</a>
							</li>";
						};
					/*Cria os links para navegação das paginas*/
					if($qtdPag > 1 && $pg<= $qtdPag){
						for($i=1; $i <= $qtdPag; $i++){					  
							if($i == $pg){								  
								echo "<li class='active'><a>".$i."</a></li>";
							}else{						   
								echo "<li><a href='imoveis.php?pg=$i'>".$i."</a></li>";
							}
						}
					}
					if($pg < $qtdPag){	
						echo"<li>
							<a href='imoveis.php?pg=".$proximo."' aria-label='Next'>
								<span aria-hidden=true'>&raquo;</span>
							</a>
						</li>";
					}else{
						echo"<li class='disabled'>
							<a aria-label='Next'>
								<span aria-hidden=true'>&raquo;</span>
							</a>
						</li>";
					};
				?>
				  </ul>
				</nav>
				<?php
				}else{
				
					/*Limita o número de registros a serem mostrados por página*/
					$limite_img = 12;
					
					/*Se pg não existe atribui 1 a variável pg*/
					$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1 ;
					
					/*Atribui a variável inicio o inicio de onde os registros vão ser mostrados por página, exemplo 0 à 12, 12 à 24 e assim por diante*/
					$inicio = ($pg * $limite_img) - $limite_img;
					
					/*Seleciona as tabelas*/
					$sql = "SELECT * FROM Imoveis_tb
							JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
							JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
							JOIN Finalidade_tb ON Imoveis_tb.id_fin = Finalidade_tb.id_fin
							JOIN Tipo_tb ON Imoveis_tb.id_tipo = Tipo_tb.id_tipo
							JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
							JOIN Regiao_tb ON Imoveis_tb.id_regiao = Regiao_tb.id_regiao";
					$limite = $conet -> prepare("$sql LIMIT $inicio,$limite_img");
					$limite -> execute();
				 
					/*Exibindo os imoveis*/
					while ($lsimv = $limite->fetch(PDO::FETCH_ASSOC)) {	
							$valor = number_format($lsimv['valor'],2,",",".");					
							echo"<div class='row'>
										<div class='col-md-6'>
											<a href='imovel?id=".$lsimv['id_imovel']."'><img src='assets/img/fotosimoveis/".$lsimv['foto_principal']."' alt='Destaque1' width='420px' height='300px'><br><br></a>
										</div>
									<div class='col-md-6'>
				<p class='titulo'> ".$lsimv['titulo']."<br></p>
											<p class='outrasinfo'>
											Área m²: ".$lsimv['aream2']."<br>
											Valor: R$ ".$valor."<br></p>
											<p class='descricao'>Descrição:  ".$lsimv['descricao']."<br></p>
									</div>

								</div>
								<br><br>
							";
					}
					
					$sql_total = "SELECT * FROM imoveis_tb";
					
					$total = $conet -> prepare($sql_total);
					$total -> execute();
					
					$query_result = $total->fetchAll(PDO::FETCH_ASSOC);
	   
					/*conta quantos registros tem no banco de dados*/
					$query_count =  $total->rowCount(PDO::FETCH_ASSOC);
					  
					/*calcula o total de paginas a serem exibidas*/
					$qtdPag = ceil($query_count/$limite_img);
					
					$anterior = $pg -1;
					$proximo = $pg +1;
				?>				

				<nav aria-label="Page navigation">
					<ul class="pagination ">
				<?php
						if($pg>1){
							echo"<li>
								<a href='imoveis.php?pg=".$anterior."' aria-label='Previous'>
								<span aria-hidden='true'>&laquo;</span>
							</a>
							</li>";
						}else{
							echo"<li class='disabled'>
								<a aria-label='Previous'>
								<span aria-hidden='true'>&laquo;</span>
							</a>
							</li>";
						};
					/*Cria os links para navegação das paginas*/
					if($qtdPag > 1 && $pg<= $qtdPag){
						for($i=1; $i <= $qtdPag; $i++){					  
							if($i == $pg){								  
								echo "<li class='active'><a>".$i."</a></li>";
							}else{						   
								echo "<li><a href='imoveis.php?pg=$i'>".$i."</a></li>";
							}
						}
					}
					if($pg < $qtdPag){	
						echo"<li>
							<a href='imoveis.php?pg=".$proximo."' aria-label='Next'>
								<span aria-hidden=true'>&raquo;</span>
							</a>
						</li>";
					}else{
						echo"<li class='disabled'>
							<a aria-label='Next'>
								<span aria-hidden=true'>&raquo;</span>
							</a>
						</li>";
					};
				?>	
			

			</div>
			</ul>
			</nav>

		</div>
				<?php } ?>
				</div>
		<div style="margin-top:700px">
		<!-- Footer -->
		<?php
			include'assets/footer.php';
		?>
		<!-- Footer -->
		</div>
<script>


$(function() {

  var special = ['reveal', 'top', 'boring', 'perspective', 'extra-pop'];

  // Toggle Nav on Click
  $('#hearts a').click(function() {

    var transitionClass = $(this).data('transition');

    if ($.inArray(transitionClass, special) > -1) {
      $('body').removeClass();
      $('body').addClass(transitionClass);
    } else {
      $('body').removeClass();
      $('#site-canvas').removeClass();
      $('#site-canvas').addClass(transitionClass);
    }

    $('#site-wrapper').toggleClass('show-nav');

    return false;

  });

});
</script>
  <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-route.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js'></script>
<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-114/svg-assets-cache.js'></script>
<script src='https://cdn.gitcdn.link/cdn/angular/bower-material/v1.1.3/angular-material.js'></script>
<script>
angular.module('MyApp',['ngMaterial', 'ngMessages', 'material.svgAssetsCache'])
  .config(function($mdIconProvider) {
    $mdIconProvider
      .iconSet('device', 'img/icons/sets/device-icons.svg', 24);
  })
.controller('AppCtrl', function($scope) {


  $scope.disabled1 = 0;

});


/**
Copyright 2016 Google Inc. All Rights Reserved. 
Use of this source code is governed by an MIT-style license that can be foundin the LICENSE file at http://material.angularjs.org/HEAD/license.
**/
</script>
	</body>
</html> 
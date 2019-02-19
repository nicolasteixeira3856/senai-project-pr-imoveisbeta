<?php
	include_once"assets/phpbd/connection.php";
	
		$id_imovel = $_GET['id'];
	
		/*Selecionar as tabelas*/
		
		$sql = "SELECT * FROM Imoveis_tb
			JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
			JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
			JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
			JOIN Regiao_tb ON Imoveis_tb.id_regiao = Regiao_tb.id_regiao
			JOIN Finalidade_tb ON Imoveis_tb.id_fin = Finalidade_tb.id_fin
			JOIN Tipo_tb ON Imoveis_tb.id_tipo = Tipo_tb.id_tipo
			WHERE Imoveis_tb.id_imovel = '$id_imovel'";
			
		$listarimovel = $conet -> prepare($sql);
		$listarimovel -> execute();
			
			
		foreach($listarimovel as $lsimv){}

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<meta charset="utf-8">
		<title>Visualizando Imóvel: <?php echo $lsimv['titulo'] ?></title>
		<link rel="StyleSheet" href="assets/css/bootstrap.css">
		<link rel="StyleSheet" href="assets/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
		<link rel="stylesheet" href="assets/css/thumbnail-gallery.css">
		<script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="assets/js/jquery.cycle.all.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-82252894-1', 'auto');
			  ga('send', 'pageview');
			  
			$(function(){
				$("#slideshow").cycle({
					fx:'fade',
					speed:2000,
					timeout:4000
				});
			});
		</script>
	</head>
	<body>
		<?php
			include_once'assets/menu.php';
			@$id_usuario = $_SESSION["id"];
			
			echo"<input type='hidden' id='id_usuario' value=".$id_usuario.">";
			echo"<input type='hidden' id='id_imovel' value=".$id_imovel.">";

		?>
		 <div class="container">   
			<div class="row">
				<!--Slides Show aqui-->
				<div class="col-md-8">
					<div id="slideshow" class="tz-gallery">

					<div class='thumbnail'>
                    <a class='lightbox' href='assets/img/fotosimoveis/<?php echo $lsimv['foto_principal'] ?>'>
                        <img src="assets/img/fotosimoveis/<?php echo $lsimv['foto_principal'] ?>" class="img" alt="slides">
                    </a>
                </div>
						<
						<?php 
							$sqlfoto = "SELECT * FROM Foto_tb WHERE id_imovel = $id_imovel";
							
							$pegafoto = $conet -> prepare($sqlfoto);
							$pegafoto -> execute();
							
							foreach($pegafoto as $pf){
								echo"
									
									<div class='thumbnail'>
                    <a class='lightbox img'  href='assets/img/fotosimoveis/". $pf['img']."'>
                        <img src='assets/img/fotosimoveis/".$pf['img']."' class='img'  alt='slides'>
                    </a>
                </div>
								";
							}
						?>
								
							
						</div>
					<br><br>
					<span id="msg"></span>
					<?php
						if ((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)) {                    
							echo"	<div class='bnimv' style='text_decoration:none;'>Para reservar imóvel ou adicionar aos favoritos por favor <a href='cadastrologin'> efetuar login</a>.<br></div>
									<button type='submit' class='btn btn-default btn-lg colorbck bnimv' disabled='disabled'><span class='glyphicon glyphicon-heart-empty' aria-hidden='true'></span> Adicionar aos Favoritos</button>
									<button type='submit' class='btn btn-default btn-lg colorbck' disabled='disabled'>Reservar imóvel</button><br>
								";								
						}else{
							if(($_SESSION['nivel'] == 1) || ($_SESSION['nivel'] == 2)){
								echo"	<div class='bnimv' style='text_decoration:none;'>Para reservar imóvel ou adicionar aos favoritos, por favor logue como cliente<br></div>
									<button type='button' class='btn btn-default btn-lg colorbck bnimv' disabled='disabled'><span class='glyphicon glyphicon-heart-empty' aria-hidden='true'></span> Adicionar aos Favoritos</button>
									<button type='button' class='btn btn-default btn-lg colorbck' disabled='disabled'>Reservar imóvel</button><br>
								";
							}else{
								echo"<div id='localBotao'></div>";
							}
						}
					?>
					
					<br><h2>Descrição</h2><br>
					<article>
					<?php echo $lsimv['descricao'] ?> <br><br>
					</article>
				</div>
				<div class="col-md-4 espaco">
					<div class="">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<article>
											<a role="button" style="text-decoration:none;" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												<?php echo $lsimv['titulo'] ?>
											</a>
										</article>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">
											<article>
											<?php 
											$valor = number_format($lsimv['valor'],2,",",".");
											?>
												Finalidade: <?php echo $lsimv['finalidade'] ?> <br>
												Rua <?php echo $lsimv['Rua'] ?> Nº <?php echo $lsimv['nrua'] ?> <br>
												Cidade: <?php echo $lsimv['nome_cidade'] ?> <br>
												Bairro: <?php echo $lsimv['nome_bairro'] ?> <br>
												Região:<?php echo $lsimv['nome_regiao'] ?> <br>
												Imóvel para: <?php echo $lsimv['tipo_nego'] ?> <br>
												Tipo: <?php echo $lsimv['nome_tipo'] ?> <br>
												Area M2: <?php echo $lsimv['aream2'] ?> <br>
												Número de vagas: <?php echo $lsimv['n_vagas'] ?> <br>
												Número de quartos: <?php echo $lsimv['n_quartos'] ?> <br>
												Preço: <?php echo "R$ ".$valor ?> <br><br>
											</article>
									</div>											
								</div>								
							</div>
						</div>	
						
					</div>	
				</div>
			</div>
		</div><br>
	
	<br><br>
		<!-- Footer -->
		<?php
			include'assets/footer.php';
		?>
		<!-- Footer -->
		<script>
			/*Function para gerar os botoes*/
			$(document).ready(function(){
				var id_usuario=$('#id_usuario').val();
				var id_imovel=$('#id_imovel').val();
				
				$.ajax({
					url:"assets/phpbd/getFavResBtn.php",
					type:"POST",
					data: "id_usuario="+id_usuario+"&tipo=getBotao&id_imovel="+id_imovel,
					success: function (result){
						$('#localBotao').html(result);
					}
				})
			})
			
			function attBotao(){
				
				var id_usuario=$('#id_usuario').val();
				var id_imovel=$('#id_imovel').val();
				
				$.ajax({
					url:"assets/phpbd/getFavResBtn.php",
					type:"POST",
					data: "id_usuario="+id_usuario+"&tipo=getBotao&id_imovel="+id_imovel,
					success: function (result){
						$('#localBotao').html(result);
					}
				})
				
			}
			
			/*função para adicionar aos favoritos*/
			
			function addfav(){
				
				var id_usuario=$('#id_usuario').val();
				var id_imovel=$('#id_imovel').val();

				$.ajax({
					url:"assets/phpbd/getFavResBtn.php",
					type:"POST",
					data: "id_usuario="+id_usuario+"&id_imovel="+id_imovel+"&tipo=getFav&tipo_resquest=adicionar",
					dataType: "json",
					beforeSend: function(){
						$('#msg').show();
						$('#msg').text('Adicionando...');
						$('#msg').css('color', 'blue');
						$('#btnFavAdicionar').attr('disabled', 'disabled');
					},
					success: function (result){
						if(result.codigo == 0){
							$('#msg').show();
							$('#msg').text(result.msg);
							$('#msg').css('color', 'blue');
							$('#btnFavAdicionar').attr('disabled', 'disabled');
							attBotao();
						}else if(result.codigo != 0){
							$('#msg').show();
							$('#msg').text(result.msg);
							$('#msg').css('color', 'red');
						}else{
							alert('Erro Fatal');
						}
					}
				})
				
			}
			/*função para remover dos favoritos*/
			
			function remfav(){
				
				var id_usuario=$('#id_usuario').val();
				var id_imovel=$('#id_imovel').val();

				$.ajax({
					url:"assets/phpbd/getFavResBtn.php",
					type:"POST",
					data: "id_usuario="+id_usuario+"&id_imovel="+id_imovel+"&tipo=getFav&tipo_resquest=remover",
					dataType: "json",
					beforeSend: function(){
						$('#msg').show();
						$('#msg').text('Removendo...');
						$('#msg').css('color', 'blue');
						$('#btnFavRemover').attr('disabled', 'disabled');
					},
					success: function (result){
						if(result.codigo == 0){
							$('#msg').show();
							$('#msg').text(result.msg);
							$('#msg').css('color', 'blue');
							$('#btnFavRemover').attr('disabled', 'disabled');
							attBotao();
						}else if(result.codigo != 0){
							$('#msg').show();
							$('#msg').text(result.msg);
							$('#msg').css('color', 'red');
						}else{
							alert('Erro Fatal');
						}
					}
				})
				
			}
			
			/*função para adicionar aos Reservados*/
			
			function addres(){
				
				var id_usuario=$('#id_usuario').val();
				var id_imovel=$('#id_imovel').val();

				$.ajax({
					url:"assets/phpbd/getFavResBtn.php",
					type:"POST",
					data: "id_usuario="+id_usuario+"&id_imovel="+id_imovel+"&tipo=getRes&tipo_resquest=adicionar",
					dataType: "json",
					beforeSend: function(){
						$('#msg').show();
						$('#msg').text('Adicionando...');
						$('#msg').css('color', 'blue');
						$('#btnResAdicionar').attr('disabled', 'disabled');
					},
					success: function (result){
						if(result.codigo == 0){
							$('#msg').show();
							$('#msg').text(result.msg);
							$('#msg').css('color', 'blue');
							$('#btnResAdicionar').attr('disabled', 'disabled');
							attBotao();
						}else if(result.codigo != 0){
							$('#msg').show();
							$('#msg').text(result.msg);
							$('#msg').css('color', 'red');
						}else{
							alert('Erro Fatal');
						}
					}
				})
				
			}
			
			/*função para remover dos Reservados*/
			
			function remres(){
				
				var id_usuario=$('#id_usuario').val();
				var id_imovel=$('#id_imovel').val();

				$.ajax({
					url:"assets/phpbd/getFavResBtn.php",
					type:"POST",
					data: "id_usuario="+id_usuario+"&id_imovel="+id_imovel+"&tipo=getRes&tipo_resquest=remover",
					dataType: "json",
					beforeSend: function(){
						$('#msg').show();
						$('#msg').text('Removendo...');
						$('#msg').css('color', 'blue');
						$('#btnResRemover').attr('disabled', 'disabled');
					},
					success: function (result){
						if(result.codigo == 0){
							$('#msg').show();
							$('#msg').text(result.msg);
							$('#msg').css('color', 'blue');
							$('#btnResRemover').attr('disabled', 'disabled');
							attBotao();
						}else if(result.codigo != 0){
							$('#msg').show();
							$('#msg').text(result.msg);
							$('#msg').css('color', 'red');
						}else{
							alert('Erro Fatal');
						}
					}
				})
			}
			
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>
	</body>
</html>
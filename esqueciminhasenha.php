<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <meta name="viewport" content="width=device-width, user-scalable=no">
		<meta charset="utf-8">
		<link rel="StyleSheet" href="assets/css/bootstrap.css">
		<link rel="StyleSheet" href="assets/css/style.css">
		<link rel="StyleSheet" href="assets/css/form-cdst-elements.css">
		<script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/cdstimovel.js"></script>
		<script src="assets/js/cdst.js"></script>
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			 i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			 ga('create', 'UA-82252894-1', 'auto');
			 ga('send', 'pageview');
		</script>
	</head>
		<body>
			<?php
				include_once'assets/menu.php';
				include_once 'assets/phpbd/connection.php';
				
				if (empty($_GET['i']) || empty($_GET['c'])){
					echo "<script>alert('Falha em tentar redefinir a senha: Falta de dados');</script>";
					echo "<script>window.location.assign('index');</script>";
				}else{
					
				
					$id = $_GET['i'];
					$chave = $_GET['c'];

					if($_GET['a'] == "apx" ){
						
						$sqldelet = "DELETE FROM Recuperacao_tb WHERE id_usuario = '$id' AND token = '$chave'";
							
						$deletar = $conet -> prepare($sqldelet);
						$deletar -> execute();
						
						echo "<script>alert('Obrigado por sua compreenção');</script>";
						echo "<script>window.location.assign('index');</script>";
						
					}
					
					$sqlveri = "SELECT * FROM Recuperacao_tb WHERE id_usuario = '$id' AND token = '$chave'";
					
					$verifica = $conet -> prepare($sqlveri);
					$verifica -> execute();
					
					if($verifica -> rowCount() == 0){
						echo "<script>alert('Falha em tentar redefinir a senha: Solicitação não existente');</script>";
						echo "<script>window.location.assign('index');</script>";
						
					}else{
						if(!empty($_POST)){
							
							$senha = crypt($_POST['senha']);
							
							$sqlup = "UPDATE Usuario_tb SET senha = '$senha' WHERE id_usuario = '$id' ";
							
							$troca = $conet -> prepare($sqlup);
							$troca -> execute();
							
							$sqldelet = "DELETE FROM Recuperacao_tb WHERE id_usuario = '$id' AND token = '$chave'";
							
							$deletar = $conet -> prepare($sqldelet);
							$deletar -> execute();
							
							echo "<script>alert('Senha Redefinida com sucesso ');</script>";
							echo "<script>window.location.assign('index');</script>";
							
						}else{
			?>
							<br><br><br>
							<div class="container">
								<div class="row">
									<div class="col-md-3">
									</div>
									<div class="col-md-6">
										<form method="POST" name="validasenha">
											<!--senha-->
											<div class="form-group">
												<label class="sr-only" for="form-first-name"><strong>Senha</strong></label>
												<input type="password" name="senha" id="senha" placeholder="*Senha..." onChange="limpamsgsenha();" class="form-first-name form-control wid" id="form-first-name" pattern="[a-zA-Z0-9 ]+.{6,10}" title="Senha com no mÃ¡ximo 10 caracteres e no mÃ­nimo 7 caracteres alfanumÃ©ricos" maxlength="10" onclick="return Senha();" required autofocus>
											<div id="msgsenha"></div>
											</div>
											<!--Confirma senha-->
											<div class="form-group">
												<label class="sr-only" for="form-first-name"><strong>Confirmar Senha</strong></label>
												<input type="password" name="senha2" id="senha2" placeholder="*Confirmar Senha..." onChange="limpamsgsenha2();" class="form-first-name form-control wid" id="form-first-name" pattern="[a-zA-Z0-9 ]+.{6,10}" title="Senha com no mÃ¡ximo 10 caracteres e no mÃ­nimo 7 caracteres alfanumÃ©ricos" maxlength="10" onclick="return Senha();" required>
											<div id="msgsenha2"></div>
											</div>
											<br><button type="submit" class="btn" onclick="validasenhas();" id="button" style="width:100%;">Recuperar minha senha</button>
										</form>
									</div>
									<div class="col-md-3">
									</div>
								</div>
							</div>
							<br><br><br>
			<?php 
						}
					}
				}
			?>
		<!-- Footer -->
		<?php
			include'assets/footer.php';
		?>
		<!-- Footer -->
		</body>
</html>	
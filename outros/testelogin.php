<?php
	session_start();
	
	if(!empty($_POST)){
	
		if($_SESSION["nivel"] == 1){ /*Logar como Admin*/
			echo "<script>window.location.assign('admin/admin');</script>";
		}else if($_SESSION["nivel"] == 2){ /*Logar como corretor*/
			echo "<script>window.location.assign('corretor/corretor');</script>";
		}else if($_SESSION["nivel"] == 3){ /*Logar como usuario*/
			echo "<script>window.location.assign('cliente/cliente');</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>teste login</title>
	</head>
	<body>
		<font color="299acf"><p>Olá Seja Bem-vindo</p></font>
		<form id="formlogin" name="form5" method="POST">
			<div id="existente5">
				<font color ='black' id="errolog">Email Ou Senha Incorreto!</font>
			</div>
			<input type="text" class="textLogin" id="email" name="email" maxlength="50" placeholder="E-mail" autofocus><br><br><br>
			<input type="password" class="textLogin" id="senha" name="senha" maxlength="10" placeholder="Senha"><br>
			<button type="submit" class="Enviar"  name="enviar" id="btn-login">enviar</button><br><br><br>
		</form>
		<a href="PassForget.php" id="Ancora">Esqueci minha senha</a>

		<script>window.jQuery || document.write('<script src="../assets/js/jquery.min.js"><\/script>')</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		
		<script>
			$(document).ready(function(){
				$('#errolog').hide(); 							//Esconde o elemento com id errolog
				$('#formlogin').submit(function(){ 	  			//Ao submeter formulário
					var login=$('#email').val(); 				//Pega valor do campo email
					var senha=$('#senha').val();	  			//Pega valor do campo senha
					$.ajax({						  			//Função AJAX
						url:"verificalogin.php",				//Arquivo php
						type:"POST",						    //Método de envio
						data: "login="+login+"&senha="+senha,	//Dados
						success: function (result){				//Sucesso no AJAX
							if(result==1){
								document.forms["formlogin"].submit();
								$('#errolog').hide(); 
							}
							else{	
								$('#errolog').show();	
							}
						}
					})
					return false;	//Evita que a página seja atualizada
				})
			})
		</script>
	</body>
</html>


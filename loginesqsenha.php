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
		<script >
		function email(submit){
		alert("php sucks!");

//valida formulario
/*
	d = document.cadastro;
	//validar email(verificao de endereco eletrônico) e mostra a mensagem em vermelho
	parte1 = d.email.value.indexOf("@");
	parte3 = d.email.value.length;
	if (!(parte1 >= 3 && parte3 >= 9)) {
		var div = document.getElementById('msgemail');
		div.style.color = 'red';
		d.email.style.border="1px red solid";
		d.email.style.color="#000";
		document.getElementById("msgemail").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>O campo EMAIL deve ser conter um endereco eletronico vÃ¡lido!";
		d.email.focus();
		return false;
	} 
	//validar email e mostra a mensagem em vermelho
	if (d.email.value == ""){
		var div = document.getElementById('msgemail');
		div.style.color = 'red';
		d.email.style.border="1px red solid";
		d.email.style.color="#000";
		document.getElementById("msgemail").innerHTML = "<span class='glyphicon glyphicon-exclamation-sign'> </span>O campo EMAIL  deve ser preenchido!";
		d.email.focus();
		return false;
	}     
		document.cadastro.submit();   */
	}
	
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
			if( !empty($_POST)){
				
				$vazio = "";
				$email = $_POST['email'];
				
				$sqlre = "SELECT * FROM Usuario_tb WHERE email = '$email'";
				
				$recupera = $conet -> prepare($sqlre);
				$recupera -> execute();
				
				if ($recupera -> rowCount() > 0){
					
					foreach($recupera as $rc){}
					
					/*Criar a chave unica para o email */
					$chave = crypt($email);
					
					/*Inserir a chave unica com o id do usuario no BD*/
					$sqli = "INSERT INTO Recuperacao_tb(id_usuario,token) VALUES (?,?) ";
				
					$inserir = $conet -> prepare($sqli);
					$inserir -> execute(array($rc['id_usuario'],$chave));
					
					/*Cria o link com o id do usuario e a chave unica*/
					$link = "https://www.ctbarmc-imobiliariabeta.com.br/esqueciminhasenha?i=".$rc['id_usuario']."&c=$chave&a=1";
					
					/*variaveis para o email*/
					
					date_default_timezone_set('America/Sao_Paulo');
					$data_envio = date('d/m/Y');
					$hora_envio = date('H:i:s');
					
					$para = $email;
					$assunto = "Alterar senha";
					$mensagem = "<html>
						<head>
							<title>Redefinicao de Senha</title>
						</head>
						<body>
							<img src='https://www.ctbarmc-imobiliariabeta.com.br/assets/img/logoemail.png' alt='pr-imoveisbeta' width='300px'>
							<p>Ola ".$email.", visite este link para redefinir sua senha  <br> <a href=".$link.">".$link."</a>.</p>
							<p>Caso nao tenha solicitado esse email, <a href='https://www.ctbarmc-imobiliariabeta.com.br/esqueciminhasenha?i=".$rc['Id_usuario']."&c=$chave&a=apx'>Click Aqui</a>.</p>
							<p>Esse e-mail foi enviado as ".$hora_envio."<br> do dia ".$data_envio."</p>
						</body>
					</html>";
					$mensagem = utf8_encode($mensagem);
					
					/*Cabeçalho para suportar enviar html no email*/
					$cabecalho = 'MIME-Version: 1.0' . "\r\n";
					$cabecalho .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
					/*Cabeçalho customizado*/
					$cabecalho .= 'From: ctbarmc-imobiliariabeta <redefinirsenha@ctbarmc-imobiliariabeta.com.br>' . "\r\n";
					
					/*envia e verifica se o email foi enviado */
					if( mail($para, $assunto, $mensagem, $cabecalho)){						
						echo "<script>alert('Foi enviado um e-mail para o seu endereço, onde poderá encontrar um link único para alterar a sua Senha ');</script>";
						echo "<script>window.location.assign('index');</script>";
						
					} else {
						echo "<script>alert('Erro ao enviar o email, Por favor tente mais tarde ');</script>";
						echo "<script>window.location.assign('index');</script>";;
			 
					}
	
				}else{
					echo "Email não encontrado";
				}
				
			}else{
		?>
			<br><br><br>
			<div class="container">
				<div class="row">
					<div class="col-md-3">
					</div>
					<div class="col-md-6">
						<form method = "POST" name="esqSenha" action="#">
							<div class="form-group">
							<label class="sr-only" for="form-email"><strong>Login</strong></label>
							<input type="email" name="email" id="email" placeholder="Email..." Onchange="limpamsgesqSenha();"  Onblur="validacaoEmailesqSenha(esqSenha.email)" class="form-email form-control wid" id="form-email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"   required>
							<div id="msgemailesq">
							</div>
						</div>
							</div>
						</div>
							<br>
							<button type="submit" class="btn" id="button" style="width:100%;">Enviar solicitação</button>
							<div id="senha1"></div>
						</form>
					</div>
					<div class="col-md-3">
					</div>
				</div>
			</div>
			<br><br><br>
		<?php } ?>
		<!-- Footer -->
		<?php
				include'assets/footer.php';
		?>
		<!-- Footer -->
	</body>
</html>	
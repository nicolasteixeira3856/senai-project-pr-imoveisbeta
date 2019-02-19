<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<meta charset="utf-8">
		<title>Contato</title>
		<link rel="StyleSheet" href="assets/css/bootstrap.css">
		<link rel="StyleSheet" href="assets/css/style.css">
		<link rel="StyleSheet" href="assets/css/form-cdst-elements.css">
	</head>
	<body>
		<?php 
			include_once'assets/menu.php';
	
			if( !empty($_POST)){
				date_default_timezone_set('America/Sao_Paulo');
				$data_envio = date('d/m/Y');
				$hora_envio = date('H:i:s');
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				$telefone = $_POST['telefone'];
				$mensagem = $_POST['descricaoo'];
				$arquivo = "
				<html>
					<table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
						<tr>
						  <td>
				<tr>
							 <td width='500'>Nome:$nome</td>
							</tr>
							<tr>
							  <td width='320'>E-mail:<b>$email</b></td>
				   </tr>
					<tr>
							  <td width='320'>Telefone:<b>$telefone</b></td>
							</tr>
							<tr>
							  <td width='320'>Mensagem:$mensagem</td>
							</tr>
						</td>
					  </tr> 
					  <tr>
						<td>Este e-mail foi enviado em <b>$data_envio</b> as <b>$hora_envio</b></td>
					  </tr>
					</table>
				</html>
				";

				// Email para quem será enviado o formulário
				$emailenviar = "geekdevsenai@outlook.com";
				$destino = $emailenviar;
				$assunto = "Contato pelo Site";
			 
				// É necessário indicar que o formato do e-mail é html
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: $nome <$email>';
				//$headers .= "Bcc: $EmailPadrao\r\n";
				 
				$enviaremail = mail($destino , $assunto ,$arquivo ,$headers);
				if($enviaremail){
					echo"<script>alert('E-mail enviado com sucesso')</script>";
					echo "<script>window.location.assign('index');</script>";
				}else{
					echo"<script>alert('Falha ao enviar o e-mail, por favor tente mais tarde')</script>";
					echo "<script>window.location.assign('index');</script>";
				}
			}else{
			
		?>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="form-top">
						<div class="form-top-left">
							<h1>Entre em contato conosco.</h1>
							<p>Preencha todos os campos abaixo para entrar em contato conosco.</p>
						</div>
						<div class="form-top-right">
							<i class="fa fa-pencil"></i>
						</div>
					</div>
					<div class="form-bottom">
						<form role="form" name="cadastrocont" action="" method="POST" class="registration-form">
							<div class="form-group">
								<input type="text" name="nome" id="nome" Onchange="limpamsgnome();" Onblur="validanome();" placeholder="*Nome completo..." class="form-first-name form-control wid" id="form-first-name" onkeypress="return Onlychars(event)" pattern="[a-z\A-Z\s]+$" title="Somente Letras." required autofocus>
								<div id="msgnome">
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="email" id="email" placeholder="*Email..." Onblur="validacaoEmail(cadastrocont.email)" onChange="limpamsgemail();" class="form-email form-control wid" id="form-email" required>
								<div id="msgemail">
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="telefone" id="telefone" Onchange="limpamsgtelefone();" Onblur="validatelefone();" onkeypress="return valTELEFONE(event,this); return false;"  maxlength="14" placeholder="Telefone..." class="form-first-name form-control wid" id="form-first-name" title="(##)####-####.">
								<div id="msgtelefone">
								</div>
							</div>
							<div class="form-group">
								<textarea type="text" name="descricaoo" id="mensagem" onChange="limpamsgmensagem();" placeholder="*Mensagem..." class="form-first-name form-control" id="form-first-name" maxlength="255" style="resize:none;" required></textarea>
								<div id="msgmensagem">
								</div>
							</div>
							<button type="submit" class="btn" id="button" onclick="return validaContato(event,this); " value="CONFIRMAR" style="width:100%;">Enviar mensagem</button>
						</form>	
					</div>
				</div>
				<div class="col-md-6">
					<!-- --><br>
					<iframe class="mapagoogle" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3028.1544262955963!2d-49.26237117105548!3d-25.50161822991356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94dcfb3eeff0d4cb%3A0x4a7a2ffb5aafa57a!2sR.+Maria+da+Luz+Rocha+Bel%C3%A3o+-+Xaxim%2C+Curitiba+-+PR!5e0!3m2!1spt-BR!2sbr!4v1473701644537" width="550" height="390" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	<?php } ?>
		<!-- --><br>
		
		<!-- Footer -->
		<?php include'assets/footer.php'; ?>
		
		<!-- JavaScript -->
		<script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="assets/js/validacao.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script>
			 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			 })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			 ga('create', 'UA-82252894-1', 'auto');
			 ga('send', 'pageview');
		</script>
	</body>
</html>

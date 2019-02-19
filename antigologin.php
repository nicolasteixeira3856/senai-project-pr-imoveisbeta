<!DOCTYPE html>
<html lang="pt-br">
	<head>
        <meta name="viewport" content="width=device-width, user-scalable=no">
		<meta charset="UTF-8">
		<title>Cadastro e login</title>
		<link rel="StyleSheet" href="assets/css/bootstrap.css">
		<link rel="StyleSheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
	</head>
	<body>
		<?php
			include_once'assets/menu.php';
				
		?>
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					  	<div class="form-box">
							<div class="form-top">
								<div class="form-top-left">
									<h1>
										Cadastre-se aqui
									</h1>
								</div>
								<div class="form-top-right">
									<i class="fa fa-pencil"></i>
								</div>
							</div>
							<div class="form-bottom">
								<form role="form" name="cadastro" id="cadastro" action="assets/phpbd/cadastrouser.php" method="POST" class="registration-form">
								    <div class="form-group">
								        <h4 id="logcdst"></h4>
            						</div>
									<div class="form-group">
										<label class="sr-only" for="form-first-name"><strong>Nome</strong></label>
										<input type="text" name="nome" id="nome" placeholder="*Nome completo..." Onchange="limpamsgnome();" Onblur="validanome();"  OnKeyPress="return Onlychars(event)"  class="form-first-name form-control wid" required>
										<div id="msgnome"></div>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-email"><strong>Email</strong></label>
										<input type="email" name="email" id="email" placeholder="*Email..." Onchange="limpamsgemail();" class="form-email form-control wid" Onblur="validacaoEmail(cadastro.email)"  maxlength="60" id="form-email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  required>
										<div id="msgemail">
										</div>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-email"><strong>Telefone</strong></label>
										<input type="text" name="telefone" id="telefone" placeholder="*Telefone..." Onchange="limpamsgtelefone();" Onblur="validatelefone();" onkeypress="return valTELEFONE(event,this); return false;"  class="form-first-name form-control wid" id="form-first-name" required="required"  maxlength="15">
										<div id="msgtelefone">
										</div>
									</div>																
									<div class="form-group">
										<label class="sr-only" for="form-first-name"><strong>Senha</strong></label>
										<input type="password" name="senha" id="senha" placeholder="*Senha..." Onchange="limpamsgsenha();" Onblur="senha1();" class="form-first-name form-control wid" id="form-first-name" pattern="[a-zA-Z0-9 ]+.{6,10}" title="Senha com no máximo 10 caracteres e no mínimo 7 caracteres alfanuméricos" maxlength="10" required>
										<div id="msgsenha">
										</div>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-first-name"><strong>Confirmar Senha</strong></label>
										<input type="password" name="senha2" id="senha2" placeholder="*Confirmar Senha..." Onchange="limpamsgsenha2();" Onblur="confirmasenha();" class="form-first-name form-control wid" id="form-first-name" pattern="[a-zA-Z0-9 ]+.{6,10}" title="Senha com no máximo 10 caracteres e no mínimo 7 caracteres alfanuméricos" maxlength="10"  required>
										<div id="msgsenha2">
										</div>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-first-name">CPF</label>
										<input type="text" name="CPF" id ="cpf" placeholder="*CPF..." Onchange="limpamsgcpf();" onkeypress="return valCPF(event,this);return false;" onblur="if(consistenciaCPF(this.value)) this.select();" class="form-first-name form-control" id="form-first-name"  maxlength="14" title="###.###.###-##"required>
										<div id="msgcpf">
										</div>
									</div>
									<div class="form-group">
										<select class="form-selected form-first-name form-control wid" onBLur="campocidade();" name="cidade" id="cidade" required>
											<option value="cidade" disabled selected hidden><strong>*Selecione a Sua Cidade...</strong></option> 
											<?php
                                                /*Script para pegar a cidade*/
                                                include_once'assets/phpbd/connection.php';
                                                
                                                $sql = "SELECT * FROM Cidade_tb";
                                                
                                                $listacity = $conet -> prepare($sql);
                                                $listacity -> execute();
                                                
                                                foreach($listacity as $lsc){
                                                    echo "<option value=".$lsc['id_cidade'].">".$lsc['nome_cidade']."</option> ";
                                                }
                                            ?>
										</select>
										<div id="msgcidade">
										</div>
									</div>
									<!-- --> <br>
									<button type="submit" class="btn" id="button"  value="Efetuar cadastro"  style="width:100%;">Efetuar cadastro</button>
								</form>
							</div>
						</div>
				</div>
				<div class="col-sm-6">
					<form class="form-signin" id="logar" name="cadastrolgn" method="POST">
						<h1 class="form-signin-heading">
							Efetue o login
						</h1>
						<div class="form-group">
							<h4 id="log"></h4>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-email"><strong>Login</strong></label>
							<input type="email" name="email" id="login" placeholder="Email..."  class="form-email form-control wid" Onblur="validacaoEmaillgn(cadastrolgn.email)"  maxlength="60"    id="form-email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
							<div id="msglogin">
							</div>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-first-name"><strong>Senha</strong></label>
							<input type="password" name="senha" id="senhalogin" OnChange="limpamsgsenhalogin();" onBlur="verificasenhalogin();"placeholder="Senha..."  class="form-first-name form-control wid" id="form-first-name" title="Senha com no máximo 10 caracteres e no mínimo 7 caracteres alfanuméricos" pattern="[a-zA-Z0-9 ]+.{6,10}" maxlength="10" required>
							<div id="msgsenha1">
							</div>
						</div>
						<a href="loginesqsenha" style="text-decoration:none !important;"> Esqueci minha senha </a><br><br>
						<button class="btn btn-lg btn-primary" type="submit"   style="width:100%">Logar</button>
					</form>
				</div>
			</div>
		</div>
		<!-- --> <br>
		<!-- --> <br>
		
		<!-- Alert mostrando cadastrado com sucesso -->
		<div id="dialog" title="Cadastrado com sucesso!!">
			<p style="color:green;">
				Cadastrado com sucesso!!
			</p>
			<p>
				Clique em ok para continuar.
			</p>
		</div>
		<!-- /Alert mostrando cadastrado com sucesso -->
		
		<!-- Footer -->
		<?php
			include_once'assets/footer.php';
		?>
		<!-- Footer -->
		
		<!-- Javascript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/validacao.js"></script>
		<script src="assets/js/jquery-ui.js"></script>
        <script>
			/*script google*/
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-82252894-1', 'auto');
			ga('send', 'pageview');
			
			
			/*Script para enviar o form do login*/
			$(document).ready(function(){
				$('#log').hide();
				$('#logar').submit(function(){
					var email=$('#login').val();
					var senha=$('#senhalogin').val();
					$.ajax({
						url:"assets/phpbd/login.php",
						type:"POST",
						data: "email="+email+"&senha="+senha,
						dataType: "json",
						beforeSend: function(){
                            $('#log').show();
							$('#log').text('Validando...');
							$('#log').css('color', 'blue');
                        },
						success: function (result){
							if(result.codigo==1){
								if(result.nivel==1){
								    window.location.assign('assets/phpbd/admin/admin.php');
								}else if(result.nivel==2){
								    window.location.assign('assets/phpbd/corretor/corretor.php');
								}else if(result.nivel==3){
								     window.location.assign('assets/phpbd/cliente/cliente.php');
								}else{
								    alert('Erro Fatal');
								}
							}else if(result.codigo == 2){
								$('#log').show();
								$('#log').text(result.msg);
								$('#log').css('color', 'red');
							}else{
								alert('Erro Fatal');
							}
						}
					})
					return false;
				})
			})
			
			/*Script para enviar o form do cadastro*/
			$(document).ready(function(){
				$('#logcdst').hide();
				$('#cadastro').submit(function(){
					var nome=$('#nome').val();
					var email=$('#email').val();
					var telefone=$('#telefone').val();
					var senha=$('#senha').val();
					var cpf=$('#cpf').val();
					var cidade=$('#cidade').val();
					$('#errolog').hide();
					$('#log').show();
					$.ajax({
						url:"assets/phpbd/cadastrouser.php",
						type:"POST",
						data: "nome="+nome+"&email="+email+"&telefone="+telefone+"&senha="+senha+"&cpf="+cpf+"&cidade="+cidade,
						dataType: "json",
						beforeSend: function(){
                            $('#logcdst').show();
							$('#logcdst').text('Validando...');
							$('#logcdst').css('color', 'blue');
                        },
						success: function (result){
							if(result.codigo == 0){
							    $( "#dialog" ).dialog( "open" );
							}else if(result.codigo != 0){
								$('#logcdst').show();
								$('#logcdst').text(result.msg);
								$('#logcdst').css('color', 'red');
							}else{
								alert('Erro Fatal');
							}
						}
					})
					return false;
				})
			})
			
			/*modal de cadastrado com sucesso*/
			
			$( function() {
				$( "#dialog" ).dialog({/*Cria a funçao de dialogo do jquery*/
					autoOpen: false,/*Deixa o autoOpen desativado*/
					dialogClass: "no-close",
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {/*Cria o batao de ok redirecionando para outra pagina*/
						OK: function() {
							location.href="assets/phpbd/cliente/cliente.php";
						}
					}
				});
			});

		</script>
	</body>
</html>
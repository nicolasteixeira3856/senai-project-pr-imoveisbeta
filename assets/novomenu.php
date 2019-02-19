<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<link rel="icon" href="img/icone.ico">
	</head>
	<body>
		<!-- logo -->
		<div class="colorbck" style="border-bottom:0px;">
			<br>
			<a href="index.php"> <img class="headlogo" src="assets/img/logo.png"> </a>
		</div>
		<!-- /logo -->
		<!-- navbar -->
		<nav class="navbar navbar-default" style="border-radius:0px; border-top:0px;">
			<div class="container">
			  <div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
			  </div>
			  <div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
				  <li><a href="index.php"><span class="glyphicon glyphicon-home"> </span> Home</a></li>
					<li><a href="sobre">Sobre</a></li>
					<li><a href="contato">Contato</a></li>
					<li><a href="imoveis">Imóveis</a></li>
				</ul>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
				  <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b><span class="caret"></span></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">

					<form class="form-signin" id="logar" name="cadastrolgn" method="POST">
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
							<div class="bottom text-center">
							 <a href="#"><b>Cadastrar-se</b></a>
							</div>
					 </div>
				</li>
			</ul>
        </li>
      </ul>
	  </div>
	  </div>
                <?php
				@session_start();  
				
				/*Verifica se ouve o login para modificar o menu*/
                if ((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)) {
                    
                    echo "  <ul class='nav navbar-nav navbar-right'>
                                 <a><li><a class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-log-in'></span> Cadastrar/Logar</a></li>
                            </ul>
                    ";
                    
                }else{
                    if($_SESSION["nivel"] == 1){
						echo " <ul class='nav navbar-nav navbar-right'>
								<li class='dropdown'>									
									<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-cog'></span> Bem-Vindo ". $_SESSION['nome']."<span class='caret'></span></a>
									<ul class='dropdown-menu'>
										<center><img src='assets/img/fotousers/".$_SESSION['nomefoto']."' class='img-circle' width='125' height='125'></center>
										<li role='separator' class='divider'></li>
										<li><a href='assets/phpbd/admin/admin'>Painel</a></li>
										<li><a href='assets/phpbd/sair.php'>Sair</a></li>
									</ul>
								</li>
							</ul>";
                    }else if($_SESSION["nivel"] == 2){
                        echo " <ul class='nav navbar-nav navbar-right'>
								<li class='dropdown'>
									<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-cog'></span> Bem-Vindo ". $_SESSION['nome']."<span class='caret'></span></a>
									<ul class='dropdown-menu'>
										<center><img src='assets/img/fotousers/".$_SESSION['nomefoto']."' class='img-circle' width='125' height='125'></center>
										<li role='separator' class='divider'></li>
										<li><a href='assets/phpbd/corretor/corretor'>Painel</a></li>
										<li><a href='assets/phpbd/sair.php'>Sair</a></li>
									</ul>
								</li>
							</ul>";                       
                    }else if($_SESSION["nivel"] == 3){
                        echo " <ul class='nav navbar-nav navbar-right'>
								<li class='dropdown'>
									<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-cog'></span> Bem-Vindo ". $_SESSION['nome']."<span class='caret'></span></a>
									<ul class='dropdown-menu'>
										<center><img src='assets/img/fotousers/".$_SESSION['nomefoto']."' width='125' class='img-circle' height='125'></center>
										<li role='separator' class='divider'></li>
										<li><a href='assets/phpbd/cliente/cliente'>Painel</a></li>
										<li><a href='assets/phpbd/sair.php'>Sair</a></li>
									</ul>
								</li>
							</ul>";
                    }else{
                        echo "  <ul class='nav navbar-nav navbar-right'>
				                <li><a href='#'><span class='glyphicon glyphicon-log-in'></span>Sem Nivel Contate um admin</a></li>
				            </ul>
                        ";
                    }
                } 
                ?>
			  </div><!--/.nav-collapse -->
			</div><!--/.container -->
		</nav>
	</body>
</html>
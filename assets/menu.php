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
                <?php
				@session_start();  
				
				/*Verifica se ouve o login para modificar o menu*/
                if ((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)) {
                    
                    echo "  <ul class='nav navbar-nav navbar-right'>
                                 <li><a href='cadastrologin'><span class='glyphicon glyphicon-log-in'></span> Cadastrar/Logar</a></li>
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
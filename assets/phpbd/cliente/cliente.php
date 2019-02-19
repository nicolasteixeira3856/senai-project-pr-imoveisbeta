<?php
    session_start();
    if($_SESSION["nivel"] != 3){
        echo "<script>alert('Você não tem permissão o suficente para acessar essa página.');</script>";
        echo "<script>window.location.assign('../../../cadastrologin');</script>";
        session_destroy();
    }else{
        if ($_SESSION["Login"] != "YES") {
        echo "<script>alert('Você não esta logado, por favor efetue o login.');</script>";
        echo "<script>window.location.assign('../../../cadastrologin');</script>";
        session_destroy();
        }
    }
	include_once "../connection.php";
	$id = $_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<meta charset="utf-8">
		<title>Painel do Cliente</title>
		<link rel="StyleSheet" href="../../css/style.css">
		<link rel="StyleSheet" href="../../css/bootstrap.css">
		<link rel="stylesheet" href="../../css/jquery-ui.css">
	</head>
	<body>
		<!-- Conteúdo da página -->
		<ul class="sidenav">
			<a href="../../../index.php"><img class="logositepainel" src="../../img/logo.png"></a>
			<li><a>Painel do Cliente</a></li>
            <li class="active"><a data-toggle="tab" href="#Favoritos">Favoritos</a></li>
            <li><a data-toggle="tab" href="#Reservados">Imóveis reservados</a></li>
			<li><a data-toggle="tab" href="#Contato-Corretor">Entrar em contato com corretor</a></li>                    
			<li><a data-toggle="tab" href="#Perfil">Perfil</a></li>
			<li><a href="../../../index.php" class="tablinks">Voltar para o site</a></li>
			<li><a href="../sair.php" class="tablinks">Sair</a></li>
		</ul>
		<div class="tab-content content">
			<div class="tab-pane fade in active" id="Favoritos">
				<div align="center">
					<h1>Favoritos</h1><br>
				</div><br>
				<?php

					/*Limita o número de registros a serem mostrados por página*/
					$limite_img = 3;
					
					/*Se pg não existe atribui 1 a variável pg*/
					$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1 ;
					
					/*Atribui a variável inicio o inicio de onde os registros vão ser mostrados por página, exemplo 0 à 12, 12 à 24 e assim por diante*/
					$inicio = ($pg * $limite_img) - $limite_img;
					
					/*Seleciona as tabelas*/
					$sql = "SELECT * FROM Favoritos_tb
						JOIN Imoveis_tb ON Imoveis_tb.id_imovel = Favoritos_tb.id_imovel
						JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
						JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
						JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
						WHERE Favoritos_tb.id_usuario = '$id'";
					
					
						/*				*/
					
					$limite = $conet -> prepare("$sql LIMIT $inicio,$limite_img");
					$limite -> execute();
					
					/*Exibindo os imoveis*/
					while ($lsimv = $limite -> fetch(PDO::FETCH_ASSOC)) {	
					$valor = number_format($lsimv['valor'],2,",",".");					
							echo"<div class='row'>
									<div class='col-md-5'>
										<img src='../../img/fotosimoveis/".$lsimv['foto_principal']."' alt='Destaque1' width='300px' height='250px'><br><br>
									</div>
									<div class='col-md-4'>
																	
										".$lsimv['titulo']."<br>
										Cidade: ".$lsimv['nome_cidade']."<br>
										Negociação: ".$lsimv['tipo_nego']."<br>
										Bairro: ".$lsimv['nome_bairro']."<br>
										Valor: R$ ".$valor."<br><br>
									</div>
									<div class='col-md-5'>
										<a href='../../../imovel?id=".$lsimv['id_imovel']."' class='btn btn-default btn-lg colorbck bnimv'><span class='glyphicon glyphicon-heart' aria-hidden='true'></span> Visualizar imovel</a>
									</div>
								</div>
								<br><br>
							";
					}						
					$sql_total = "SELECT * FROM Favoritos_tb WHERE Favoritos_tb.id_usuario = '$id'";
					
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
			</div>
			<div class="tab-pane fade" id="Contato-Corretor">
				<div align="center">
					<h1>Contato com o corretor</h1><br>
				</div><br>
				<?php
					/*Limita o número de registros a serem mostrados por página*/
					$limite_img = 5;
					
					/*Se pg não existe atribui 1 a variável pg*/
					$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1 ;
					
					/*Atribui a variável inicio o inicio de onde os registros vão ser mostrados por página, exemplo 0 à 12, 12 à 24 e assim por diante*/
					$inicio = ($pg * $limite_img) - $limite_img;
					
					/*Seleciona as tabelas*/
					$sql = "SELECT * FROM Usuario_tb 
						JOIN Cidade_tb ON Usuario_tb.id_cidade = Cidade_tb.id_cidade
						WHERE nivel != 3";
					
					$limite = $conet -> prepare("$sql LIMIT $inicio,$limite_img");
					$limite -> execute();
					
					/*Exibindo os imoveis*/
					while ($lscor = $limite -> fetch(PDO::FETCH_ASSOC)) {					
							echo"<div class='row'>
									<div class='col-md-5'>
										<img src='../../img/fotousers/".$lscor['foto']."' alt='fotocorretor' width='300px' height='250px'><br><br>
									</div>
									<div class='col-md-4'>
										Nome do corretor: ".$lscor['nome']."<br>
										Email  do corretor: ".$lscor['email']."<br>
										Telefone do corretor: ".$lscor['telefone']."<br><br>
									</div>
									<div class='col-md-5'>
								";
					?>
										<a><button type='button' class='btn' onclick='opencontatocorretor("<?php echo $lscor['id_usuario']?>","<?php echo $id?>","<?php echo $lscor['nome']?>")' id='button' style='width:65%; margin-bottom:15px;'>Entrar em contato</button></a>
					<?php
								echo"
									</div>
								</div>
								<br><br>
							";
					}	
					$sql_total = "SELECT * FROM Usuario_tb
						WHERE nivel = 2";
					
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
								<a href='?pg=".$anterior."' aria-label='Previous'>
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
								echo "<li><a href='?pg=$i'>".$i."</a></li>";
							}
						}
					}
					if($pg < $qtdPag){	
						echo"<li>
							<a href='?pg=".$proximo."' aria-label='Next'>
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
			</div>
			<div class="tab-pane fade" id="Reservados">
				<div align="center">
					<h1>Imóveis Reservados</h1><br>
				</div><br>
				<?php
					
					
					/*Limita o número de registros a serem mostrados por página*/
					$limite_img = 3;
					
					/*Se pg não existe atribui 1 a variável pg*/
					$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1 ;
					
					/*Atribui a variável inicio o inicio de onde os registros vão ser mostrados por página, exemplo 0 à 12, 12 à 24 e assim por diante*/
					$inicio = ($pg * $limite_img) - $limite_img;
					
					/*Seleciona as tabelas*/
					$sql = "SELECT * FROM Reserva_tb
					JOIN Imoveis_tb ON Imoveis_tb.id_imovel = Reserva_tb.id_imovel
					JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
					JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
					JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
					WHERE Reserva_tb.id_usuario = '$id'";
					
					$limite = $conet -> prepare("$sql LIMIT $inicio,$limite_img");
					$limite -> execute();
					
					/*Exibindo os imoveis*/
					while ($lsimv = $limite -> fetch(PDO::FETCH_ASSOC)) {		

					$valor = number_format($lsimv['valor'],2,",",".");					
							echo"<div class='row'>
									<div class='col-md-5'>
										<img src='../../img/fotosimoveis/".$lsimv['foto_principal']."' alt='Destaque1' width='300px' height='250px'><br><br>
									</div>
									<div class='col-md-4'>
										".$lsimv['titulo']."<br>
										Cidade: ".$lsimv['nome_cidade']."<br>
										Negociação: ".$lsimv['tipo_nego']."<br>
										Bairro: ".$lsimv['nome_bairro']."<br>
										Valor: R$ ".$valor."<br><br>
									</div>
									<div class='col-md-5'>
										<a href='../../../imovel?id=".$lsimv['id_imovel']."' class='btn btn-default btn-lg colorbck bnimv'><span class='glyphicon glyphicon-heart' aria-hidden='true'></span> Visualizar imovel</a>
									</div>
								</div>
								<br><br>
							";
					}						
					$sql_total = "SELECT * FROM Reserva_tb WHERE Reserva_tb.id_usuario = '$id'";
					
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
								<a href='?pg=".$anterior."' aria-label='Previous'>
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
								echo "<li><a href='?pg=$i'>".$i."</a></li>";
							}
						}
					}
					if($pg < $qtdPag){	
						echo"<li>
							<a href='?pg=".$proximo."' aria-label='Next'>
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
			<div class="tab-pane fade" id="Perfil">
			        <?php 
			            $sqlperfil = "SELECT * FROM Usuario_tb WHERE id_usuario = $id";
			            
			            $listaperfil = $conet -> prepare($sqlperfil);
			            $listaperfil -> execute();
			            
			            foreach($listaperfil as $lsperfil){}
			            
			            echo "
							<div align='center'>
								<h1>Perfil</h1><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>Nome:</label> <br>".$lsperfil['nome']."</span> 
									<br><br><a onclick='openalterarnome(".$id.")'>ALTERAR</a><br>
								</div><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>Email:</label> <br>".$lsperfil['email']."</span> 
									<br><br><a onclick='openalteraremail(".$id.")'>ALTERAR</a><br>
								</div><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>CPF:</label> <br>".$lsperfil['CPF']."</span>
								</div><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<label>Senha</label>
									<br><br><a onclick='openalterarsenha(".$id.")'>ALTERAR</a><br>
								</div><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>Foto:</label> <br><img src='../../img/fotousers/".$lsperfil['foto']."' alt='Destaque1' class='img-circle' width='150px' height='100px'> </span>
									<br><br><a onclick='openalterarfoto(".$id.")'>ALTERAR</a><br>
								</div><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>Telefone:</label> <br>".$lsperfil['telefone']."</span> 
									<br><br><a onclick='openalterartelefone(".$id.")'>ALTERAR</a><br>
								</div><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>Celular:</label> <br>".$lsperfil['celular']."</span>
									<br><br><a onclick='openalterarcelular(".$id.")'>ALTERAR</a><br>
								</div><br>
								<div ><button type='button' class='btn btn-primary' onclick='confirmacaodeletarconta(".$id.")'>Excluir conta!!</button></span></div>
							</div>
							";
			            
			        ?>
					
					
			</div>
		</div>
		
		<!-- Modal alterar nome -->
		<div id="dialogalterarnome" title="Alterar Nome">
			<h2>Formulario de alteração do nome <span id="nomecorretor"></span></span></h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterarnome" id="alterarnome" method="POST" class="registration-form" action="CRUD/editar_perfil">
				<div class="form-group">
					<h4 id="lognome"></h4>
				</div>
				<div class="form-group">
					<input type="text" name="nome" id="nomealterar" placeholder="*Nome completo..." class="form-first-name form-control wid" onkeypress="return Onlychars(event)" pattern="[a-z\A-Z\s]+$" title="Somente Letras." required autofocus>
    			</div>
				<br>
				<input type="hidden" id="id_clientealterarnome" name="id_cliente">
				<input type="hidden" id="tipoenome" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		<!-- Modal alterar email -->
		<div id="dialogalteraremail" title="Alterar Email">
			<h2>Formulario de alteração do email <span id="nomecorretor"></span></span></h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alteraremail" id="alteraremail" method="POST" class="registration-form" action="CRUD/editar_perfil">
				<div class="form-group">
					<h4 id="logemail"></h4>
				</div>
				<div class="form-group">
					<input type="email" name="email" id="emailalterar" placeholder="*Email..." class="form-first-name form-control wid" required autofocus>
    			</div>
				<br>
				<input type="hidden" id="id_clientealteraremail" name="id_cliente">
				<input type="hidden" id="tipoeemail" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
 
		<!-- Modal alterar foto -->
		<div id="dialogalterarfoto" title="Alterar Foto">
			<h2>Formulario de alteração do foto <span id="nomecorretor"></span></span></h2>
			<h5>Escolha uma nova foto</h5>
		 
			<form role="form" name="alterarfoto" id="alterarfoto" method="POST" class="registration-form" action="CRUD/editar_perfil" enctype="multipart/form-data">
				<div class="form-group">
					<h4 id="lognome"></h4>
				</div>
				<div class="form-group">
					<input type="file" class="form-first-name form-control wid" id="foto" name="foto" required>
    			</div>
				<br>
				<input type="hidden" id="id_clientealterarfoto" name="id_cliente">
				<input type="hidden" id="tipoefoto" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		<!-- Modal alterar telefone -->
		<div id="dialogalterartelefone" title="Alterar Telefone">
			<h2>Formulario de alteração do telefone <span id="nomecorretor"></span></span></h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterartelefone" id="alterartelefone" method="POST" class="registration-form" action="CRUD/editar_perfil">
				<div class="form-group">
					<h4 id="logtelefone"></h4>
				</div>
				<div class="form-group">
					<input type="text" name="telefone" id="telefonealterar" placeholder="*Telefone..." class="form-first-name form-control wid" required autofocus>
    			</div>
				<br>
				<input type="hidden" id="id_clientealterartelefone" name="id_cliente">
				<input type="hidden" id="tipoetelefone" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		<!-- Modal alterar celular -->
		<div id="dialogalterarcelular" title="Alterar celular">
			<h2>Formulario de alteração do celular <span id="nomecorretor"></span></span></h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterarcelular" id="alterarcelular" method="POST" class="registration-form" action="CRUD/editar_perfil">
				<div class="form-group">
					<h4 id="logceluar"></h4>
				</div>
				<div class="form-group">
					<input type="text" name="celular" id="celularalterar" placeholder="*Celular..." class="form-first-name form-control wid" required autofocus>
    			</div>
				<br>
				<input type="hidden" id="id_clientealterarcelular" name="id_cliente">
				<input type="hidden" id="tipoecelular" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		
		<!-- Modal alterar senha -->
		<div id="dialogalterarsenha" title="Alterar Senha">
			<h2>Formulario de alteração da senha <span id="nomecorretor"></span></span></h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterarsenha" id="alterarsenha" method="POST" class="registration-form" action="CRUD/editar_perfil">
				<div class="form-group">
					<h4 id="logsenha"></h4>
				</div>
				<div class="form-group">
    			<input type="password" name="senha" id="senhaalterar" placeholder="*Senha..." class="form-first-name form-control wid" required autofocus>
    			</div>
				<br>
				<input type="hidden" id="id_clientealterarsenha" name="id_cliente">
				<input type="hidden" id="tipoesenha" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		
		<!-- Modal contato corretor -->
		<div id="dialogcontatocorretor" title="Contato corretor">
			<h2>Contactando o corretor <span id="nomecorretor"></span></span></h2>
			<h5>Preencher todos os campos para entrar em contato</h5>
		 
			<form role="form" name="contatocorretor" id="contatocorretor" method="POST" class="registration-form">
				<div class="form-group">
					<h4 id="logcontatocorretor"></h4>
				</div>
				<div class="form-group">
    			<input type="text" name="nomecontato" id="nomecontato" Onchange="limpamsgnome();" Onblur="validanome();" placeholder="*Nome completo..." class="form-first-name form-control wid" id="form-first-name" onkeypress="return Onlychars(event)" pattern="[a-z\A-Z\s]+$" title="Somente Letras." required autofocus>
    				<div id="msgnome">
    				</div>
    			</div>
    			<div class="form-group">
    				<input type="text" name="emailcontato" id="emailcontato" placeholder="*Email..." Onblur="validacaoEmail(cadastrocont.email)" onChange="limpamsgemail();" class="form-email form-control wid" id="form-email" required>
    				<div id="msgemail">
    				</div>
    			</div>
    			<div class="form-group">
    				<input type="text" name="telefonecontato" id="telefonecontato" Onchange="limpamsgtelefone();" Onblur="validatelefone();" onkeypress="return valTELEFONE(event,this); return false;"  maxlength="14" placeholder="Telefone..." class="form-first-name form-control wid" id="form-first-name" title="(##)####-####." required>
    				<div id="msgtelefone">
    				</div>
    			</div>
    			<div class="form-group">
    				<textarea type="text" name="mensagemcontato" id="mensagemcontato" onChange="limpamsgmensagem();" placeholder="*Mensagem..." class="form-first-name form-control" id="form-first-name" maxlength="255" style="resize:none;" required></textarea>
    				<div id="msgmensagem">
    				</div>
    			</div>
				<br>
				<input type="hidden" id="id_corretorcontato">
				<input type="hidden" id="id_clientecontato">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../js/jquery-ui.js"></script>
		
		<!-- JavaScript -->
		<script>
		
			/*Confirmação para deletar a conta*/
			function confirmacaodeletarconta(id) {
               var resposta = confirm("Tem certeza que deseja excluir sua conta?");
           
               if (resposta == true) {
                    window.location.href = "CRUD/deletar_conta.php?id="+id;
               }
			};

			function openCity(evt, cityName) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(cityName).style.display = "block";
				evt.currentTarget.className += " active";
			}
			
			/*Confirmacao para deletar o corretor*/
			function contactar(id_corretor ,id_cliente) {
               var resposta = confirm("Tem certeza que deseja ser atendido por esse corretor?");
           
               if (resposta == true) {
                    window.location.href = "CRUD/contactarcor?id_cliente="+id_cliente+"&id_corretor="+id_corretor;
               }
			};
            $(function(){
                $('.clicar').on('click', 'li', function(){
                    if (!$(this).hasClass('active')) {
                        $('.clicar li').removeClass('active');
                        $(this).addClass('active');
                    }
                })
            });
            
            function opencontatocorretor(id_corretor,id_cliente,nome){
                
                $("#dialogcontatocorretor").dialog("open");
                
                $('#id_corretorcontato').val(id_corretor);
                $('#id_clientecontato').val(id_cliente);
                $('#nomecorretor').text(nome);
            }
            
            /*Script para o contactar corretor*/
			$( function() {
				$( "#dialogcontatocorretor" ).dialog({
					autoOpen: false,
					height: 700,
					width: 550,
					modal: true,
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {
	
						Cancelar: function() {
						$("#dialogcontatocorretor").dialog( "close" );
						}
					}
				});
			});
			
			/*Script para enviar o form do cadastro de imovel*/
			$(document).ready(function(){
				$('#logcontatocorretor').hide();
				$('#contatocorretor').submit(function(){
				    var id_corretor	=$('#id_corretorcontato').val();
				    var id_cliente	        =$('#id_clientecontato').val();
					var nome	            =$('#nomecontato').val();
					var email		        =$('#emailcontato').val();
					var telefone	        =$('#telefonecontato').val();
					var mensagem	        =$('#mensagemcontato').val();
					
					$.ajax({
						url:"CRUD/contactarcor.php",
						type:"POST",
						data: "id_cliente="+id_cliente+"&id_corretor="+id_corretor+"&nome="+nome+"&email="+email+"&telefone="+telefone+"&mensagem="+mensagem,
						dataType: "json",
						beforeSend: function(){
                            $('#logcontatocorretor').show();
							$('#logcontatocorretor').text('Validando...');
							$('#logcontatocorretor').css('color', 'blue');
                        },
						success: function (result){0
							if(result.codigo == 0){
								alert('Enviado com sucesso');
								$("#dialogcontatocorretor").dialog( "close" );
								$('#id_corretorcontato').val("");
								$('#id_clientecontato').val("");
								$('#nomecontato').val("");
								$('#emailcontato').val("");
								$('#telefonecontato').val("");	        
								$('#mensagemcontato').val("");
								$('#logcontatocorretor').text("");
							}else if(result.codigo != 0){
								$('#logcontatocorretor').show();
								$('#logcontatocorretor').text(result.msg);
								$('#logcontatocorretor').css('color', 'red');
							}else{
								alert('Erro Fatal');
							}
						}
					})
					return false;
				})
			})
            
			/*script para os alterar*/
			
			function openalterarnome(id){
                
                $("#dialogalterarnome").dialog("open");
                $('#id_clientealterarnome').val(id);
				$('#tipoenome').val("nome");
            }
			function openalteraremail(id){
                
                $("#dialogalteraremail").dialog("open");
                $('#id_clientealteraremail').val(id);
				$('#tipoeemail').val("email");
            }
			function openalterarfoto(id){
                
                $("#dialogalterarfoto").dialog("open");
                $('#id_clientealterarfoto').val(id);
                $('#tipoefoto').val("foto");
            }
			function openalterartelefone(id){
                
                $("#dialogalterartelefone").dialog("open");
                $('#id_clientealterartelefone').val(id);
				$('#tipoetelefone').val("telefone");
            }
			function openalterarcelular(id){
                
                $("#dialogalterarcelular").dialog("open");
                $('#id_clientealterarcelular').val(id);
				$('#tipoecelular').val("celular");
            }
			function openalterarsenha(id){
                
                $("#dialogalterarsenha").dialog("open");
                $('#id_clientealterarsenha').val(id);
				$('#tipoesenha').val("senha");
            }
			
			/*Script para abrir os modais*/
			$( function() {
				$( "#dialogalterarnome" ).dialog({
					autoOpen: false,
					height: 700,
					width: 550,
					modal: true,
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {
	
						Cancelar: function() {
						$("#dialogalterarnome").dialog( "close" );
						}
					}
				});
			});
			$( function() {
				$( "#dialogalteraremail" ).dialog({
					autoOpen: false,
					height: 700,
					width: 550,
					modal: true,
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {
	
						Cancelar: function() {
						$("#dialogalteraremail").dialog( "close" );
						}
					}
				});
			});
			$( function() {
				$( "#dialogalterarfoto" ).dialog({
					autoOpen: false,
					height: 700,
					width: 550,
					modal: true,
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {
	
						Cancelar: function() {
						$("#dialogalterarfoto").dialog( "close" );
						}
					}
				});
			});
			$( function() {
				$( "#dialogalterartelefone" ).dialog({
					autoOpen: false,
					height: 700,
					width: 550,
					modal: true,
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {
	
						Cancelar: function() {
						$("#dialogalterartelefone").dialog( "close" );
						}
					}
				});
			});
			$( function() {
				$( "#dialogalterarcelular" ).dialog({
					autoOpen: false,
					height: 700,
					width: 550,
					modal: true,
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {
	
						Cancelar: function() {
						$("#dialogalterarcelular").dialog( "close" );
						}
					}
				});
			});
			$( function() {
				$( "#dialogalterarsenha" ).dialog({
					autoOpen: false,
					height: 700,
					width: 550,
					modal: true,
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {
	
						Cancelar: function() {
						$("#dialogalterarsenha").dialog( "close" );
						}
					}
				});
			});			
		</script>
	</body>	
</html>	
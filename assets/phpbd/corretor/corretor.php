<?php
    session_start();
    if($_SESSION["nivel"] != 2){
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
		<title>Painel do Corretor</title>
		<link rel="StyleSheet" href="../../css/style.css">
		<link rel="StyleSheet" href="../../css/bootstrap.css">
		<link rel="stylesheet" href="../../css/jquery-ui.css">
		<!-- DataTables Responsive CSS -->
		<link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
		    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	</head>
	<body>
		<!-- Conteúdo da página -->
		<ul class="sidenav">
			<a href="../../../index.php"><img class="logositepainel" src="../../img/logo.png"></a>
			<li><a>Painel do Corretor</a></li>
			<li class="active"><a data-toggle="tab" href="#atender-cliente">Caixa de entrada</a></li>
			<li><a data-toggle="tab" href="#Imoveis-reservados">Visualizar imoveis reservados</a></li>
			<li><a data-toggle="tab" href="#Reservar-imovel">Reservar imovel para um cliente</a></li>
			<li><a data-toggle="tab" href="#Perfil">Perfil</a></li>
			<li><a href="../../../index.php" class="tablinks">Voltar para o site</a></li>
			<li><a href="../sair.php" class="tablinks">Sair</a></li>
		</ul>
		<div class="tab-content content">
			<div class="tab-pane fade in active" id="atender-cliente">
				<?php
				
					/*Selecionar as tabelas*/
					
					$sql = "SELECT * FROM ContatoCorretor_tb WHERE id_corretor = $id";
					
					$listarc = $conet -> prepare($sql);
					$listarc -> execute();	
				?>
				<center>
					<h4>
						<p>
							Mensagens dos clientes				
						</p>
					</h4>			
					<div class="panel panel-default">
						<div class="panel-body">
							<table  width="100%" class="table table-striped table-bordered table-hover" id="dataTables-msgcliente">
								<thead>
														
									<tr>	
										<th>Status</th>									
										<th>Nome</th>
										<th>Email</th>
										<th>Telefone</th>
										<th>Mensagem</th>
										<th>Opções</th>
					
									</tr>
								</thead>		
								<tbody>
									<?php
									
									foreach($listarc as $ls){	
										echo "<tr>";	
											if($ls['status_msg'] == 1){
										$status = "<i class='fa fa-envelope-open-o fa-3x' aria-hidden='true'></i>";
									}else
										$status ="<a style='color:green;'><i class='fa fa-envelope-o fa-3x' aria-hidden='true'></i></a>";
											echo "<td>".$status."</td>";
											echo "<td>".$ls['nome_cliente']."</td>";
											echo "<td>".$ls['email']."</td>";
											echo "<td>".$ls['telefone']."</td>";
											echo "<td>".$ls['mensagem']."</td>";
											echo "<td><a onclick='confirmacaodeletarmsg(".$ls['id_contato'].")'>Finalizar Contato<a></td>";
										
												
										echo "</tr>";
									}	
									?>
								</tbody>
							</table>	
						</div>
					</div>
				</center>
			</div>
			<div class="tab-pane fade" id="Reservar-imovel">
				<div align="center">
					<h1>Reserve imoveis para clientes</h1><br>
				</div><br>
					<?php
						
						
						/*Limite a se exibido por pagina*/
						$limite_cliente = 10;
						
						/*Verifica se o pg existe se nao atribua 1 a ele*/
						$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1 ;
						
						/*Atribui a variável inicio o inicio de onde os registros vão ser mostrados por página, exemplo 0 à 12, 12 à 24 e assim por diante*/
						$inicio = ($pg * $limite_cliente) - $limite_cliente;
					
						$sqlrscliente = "SELECT * FROM Imoveis_tb
							JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
							JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
							JOIN Finalidade_tb ON Imoveis_tb.id_fin = Finalidade_tb.id_fin
							JOIN Tipo_tb ON Imoveis_tb.id_tipo = Tipo_tb.id_tipo
							JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
							JOIN Regiao_tb ON Imoveis_tb.id_regiao = Regiao_tb.id_regiao ";
						
						$listarscliente = $conet -> prepare("$sqlrscliente LIMIT $inicio,$limite_cliente");
						$listarscliente -> execute();
						
							
						/*Resgata os dados e os insere na tabela*/
						foreach($listarscliente as $lsrsimv){
						$valor = number_format($lsrsimv['valor'],2,",",".");

							echo"<div class='row'>
									<div class='col-md-5'>
										<img src='../../img/fotosimoveis/".$lsrsimv['foto_principal']."' alt='Destaque1' width='300px' height='250px'><br><br>
									</div>
									<div class='col-md-4'>
										".$lsrsimv['titulo']."<br>
										Cidade: ".$lsrsimv['nome_cidade']."<br>
										Negociação: ".$lsrsimv['tipo_nego']."<br>
										Bairro: ".$lsrsimv['nome_bairro']."<br>
										Valor: R$ ".$valor."<br><br>
									</div>
									<div class='col-md-5'>
										<a href='../../../imovel?id=".$lsrsimv['id_imovel']."' class='btn btn-default btn-lg colorbck bnimv'><span class='glyphicon glyphicon-heart' aria-hidden='true'></span> Visualizar Imovel</a><br><br>
										<a class='btn btn-default btn-lg colorbck bnimv' onclick='confirmareservacliente(".$lsrsimv['id_imovel'].")'><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Reserve este imovel para um cliente</a>
									</div>
								</div>
								<br><br>
							";
						}
							
						
						$sqltotalat = "SELECT * FROM Imoveis_tb";
						
						$listatotal = $conet -> prepare($sqltotalat);
						$listatotal -> execute();
						/*Conta a quantidade de atendimentos que o corretor tem*/
						$quantidade = $listatotal -> RowCount();
						
						/*calcula o total de paginas a serem exibidas*/
						$qtdPag = ceil($quantidade/$limite_cliente);
						
						$anterior = $pg -1;
						$proximo = $pg +1;
					
						
						/*Botoes de navegação*/
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
			<div class="tab-pane fade" id="Imoveis-reservados">
			    <div align="center">
					<h1>Imoveis reservados</h1><br>
				</div><br>
					<?php
						
						
						/*Limite a se exibido por pagina*/
						$limite_cliente = 10;
						
						/*Verifica se o pg existe se nao atribua 1 a ele*/
						$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1 ;
						
						/*Atribui a variável inicio o inicio de onde os registros vão ser mostrados por página, exemplo 0 à 12, 12 à 24 e assim por diante*/
						$inicio = ($pg * $limite_cliente) - $limite_cliente;
					
						$sqlreserva = "SELECT * FROM Reserva_tb
							JOIN Usuario_tb ON Reserva_tb.id_usuario = Usuario_tb.id_usuario
							JOIN Imoveis_tb ON Reserva_tb.id_imovel = Imoveis_tb.id_imovel ";
						
						$listareserva = $conet -> prepare("$sqlreserva LIMIT $inicio,$limite_cliente");
						$listareserva -> execute();
						
							
						/*Resgata os dados e os insere na tabela*/
						foreach($listareserva as $lsreserva){
						$valor = number_format($lsreserva['valor'],2,",",".");

							echo"<div class='row'>
									<div class='col-md-5'>
										<img src='../../img/fotosimoveis/".$lsreserva['foto_principal']."' alt='Destaque1' width='300px' height='250px'><br><br>
									</div>
									<div class='col-md-4'>
										".$lsreserva['titulo']."<br>
										Nome do cliente: ".$lsreserva['nome']."<br>
										Email do cliente: ".$lsreserva['email']."<br>
										Telefone do cliente: ".$lsreserva['telefone']."<br>
										Valor do imovel: R$ ".$valor."<br><br>
									</div>
									<div class='col-md-5'>
										<a href='../../../imovel?id=".$lsreserva['id_imovel']."' class='btn btn-default btn-lg colorbck bnimv'><span class='glyphicon glyphicon-heart' aria-hidden='true'></span> Visualizar Imovel</a><br><br>
									</div>
								</div>
								<br><br>
							";
						}
							
						
						$sqltotalat = "SELECT * FROM Reserva_tb";
						
						$listatotal = $conet -> prepare($sqltotalat);
						$listatotal -> execute();
						/*Conta a quantidade de atendimentos que o corretor tem*/
						$quantidade = $listatotal -> RowCount();
						
						/*calcula o total de paginas a serem exibidas*/
						$qtdPag = ceil($quantidade/$limite_cliente);
						
						$anterior = $pg -1;
						$proximo = $pg +1;
					
						
						/*Botoes de navegação*/
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
									<span><label>Foto:</label> <br><img src='../../img/fotousers/".$lsperfil['foto']."' alt='Destaque1' width='150px' height='100px'> </span>
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
			<h2>Formulario de alteração do nome</span></h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterarnome" id="alterarnome" method="POST" class="registration-form" action="CRUD/editar_perfil">
				<div class="form-group">
					<h4 id="lognome"></h4>
				</div>
				<div class="form-group">
					<input type="text" name="nome" id="nomealterar" placeholder="*Nome completo..." class="form-first-name form-control wid" onkeypress="return Onlychars(event)" pattern="[a-z\A-Z\s]+$" title="Somente Letras." required autofocus>
    			</div>
				<br>
				<input type="hidden" id="id_corretoralterarnome" name="id_corretor">
				<input type="hidden" id="tipoenome" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		<!-- Modal alterar email -->
		<div id="dialogalteraremail" title="Alterar Email">
			<h2>Formulario de alteração do email</h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alteraremail" id="alteraremail" method="POST" class="registration-form" action="CRUD/editar_perfil">
				<div class="form-group">
					<h4 id="logemail"></h4>
				</div>
				<div class="form-group">
    			<input type="email" name="email" id="emailalterar" placeholder="*Email..." class="form-first-name form-control wid" required autofocus>
    			</div>
				<br>
				<input type="hidden" id="id_corretoralteraremail" name="id_corretor">
				<input type="hidden" id="tipoeemail" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
 
		<!-- Modal alterar foto -->
		<div id="dialogalterarfoto" title="Alterar Foto">
			<h2>Formulario de alteração do foto </h2>
			<h5>Escolha uma nova foto</h5>
		 
			<form role="form" name="alterarfoto" id="alterarfoto" method="POST" class="registration-form" action="CRUD/editar_perfil" enctype="multipart/form-data">
				<div class="form-group">
					<h4 id="lognome"></h4>
				</div>
				<div class="form-group">
					<input type="file" class="form-first-name form-control wid" id="foto" name="foto" required>
    			</div>
				<br>
				<input type="hidden" id="id_corretoralterarfoto" name="id_corretor">
				<input type="hidden" id="tipoefoto" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		<!-- Modal alterar telefone -->
		<div id="dialogalterartelefone" title="Alterar Telefone">
			<h2>Formulario de alteração do telefone </h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterartelefone" id="alterartelefone" method="POST" class="registration-form" action="CRUD/editar_perfil">
				<div class="form-group">
					<h4 id="logtelefone"></h4>
				</div>
				<div class="form-group">
					<input type="text" name="telefone" id="telefonealterar" placeholder="*Telefone..." class="form-first-name form-control wid" required autofocus>
    			</div>
				<br>
				<input type="hidden" id="id_corretoralterartelefone" name="id_corretor">
				<input type="hidden" id="tipoetelefone" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		<!-- Modal alterar celular -->
		<div id="dialogalterarcelular" title="Alterar celular">
			<h2>Formulario de alteração do celular</h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterarcelular" id="alterarcelular" method="POST" class="registration-form" action="CRUD/editar_perfil">
				<div class="form-group">
					<h4 id="logceluar"></h4>
				</div>
				<div class="form-group">
					<input type="text" name="celular" id="celularalterar" placeholder="*Celular..." class="form-first-name form-control wid" required autofocus>
    			</div>
				<br>
				<input type="hidden" id="id_corretoralterarcelular" name="id_corretor">
				<input type="hidden" id="tipoecelular" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		
		<!-- Modal alterar senha -->
		<div id="dialogalterarsenha" title="Alterar Senha">
			<h2>Formulario de alteração da senha</h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterarsenha" id="alterarsenha" method="POST" class="registration-form" action="CRUD/editar_perfil">
				<div class="form-group">
					<h4 id="logsenha"></h4>
				</div>
				<div class="form-group">
					<input type="password" name="senha" id="senhaalterar" placeholder="*Senha..." class="form-first-name form-control wid" required autofocus>
    			</div>
				<br>
				<input type="hidden" id="id_corretoralterarsenha" name="id_corretor">
				<input type="hidden" id="tipoesenha" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		
		<!-- Modal reservar imovel para um cliente -->
		<div id="dialogareservacliente" title="Reservar imovel para um cliente">
			<h2>Escolha o cliente que deseja efetuar a reserva</h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterarsenha" id="alterarsenha" method="POST" class="registration-form" action="CRUD/reservarcliente">
				<div class="form-group">
					<h4 id="logsenha"></h4>
				</div>
				<div class="form-group">
					<input type="email" name="email" id="emailcliente" Onchange="limpamsgnome();" Onblur="validanome();" placeholder="*Email do cliente..." class="form-first-name form-control wid" id="form-first-name" onkeypress="return Onlychars(event)" title="Somente Letras." required autofocus>

    			</div>
				<br>
				<input type="hidden" id="id_imovelcliente" name="id_imovel">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		
		<!-- JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../js/jquery-ui.js"></script>
		
		<!-- DataTables JavaScript -->
		<script src="../../vendor/datatables/js/jquery.dataTables.js"></script>
		<script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
		<script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>
		
		<script>
			$(document).ready(function(){
				$('#dataTables-msgcliente').DataTable({
					responsive: true
				});
			});
			
			/*Confirmação para deletar a conta*/
			function confirmacaodeletarconta(id) {
               var resposta = confirm("Tem certeza que deseja excluir sua conta?");
           
               if (resposta == true) {
                    window.location.href = "CRUD/deletar_conta.php?id="+id;
               }
			};
			
			/*Confirmação para reservar o imovel para o cliente*/
			function confirmareservacliente(id) {
               var resposta = confirm("Tem certeza que deseja reservar esse imovel para algum cliente ?");
           
               if (resposta == true) {
				   /*função para abrir o modal*/
                    $("#dialogareservacliente").dialog("open");
					$('#id_imovelcliente').val(id);
               }
			};
			
			/*Script para criar o modal*/
			$( function() {
				$( "#dialogareservacliente" ).dialog({
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
						$("#dialogareservacliente").dialog( "close" );
						}
					}
				});
			});
			
			
			
			/*Confirmação para deletar a msg*/
			function confirmacaodeletarmsg(id) {
               var resposta = confirm("Tem certeza que deseja excluir sua conta?");
           
               if (resposta == true) {
                    window.location.href = "CRUD/deletar_msg.php?id="+id;
               }
			};
			
			/*script para abrir os modais*/
			
			function openalterarnome(id){
                
                $("#dialogalterarnome").dialog("open");
                $('#id_corretoralterarnome').val(id);
				$('#tipoenome').val("nome");
            }
			function openalteraremail(id){
                
                $("#dialogalteraremail").dialog("open");
                $('#id_corretoralteraremail').val(id);
				$('#tipoeemail').val("email");
            }
			function openalterarfoto(id){
                
                $("#dialogalterarfoto").dialog("open");
                $('#id_corretoralterarfoto').val(id);
                $('#tipoefoto').val("foto");
            }
			function openalterartelefone(id){
                
                $("#dialogalterartelefone").dialog("open");
                $('#id_corretoralterartelefone').val(id);
				$('#tipoetelefone').val("telefone");
            }
			function openalterarcelular(id){
                
                $("#dialogalterarcelular").dialog("open");
                $('#id_corretoralterarcelular').val(id);
				$('#tipoecelular').val("celular");
            }
			function openalterarsenha(id){
                
                $("#dialogalterarsenha").dialog("open");
                $('#id_corretoralterarsenha').val(id);
				$('#tipoesenha').val("senha");
            }
			
			/*Script para criar os modais*/
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
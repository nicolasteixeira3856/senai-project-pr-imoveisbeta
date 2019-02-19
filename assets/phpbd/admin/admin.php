<?php
    session_start();

    if ($_SESSION["Login"] != "YES") {
        echo "<script>alert('Você não esta logado, por favor efetue o login.');</script>";
        echo "<script>window.location.assign('../../../cadastrologin');</script>";
        session_destroy();
    }else{
        if($_SESSION["nivel"] != 1){
            echo "<script>alert('Você não tem permissão o suficente para acessar essa página.');</script>";
            echo "<script>window.location.assign('../../../index');</script>";
            session_destroy();
        }
    }
	include_once "../connection.php";
	$id = $_SESSION["id"];
?> 
<!DOCTYPE html>
<html lang="pt-br">
		<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Painel de Administração</title>
		<link rel="StyleSheet" href="../../css/style.css">
		<link rel="StyleSheet" href="../../css/bootstrap.css">
		<link rel="stylesheet" href="../../css/jquery-ui.css">

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<body>


		<!-- Conteúdo da página -->
		<ul class="sidenav">
			<a href="../../../../index.php"><img class="logositepainel" src="../../img/logo.png"></a>
			<li><a>Painel do administrador</a></li>
			<li class="active"><a data-toggle="tab" href="#home">Home</a></li>
			<li><a data-toggle="tab" href="#cdstcorretor" >Cadastrar Corretor</a></li>
			<li><a data-toggle="tab" href="#cdstimovel">Cadastrar imóvel</a></li>
			<li><a data-toggle="tab" href="#gerenciarimovel" onclick="timer1()">Gerenciar imóveis</a></li>
			<li><a data-toggle="tab" href="#gerenciarcorretor" onclick="timer2()">Gerenciar corretores</a></li>
			
			<li><a data-toggle="tab" href="#atender-clienteadmin" onclick="timermsg()">Caixa de entrada</a></li>
			<li><a data-toggle="tab" href="#Imoveis-reservados">Visualizar imoveis reservados</a></li>
			<li><a data-toggle="tab" href="#Reservar-imovel">Reservar imovel para um cliente</a></li>
			<li><a data-toggle="tab" href="#Relatorios">Relatórios</a></li>
			
			
			<li><a data-toggle="tab" href="#Perfil">Perfil</a></li>
			<li><a href="../../../../index.php" class="tablinks">Voltar para o site</a></li>
			<li><a href="../sair.php" class="tablinks">Sair</a></li>
		</ul>
		<div class="tab-content content">
			<div id="home" class="tab-pane fade in active">
				<br>
				<h2 align="center">Bem-vindo <?php echo $_SESSION["nome"]; ?></h2>
						<?php 
				$sql = "SELECT DISTINCT id_corretor,Usuario_tb.nome,Usuario_tb.foto FROM ContatoCorretor_tb
				JOIN Usuario_tb ON ContatoCorretor_tb.id_corretor = Usuario_tb.id_usuario";
				
				$listacorretor = $conet -> prepare($sql);
				$listacorretor -> execute();
				
				echo "<h3 align='center'>Corretores mais requisitados</h3><br>";
				foreach ($listacorretor as $bestcorretor){
					
					echo "".$bestcorretor['nome']."<br>";
					echo "<img src='../../img/fotousers/".$bestcorretor['foto']."'  width='300px' height='250px' class='img-circle'><br>";
				}
				
			?>
			</div>

			<div class="tab-pane fade" id="cdstcorretor">
				<div class="form-box">
					<div class="form-top">
						<div class="form-top-left">
							<h1>Cadastrar corretor</h1>
							<p>Preencha todos os campos abaixo para cadastrar um corretor.</p>
						</div>
						<div class="form-top-right">
							<i class="fa fa-pencil"></i>
						</div>
					</div>
					<div class="form-bottom">
						<form role="form" name="cadastro" id="cadastrocorretor" action="CRUD/inserir_corretor.php" method="POST" class="registration-form">
							<div class="form-group">
								<h4 id="logcdstcorretor"></h4>
							</div>
							<div class="form-group">
								<label class="sr-only" for="form-first-name">Nome</label>
								<input type="text" name="nome" id="nome" onkeypress="return Onlychars(event)" onBLur="validanome();" placeholder="*Nome completo..." onChange="limpamsgnome();" class="form-first-name form-control" id="form-first-name" title="Somente Letras." required >
							<div id="msgnome"></div>
							</div>
							<div class="form-group">
								<label class="sr-only" for="form-email">Email</label>
								<input type="email" name="email" id="email" placeholder="*Email..."Onblur="validacaoEmail(cadastro.email)" onChange="limpamsgemail();" class="form-email form-control" id="form-email" required>
							<div id="msgemail"></div>
							</div>
							<div class="form-group">
					
						<label class="sr-only" for="form-email"><strong>Telefone</strong></label>
						<input type="text" name="telefone" id="telefone" placeholder="*Telefone..." onBLur="validatelefone();" onkeypress="return valTELEFONE(event,this); return false;" onChange="limpamsgtelefone();" maxlength="14" class="form-first-name form-control wid" id="form-email" required>
						<div id="msgtelefone"></div>
						</div>
							<div class="form-group">
								<label class="sr-only" for="form-first-name"><strong>Senha</strong></label>
								<input type="password" name="senha" id="senha" Onblur="senha1();" placeholder="*Senha..." onChange="limpamsgsenha();" class="form-first-name form-control wid" pattern="[a-zA-Z0-9 ]+.{6,10}" title="Senha com no máximo 10 caracteres e no mínimo 7 caracteres alfanuméricos" maxlength="10" onclick="return Senha();">
								<div id="msgsenha"></div>
							</div>
							<div class="form-group">
								<label class="sr-only" for="form-first-name"><strong>Confirmar Senha</strong></label>
								<input type="password" name="senha2" id="senha2" placeholder="*Confirmar Senha..." Onblur="confirmasenha();" onChange="limpamsgsenha2();" class="form-first-name form-control wid" id="form-first-name" pattern="[a-zA-Z0-9 ]+.{6,10}" title="Senha com no máximo 10 caracteres e no mínimo 7 caracteres alfanuméricos" maxlength="10" onclick="return Senha();" required>
							<div id="msgsenha2"></div>
							</div>
							<div class="form-group">
								<label class="sr-only" for="form-first-name">CPF</label>
								<input type="text" name="CPF" id ="cpf" placeholder="*CPF..." onChange="limpamsgcpf();" class="form-first-name form-control" id="form-first-name" onkeypress="return valCPF(event,this);return false;" onblur="if(consistenciaCPF(this.value)) this.select();" maxlength="14" title="###.###.###-##"required>
							<div id="msgcpf"></div>
							</div>
					<div id="form-group">
						<select class="form-selected" name="cidadec" id="cidadec" onBLur="campocidade();" onChange=" limpamsgcidade();" required>
							<option value="cidade" disabled selected hidden><strong>*Selecione a Sua Cidade...</strong></option> 
							<?php
								/*Lista todas as cidades do banco*/
								
								$sqlcidade = "SELECT * FROM Cidade_tb order by nome_cidade asc";
								
								$listacidade = $conet -> prepare($sqlcidade);
								$listacidade -> execute();
								
								foreach($listacidade as $lsc){
									echo "<option value=".$lsc['id_cidade'].">".$lsc['nome_cidade']."</option> ";
								}
							?>
						</select>
					<div id="msgcidade"></div>
					</div><br>
					<div class="form-group">
						<input type="text" name="creci" id="creci"  placeholder="*Creci do corretor..."   class="form-first-name form-control" title="Apenas n&#711026;os." pattern="[0-9]+$" maxlength="6" required="required">
						<div id="msgcreci"></div>
					</div>
					<br>
						<button type="submit" class="btn" id="button" value="CONFIRMAR" style="width:65%;">Cadastrar corretor</button>
						</form>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="cdstimovel">
				<div class="form-box">
					<div class="form-top">
						<div class="form-top-left">
							<h1>Cadastrar Imóveis</h1>
							<p>Preencha todos os campos abaixo para cadastrar um Imóveis.</p>
						</div>
						<div class="form-top-right">
							<i class="fa fa-pencil"></i>
						</div>
					</div>
					<div class="form-bottom">
						<form role="form" name="cadastroimovel" id="cadastroimovel" method="POST" action="CRUD/inserir_imovel.php" class="registration-form" enctype="multipart/form-data">
							<div class="form-group">
								<h4 id="logcdstimv"></h4>
							</div>
							<div class="form-group">
								<label  for="form-first-name">Finalidade</label>
								<select class="form-selected" id="finalidade" name="finalidade" onChange="escolhefinalidade(); limpamsgfinalidade(); " required>
									<option value="finalidade" disabled selected hidden>*Selecione a finalidade do Imóveis</option> 
									<option value="1">Residencial</option> 
									<option value="2">Comercial</option> 
									<option value="3">Industrial</option> 
								</select>
							<div id="msgfinalidade"></div>
							</div>
							<div class="form-group">
								<label for="form-first-name">Tipo</label>
								<select class="form-selected" id="tipo" name="tipo" onblur="terreno();" onChange="limpamsgntipo();" required>
									<option value="tipo" disabled selected hidden>*Selecione o tipo do Imóveis</option> 
								</select>
								<div id="msgtipo"></div>
							</div>
							
							<div class="form-group">
								<label for="form-first-name">Negociacao</label>
								<select class="form-selected" id="negociacao" name="negociacao" onChange=" escolhenegociacao(); limpamsgnegociacao();" required>
									<option value="negociacao" disabled selected hidden>*Selecione a Negociação do Imóveis</option> 
									<option value="1">Venda</option> 
									<option value="2">Aluguel</option> 
								</select>
								<div id="msgnegociacao"></div>
							</div>
							
							<div class="form-group">
								<label for="form-first-name">Título</label>
								<input type="text" class="form-first-name form-control" name="titulo" id="titulo" placeholder="*Título" onkeypress="return Onlychars(event)"  onChange="limpamsgtitulo();" title="Somente Letras." required>
								<div id="msgtitulo"></div>
							</div>
							<div class="form-group">
								<label for="form-first-name">Descrição</label>
								<textarea type="text" class="form-first-name form-control" name="descricaoo" id="descricaoo" maxlength="1499" style="resize:none;" placeholder="*Descrição" onChange="limpamsgdescricaoo();" required></textarea>
								<div id="msgdescricao"></div>
							</div>
							
							<div class="form-group">
								<label for="form-email">Área m2</label>
								<input type="number" class="form-email form-control" name="area" id="area" placeholder="*Área m²" maxlength="4" onChange="limpamsgarea();" required>
								<div id="msgarea"></div>
							</div>
							
							<div class="form-group" id="divvalor">
								<div>
									<label for="valor">Valor</label>
									<input type="text" class="form-email form-control" name="valor" id="valor" placeholder="*Valor" onChange="limpamsgvalor();" onkeypress="return Onlynumber(event)" maxlength="15" required>
								</div>
								<div id="msgvalor"></div>
							</div>
							<div class="form-group" id="divquartos">
								<div>
									<label for="form-email">Nº de Quartos</label>
									<input type="number" class="form-email form-control" name="nquarto" id="nquarto" maxlength="2" placeholder="*N° de Quartos" onChange="limpamsgnquarto();" required>
									<div id="msgnquarto"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="form-email">Nº de Vagas</label>
								<input type="number" class="form-email form-control" name="nvaga" id="nvaga" maxlength="3" placeholder="*N° de Vagas" onChange="limpamsgnvagas();" required>
								<div id="msgnvagas"></div>
							</div>
							
							<div class="form-group">
								<label for="form-first-name">Cidade</label>
								<select class="form-selected" name="cidade" id="cidade" onChange="getBairro(); limpamsgcidade();" required>
									<option value="cidade" disabled selected hidden>*Selecione a cidade do Imóveis</option> 
									<?php
										/*Lista todas as cidades do banco*/
										
										$sqlcidade = "SELECT * FROM Cidade_tb order by nome_cidade asc";
										
										$listacidade = $conet -> prepare($sqlcidade);
										$listacidade -> execute();
										
										foreach($listacidade as $lsc){
											echo "<option value=".$lsc['id_cidade'].">".$lsc['nome_cidade']."</option> ";
										}
									?>
								</select>
								<div id="msgcidade"></div>
							</div>
							
							<div class="form-group">
								<label for="form-first-name">Bairro</label>
								<select class="form-selected" name="bairro" id="bairro" onChange="limpamsgbairro();" required>
									<option value="cidade" disabled selected hidden>*Selecione o bairro do Imóveis</option> 
								</select>
							<div id="msgbairro"></div>
							</div>
							
							<div class="form-group">
								<label for="form-first-name" >Região</label>
								<select class="form-selected" id="regiao" name="regiao" onChange="limpamsgregiao();" required>
									<option value="cidade" disabled selected hidden>*Selecione a Região do Imóveis</option> 
									<option value="1">Norte</option> 
									<option value="2">Sul</option> 
									<option value="3">Leste</option> 
									<option value="4">Oeste</option> 
								</select>
								<div id="msgregiao"></div>
							</div>
							
							<div class="form-group">
								<label for="form-first-name">Rua</label>
								<input type="text" name="rua" id="rua" placeholder="*Nome da Rua" class="form-first-name form-control" pattern="[a-z\A-Z\s]+$" title="Somente Letras." onkeypress="return Onlychars(event)" onChange="limpamsgRua();" required>
								<div id="msgrua"></div>
							</div>
							
							<div class="form-group">
								<label for="form-first-name">Número da Casa</label>
								<input type="number" class="form-first-name form-control" name="ncasa" id="ncasa" placeholder="*Número da Casa" maxlength="5" onChange="limpamsgncasa();" required>
								<div id="msgncasa"></div>
							</div>
							<div class="form-group">
								<label class="sr-only" for="form-first-name">Imgem 1 do Imóveis</label>
								<input type="file" name="img1" onChange="limpamsgimg1();" id="img1" required><br><div id="msgimg1"></div>
								<label class="sr-only" for="form-first-name">Imgem 2 do Imóveis</label>
								<input type="file" name="img2" onChange="limpamsgimg2();" id="img2" required><br><div id="msgimg2"></div>
								<label class="sr-only" for="form-first-name">Imgem 3 do Imóveis</label>
								<input type="file" name="img3" onChange="limpamsgimg3();" id="img3" required><br><div id="msgimg3"></div>
								<label class="sr-only" for="form-first-name">Imgem 4 do Imóveis</label>
								<input type="file" name="img4" onChange="limpamsgimg4();" id="img4" required><br><div id="msgimg4"></div>
							</div>
							<button type="submit" class="btn" id="button" onclick="return validaForm1(); " value="CONFIRMAR" style="width:65%;">Próximo</button>
						</form>
					</div>
				</div>
			</div>
		<div class="tab-pane fade" id="gerenciarimovel">
						<?php
					
					/*Selecionar as tabelas*/
					
					$sqlm = "SELECT * FROM Imoveis_tb
					JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
					JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
					JOIN Finalidade_tb ON Imoveis_tb.id_fin = Finalidade_tb.id_fin
					JOIN Tipo_tb ON Imoveis_tb.id_tipo = Tipo_tb.id_tipo
					JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
					JOIN Regiao_tb ON Imoveis_tb.id_regiao = Regiao_tb.id_regiao";
					
					$listarimv = $conet -> prepare($sqlm);
					$listarimv -> execute();
				?>

			
		<center>
			<h4>
				<p>
					Tabela de Imóveis Cadastrados				
				</p>
			</h4>			
			<div class="panel panel-default">
				<div class="panel-body">
					<table  width="100%" class="table table-striped table-bordered table-hover display" id="dataTables-example">
						<thead>
							<tr>								 
								<th>ID</th>
								<th>Finalidade</th>								
								<th>Rua</th>
								<th>Cidade</th>
								<th>Bairro</th>
								<th>Negociacao</th>
								<th>Tipo</th>
								<th>Area M2</th>
								<th>Valor</th>
								<th>Editar</th>
								<th>Excluir</th>
							</tr>
						</thead>		
						<tbody>
						<?php
							foreach($listarimv as $lsm){	
								echo "<tr>";							
									echo "<td>".$lsm['id_imovel']."</td>";
									echo "<td>".$lsm['finalidade']."</td>";
									echo "<td>".$lsm['rua']."</td>";
									echo "<td>".$lsm['nome_cidade']."</td>";
									echo "<td>".$lsm['nome_bairro']."</td>";
									echo "<td>".$lsm['tipo_nego']."</td>";
									echo "<td>".$lsm['nome_tipo']."</td>";
									echo "<td>".$lsm['aream2']."</td>";
									echo "<td> R$ ".number_format($lsm['valor'], 2, ',', '.')."</td>";				
						?>
									<!--<td><a class='btn btn-primary' onclick='abrirmodalimovel("<?php echo $lsm['id_imovel']?>","<?php echo $lsm['titulo']?>","<?php echo $lsm['descricao']?>","<?php echo $lsm['valor']?>","<?php echo $lsm['aream2']?>","<?php echo $lsm['n_vagas']?>");' ><span class='glyphicon glyphicon-edit'></span></a></td>-->
									<td><a href="editarimv?id_imovel=<?php echo $lsm['id_imovel']?>" class='btn btn-primary' ><span class='glyphicon glyphicon-edit'></span></a></td>
									<td><a class='btn btn-primary' onclick='confirmacaodeletarimovel(<?php echo $lsm['id_imovel'] ?>)'><span class='glyphicon glyphicon-trash'></span></a></td>
						<?php
								echo "</tr>";
							}	
						?>
						</tbody>
					</table>	
				</div>
			</div>
			</center>
		</div>

		<div class="tab-pane fade" id="gerenciarcorretor">
			<?php
				
				/*Selecionar as tabelas*/
				
				$sql = "SELECT * FROM Usuario_tb 
				JOIN Cidade_tb ON Usuario_tb.id_cidade = Cidade_tb.id_cidade
				WHERE nivel = 2";
				
				$listarc = $conet -> prepare($sql);
				$listarc -> execute();	
			?>
			<center>
				<h4>
					<p>
						Tabela de Corretores Cadastrados				
					</p>
				</h4>			
				<div class="panel panel-default">
					<div class="panel-body">
						<table  width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
							<thead>
													
								<tr>								 
									<th>ID</th>
									<th>Nome</th>
									<th>E-mail</th>
									<th>Cidade</th>
									<th>CPF</th>
									<th>Creci</th>
									<th>Editar</th>
									<th>Excluir</th>
				
								</tr>
							</thead>		
							<tbody>
								<?php
								
								foreach($listarc as $ls){
									echo "<tr>";
											
										echo "<td>".$ls['id_usuario']."</td>";
										echo "<td>".$ls['nome']."</td>";
										echo "<td>".$ls['email']."</td>";
										echo "<td>".$ls['nome_cidade']."</td>";
										echo "<td>".$ls['CPF']."</td>";
										echo "<td>".$ls['CRECI']."</td>";	
								?>
										<td><a class='btn btn-primary' onclick='abrirmodal("<?php echo $ls['id_usuario']?>","<?php echo $ls['nome']?>","<?php echo $ls['telefone']?>","<?php echo $ls['celular']?>","<?php echo $ls['CRECI']?>");' ><span class='glyphicon glyphicon-edit'></span></a></td>
										<td><a class='btn btn-primary'    onclick='confirmacaodeletar(<?php echo $ls['id_usuario'] ?>)'><span class='glyphicon glyphicon-trash'></span></a></td>
								<?php
											
									echo "</tr>";
								}	
								?>
							</tbody>
						</table>	
					</div>
				</div>
			</center>
		</div>
		<!-- Funções que o corretor faz para o admin poder fazer tambem -->
		
			<div class="tab-pane fade" id="atender-clienteadmin">
				<?php
				
					/*Selecionar as tabelas*/
					
					$sql = "SELECT * FROM ContatoCorretor_tb
					JOIN Usuario_tb ON ContatoCorretor_tb.id_corretor = Usuario_tb.id_usuario";
					
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
										<th>Corretor</th>
										<th>Email</th>
										<th>Telefone</th>
										<th>Mensagem</th>
										<th>Opções</th>
					
									</tr>
								</thead>		
								<tbody>
									<?php
									
									foreach($listarc as $ls){
									if($ls['status_msg'] == 1){
										$status = "<i class='fa fa-envelope-open-o fa-3x' aria-hidden='true'></i>";
									}else
										$status ="<a><i class='fa fa-envelope-o fa-3x' aria-hidden='true'></i></a>";
										echo "<tr onclick='teste();'>";	
											echo "<td>".$status."</td>";
											echo "<td>".$ls['nome_cliente']."</td>";
											echo "<td>".$ls['nome']."</td>";
											echo "<td>".$ls['email']."</td>";
											echo "<td>".$ls['telefone']."</td>";
											echo "<td>".$ls['mensagem']."</td>";
											echo "<td><a onclick='confirmacaodeletarmsg(".$ls['id_contato'].")'>Finalizar Contato<a></td>";
										
												
										echo "</tr>";
									}	
									?>
									<script>
									function teste(){
										alert("oi");
									}
									</script>
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
							echo"<div class='row'>
									<div class='col-md-5'>
										<img src='../../img/fotosimoveis/".$lsrsimv['foto_principal']."' alt='Destaque1' width='300px' height='250px'><br><br>
									</div>
									<div class='col-md-4'>
										".$lsrsimv['titulo']."<br>
										Cidade: ".$lsrsimv['nome_cidade']."<br>
										Negociação: ".$lsrsimv['tipo_nego']."<br>
										Bairro: ".$lsrsimv['nome_bairro']."<br>
										Valor: R$ ".number_format($lsrsimv['valor'], 2, ',', '.')."<br><br>
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
							echo"<div class='row'>
									<div class='col-md-5'>
										<img src='../../img/fotosimoveis/".$lsreserva['foto_principal']."' alt='Destaque1' width='300px' height='250px'><br><br>
									</div>
									<div class='col-md-4'>
										".$lsreserva['titulo']."<br>
										Nome do cliente: ".$lsreserva['nome']."<br>
										Email do cliente: ".$lsreserva['email']."<br>
										Telefone do cliente: ".$lsreserva['telefone']."<br>
										Valor do imovel: R$ ".$lsreserva['valor']."<br><br>
									</div>
									<div class='col-md-5'>
										<a href='../../../imovel?id=".number_format($lsreserva['valor'], 2, ',', '.')."' class='btn btn-default btn-lg colorbck bnimv'><span class='glyphicon glyphicon-heart' aria-hidden='true'></span> Visualizar Imovel</a><br><br>
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
		
		<!--/Funções que o corretor faz para o admin poder fazer tambem  -->
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
								<div><button type='button' class='btn btn-primary' onclick='confirmacaodeletarconta(".$id.")'>Excluir conta!!</button></span></div>
							</div>
							";
			            
			        ?>
					
					
			</div>
			<div class="tab-pane fade" id="Relatorios">
				<center>
					<br><br>
					<h3>Gerar relatórios</h3>
					<br><br>
					<a href="CRUD/relatorios.php?tipo=imvc" class='btn btn-primary' style="width:35%; text-align:left;">Relatório de imóveis cadastrados</button></a><br><br>
					<a href="CRUD/relatorios.php?tipo=corc" class='btn btn-primary' style="width:35%; text-align:left;">Relatório de corretores cadastrados</button></a><br><br>
					<a href="CRUD/relatorios.php?tipo=cliec" class='btn btn-primary'style="width:35%; text-align:left;">Relatório de clientes cadastrados</button></a><br><br>
					<!-- <a href="CRUD/relatorios.php?tipo=rsimv" class='btn btn-primary'>Relatório de reserva de imóveis</button></a><br><br> -->
				</center>
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
					<input type="text" name="nome" id="nomealterar" Onchange="limpamsgnome();" Onblur="validanome();" placeholder="*Nome completo..." class="form-first-name form-control wid" onkeypress="return Onlychars(event)" pattern="[a-z\A-Z\s]+$" title="Somente Letras." required>
    			</div>
				<br>
				<input type="hidden" id="id_adminalterarnome" name="id_admin">
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
					<input type="email" name="email" id="emailalterar" placeholder="*Email..." class="form-first-name form-control wid" required>
    			</div>
				<br>
				<input type="hidden" id="id_adminalteraremail" name="id_admin">
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
				<input type="hidden" id="id_adminalterarfoto" name="id_admin">
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
					<input type="text" name="telefone" id="telefonealterar" placeholder="*Telefone..." class="form-first-name form-control wid" required>
    			</div>
				<br>
				<input type="hidden" id="id_adminalterartelefone" name="id_admin">
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
					<input type="text" name="celular" id="celularalterar" placeholder="*Celular..." class="form-first-name form-control wid" required >
    			</div>
				<br>
				<input type="hidden" id="id_adminalterarcelular" name="id_admin">
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
					<input type="password" name="senha" id="senhaalterar" placeholder="*Senha..." class="form-first-name form-control wid" required >
    			</div>
				<br>
				<input type="hidden" id="id_adminalterarsenha" name="id_admin">
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
					<input type="email" name="email" id="emailcliente" Onchange="limpamsgnome();" Onblur="validanome();" placeholder="*Email do cliente..." class="form-first-name form-control wid" id="form-first-name" onkeypress="return Onlychars(event)" title="Somente Letras." required >

    			</div>
				<br>
				<input type="hidden" id="id_imovelcliente" name="id_imovel">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		
			
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
		
		<!-- Alert mostrando cadastrado com sucesso -->
		<div id="dialogcdstcorretor" title="Cadastrado com sucesso!!">
			<p style="color:green;">
				Cadastrado com sucesso!!
			</p>
			<p>
				Clique em ok para continuar.
			</p>
		</div>
		<!-- /Alert mostrando cadastrado com sucesso -->
		
		<!-- Alert mostrando cadastrado com sucesso -->
		<div id="dialogeditc" title="Alterado com sucesso!!">
			<p style="color:green;">
				Alterado com sucesso!!
			</p>
			<p>
				Clique em ok para continuar.
			</p>
		</div>
		<!-- /Alert mostrando cadastrado com sucesso -->
		
		<div id="dialogeditcorretor" title="Editar Corretor">
			<h2>Formulario de edição de corretor</h2>
			<h5>Somente preencher o que será editado</h5>
		 
			<form role="form" name="editcorretor" id="editcorretor" method="POST" class="registration-form">
				<div class="form-group">
					<h4 id="logeditcorretor"></h4>
				</div>
				<div class="form-group">
					<label for="form-first-name">Nome</label>
					<input type="text" name="nomeedit" id="nomeedit" onkeypress="return Onlychars(event)" placeholder="Nome completo..."  class="form-first-name form-control" title="Somente Letras.">
			
				</div>
				<div class="form-group">
					<label for="form-first-name">Telefone</label>
			<input type="text" name="telefoneedit" id="telefoneedit" placeholder="*Telefone..."  onkeypress="return valTELEFONE(event,this); return false;"  class="form-first-name form-control wid" id="form-first-name"   maxlength="13">
			
				</div>
				<div class="form-group">
					<label for="form-first-name">Celular</label>
					<input type="text" name="celularedit" id="celularedit" placeholder="*Celular..." onkeypress="return valTELEFONE(event,this); return false;"  class="form-first-name form-control wid" id="form-first-name"   maxlength="14">
				</div>
				<div class="form-group">
					<label for="form-first-name">CRECI</label>
					<input type="text" name="CRECIedit" id="CRECIedit" onkeypress="return Onlynumber(event)" placeholder="CRECI..."  class="form-first-name form-control" title="Somente Letras.">
				</div>
				<br>
				<input type="hidden" id="id_corretoredit">
				<button type="submit" class="btn" id="button" onclick="return validaForm(); " style="width:65%;">Finalizar Edição</button>
			</form>
		</div>
		<!-- /Alert mostrando cadastrado com sucesso -->
		<!-- Modal editar imoveis -->
		<div id="dialogeditimoveis" title="Editar Imóvel">
			<h2>Formulario de edição de imóveis</h2>
			<h5>Somente preencher o que será editado</h5>
		 
			<form role="form" name="editimoveis" id="editimoveis" method="POST" class="registration-form">
				<div class="form-group">
					<h4 id="logeditimoveis"></h4>
				</div>
				<div class="form-group">
					<label for="form-first-name">Titulo</label>
					<input type="text" name="tituloedit" id="tituloedit"  placeholder="Titulo..."  class="form-first-name form-control">
				</div>
				<div class="form-group">
					<label for="form-first-name">Descrição</label>
					<input type="text" name="descricaoedit" id="descricaoedit" placeholder="*Descrição..."  class="form-first-name form-control wid" id="form-first-name">
				</div>
				<div class="form-group">
					<label for="form-first-name">Valor Aluguel</label>
					<input type="text" class="form-email form-control" name="valoredit" id="valoredit" placeholder="*Valor"  onkeypress="return Onlynumber(event)" maxlength="15">
				</div>
				<div class="form-group">
					<label for="form-first-name">Área m²</label>
					<input type="text" name="areaedit" id="areaedit" onkeypress="return Onlynumber(event)" placeholder="Área m²..."  class="form-first-name form-control" >
				</div>
				<div class="form-group">
					<label for="form-first-name">Número de vagas</label>
					<input type="text" name="nvagasedit" id="nvagasedit" onkeypress="return Onlynumber(event)" placeholder="Número de vagas..."  class="form-first-name form-control" >
				</div>
				<br>
				<input type="hidden" id="id_imoveisedit">
				<button type="submit" class="btn" id="button" style="width:65%;">Enviar</button>
			</form>
		</div>
	
	
	<!-- JavaScript -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery-ui.js"></script>
	<script src="../../js/script.js"></script>
	<script src="../../js/validacao.js"></script>
	<script src="../../js/jquery.maskMoney.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
		function timer1(){
				
				setInterval(function(){ tabelarespo1(); }, 200);
		
		}
		
		function tabelarespo1(){
			
			$('#dataTables-example').DataTable({
				responsive: true,
				retrieve: true
			});
		}
		
		function timer2(){
				
				setInterval(function(){ tabelarespo2(); }, 200);
		
		}
		
		function tabelarespo2(){
			
			$('#dataTables-example2').DataTable({
				responsive: true,
				retrieve: true
			});
		}
		
		function timermsg(){
				
				setInterval(function(){ tabelarespomsg(); }, 200);
		
		}
		
		function tabelarespomsg(){
			
			$('#dataTables-msgcliente').DataTable({
				responsive: true,
				retrieve: true
			});
		}
            
			
			
            			
			/*Confirmação para deletar o corretor*/
			function confirmacaodeletar(id) {
               var resposta = confirm("Tem certeza que deseja excluir esse corretor?");
           
               if (resposta == true) {
                    window.location.href = "CRUD/deletar_corretor.php?id="+id;
               }
			};
			
			/*Confirmação para deletar o imovel*/
			function confirmacaodeletarimovel(id) {
               var resposta = confirm("Tem certeza que deseja excluir esse imóvel?");
           
               if (resposta == true) {
                    window.location.href = "CRUD/deletar_imovel.php?id="+id;
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
		
			
			$(function(){
				$("#valor").maskMoney({symbol:'R$ ', 
				showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
			})          
            
            
            /*Scripts para o formulario de Cadastro de imoveis*/
            
            /*deixa todos os campos desativado fora a finalidade*/
            $(document).ready(function(){
                $("#tipo").prop("disabled", true);
			    $("#negociacao").prop("disabled", true);
			    $("#titulo").prop("disabled", true);
			    $("#descricaoo").prop("disabled", true);
			    $("#area").prop("disabled", true);
			    $("#valor").prop("disabled", true);
			    $("#nquarto").prop("disabled", true);
			    $("#nvaga").prop("disabled", true);
			    $("#cidade").prop("disabled", true);
			    $("#bairro").prop("disabled", true);
			    $("#regiao").prop("disabled", true);
			    $("#rua").prop("disabled", true);
			    $("#ncasa").prop("disabled", true);
			})
			
			    
			/*função que verifica qual finalidade escolhida e adicionar os campos e remover o nquatos caso for o exigido*/
			function escolhefinalidade(){
			    
			    var finalidade = $('#finalidade').val();
			    
			    $("#tipo").prop("disabled", false);
			    $("#negociacao").prop("disabled", false);
			    $("#titulo").prop("disabled", false);
			    $("#descricaoo").prop("disabled", false);
			    $("#area").prop("disabled", false);
			    $("#valor").prop("disabled", false);
			    $("#nquarto").prop("disabled", false);
			    $("#nvaga").prop("disabled", false);
			    $("#cidade").prop("disabled", false);
			    $("#bairro").prop("disabled", false);
			    $("#regiao").prop("disabled", false);
			    $("#rua").prop("disabled", false);
			    $("#ncasa").prop("disabled", false);
			    
			    if(finalidade == 1){
			        $("select#tipo option[value='6']").remove();
			        $("select#tipo option[value='7']").remove();
			        $("select#tipo option[value='8']").remove();
			        $("select#tipo option[value='9']").remove();
			        $('#tipo').append('<option value="1">Casa</option>');
		            $('#tipo').append('<option value="2">Apartamento</option>');
		            $('#tipo').append('<option value="3">Sobrado</option>');
		            $('#tipo').append('<option value="4">Kitinete</option>');
		            $('#tipo').append('<option value="5">Flat</option>');
			        $('#tipo').append('<option value="9">Terreno Vazio</option>');
			        $('#nquarto').parent('div').remove();
			        $('#divquartos').append('<div>\
			                                <label for="form-email">Nº de Quartos</label>\
                                            <input type="number" class="form-email form-control" name="nquarto" id="nquarto" placeholder="*N° de Quartos" onChange="limpamsgnquarto();" required>\
                                        	<div id="msgnquarto"></div>\
                                        </div>');
			    }else if(finalidade == 2){
			        $("select#tipo option[value='1']").remove();
			        $("select#tipo option[value='2']").remove();
			        $("select#tipo option[value='3']").remove();
			        $("select#tipo option[value='4']").remove();
			        $("select#tipo option[value='5']").remove();
			        $("select#tipo option[value='8']").remove();
			        $("select#tipo option[value='9']").remove();
			        $('#tipo').append('<option value="6">Ponto comercial</option>');
			        $('#tipo').append('<option value="7">Loja</option>');
			        $('#tipo').append('<option value="9">Terreno Vazio</option>');
			        $('#nquarto').parent('div').remove();
			    }else if(finalidade == 3){
			        $("select#tipo option[value='1']").remove();
			        $("select#tipo option[value='2']").remove();
			        $("select#tipo option[value='3']").remove();
			        $("select#tipo option[value='4']").remove();
			        $("select#tipo option[value='5']").remove();
			        $("select#tipo option[value='6']").remove();
			        $("select#tipo option[value='7']").remove();
			        $("select#tipo option[value='9']").remove();
			        $('#tipo').append('<option value="8">Barracão</option>');
			        $('#tipo').append('<option value="9">Terreno Vazio</option>');
			        $('#nquarto').parent('div').remove();
			    }
			}
			
			/*função que verifica qual negociacao foi escolhida para altera o campo falor entre valor da venda e valor de Aluguel*/
			function escolhenegociacao(){
			    
			    var negociacao = $('#negociacao').val();
			    $("#valor").prop("disabled", true);
			    if(negociacao == 1){
			        $('#valor').parent('div').remove();
			        $('#divvalor').append('<div>\
			                         <label  for="valor">Valor da Venda</label>\
                                    <input type="text" class="form-email form-control" name="valor" id="valor" placeholder="*Valor da Venda" onChange="limpamsgvalor();" maxlength="15" required>\
                                </div>');
                    
			        
			    }else if(negociacao == 2){
			        $('#valor').parent('div').remove();
			        $('#divvalor').append('<div>\
        			                        <label  for="valor">Valor do Aluguel</label>\
                                            <input type="text" class="form-email form-control" name="valor" id="valor" placeholder="*Valor do Aluguel" onChange="limpamsgvalor();" maxlength="12" required>\
                                        </div>');
			    }
			    $(function(){
        				$("#valor").maskMoney({symbol:'R$ ', 
        				showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
        			})
			}
			
			/*Script para enviar o form do cadastro de imovel*/
			/*$(document).ready(function(){
				$('#logcdstimv').hide();
				$('#cadastroimovel').submit(function(){
					var finalidade	=$('#finalidade').val();
					var tipo		=$('#tipo').val();
					var negociacao	=$('#negociacao').val();
					var titulo		=$('#titulo').val();
					var descricaoo	=$('#descricaoo').val();
					var area		=$('#area').val();
					var valor		=$('#valor').val();
					var nquarto		=$('#nquarto').val();
					var nvaga		=$('#nvaga').val();
					var cidade		=$('#cidade').val();
					var bairro		=$('#bairro').val();
					var regiao		=$('#regiao').val();
					var rua			=$('#rua').val();
					var ncasa		=$('#ncasa').val();
					var img1		=$('#img1').val();
					var img2		=$('#img2').val();
					var img3		=$('#img3').val();
					var img4		=$('#img4').val();
					$.ajax({
						url:"CRUD/inserir_imovel.php",
						type:"POST",
						data: "finalidade="+finalidade+"&tipo="+tipo+"&negociacao="+negociacao+"&titulo="+titulo+"&descricaoo="+descricaoo+"&area="+area+"&valor="+valor+"&nquarto="+nquarto+"&nvaga="+nvaga+"&cidade="+cidade+"&bairro="+bairro+"&regiao="+regiao+"&rua="+rua+"&ncasa="+ncasa+"&img1="+img1+"&img2="+img2+"&img3="+img3+"&img4="+img4,
						mimeType:"multipart/form-data",
                        contentType: false,
                        cache: false,
                        processData:false,
						dataType: "json",
						beforeSend: function(){
                            $('#logcdstimv').show();
							$('#logcdstimv').text('Validando...');
							$('#logcdstimv').css('color', 'blue');
                        },
						success: function (result){
							if(result.codigo == 0){
							    $( "#dialog" ).dialog( "open" );
							}else if(result.codigo != 0){
								$('#logcdstimv').show();
								$('#logcdstimv').text(result.msg);
								$('#logcdstimv').css('color', 'red');
							}else{
								alert('Erro Fatal');
							}
						}
					})
					return false;
				})
			})*/
			
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
							location.reload();
						}
					}
				});
			});
			
			/*Funcão para pegar o bairro segundo sua cidade*/
			
			function getBairro(){
				var id_cidade = $("#cidade").val();
				$.ajax({
						url:"CRUD/getBairro.php",
						type:"POST",
						data: "id_cidade="+id_cidade,
						success: function (result){
							$("#bairro").html(result);
						}
					})
			};
			
			/*Script para enviar o form do cadastro de corretor*/
			$(document).ready(function(){
				$('#logcdstcorretor').hide();
				$('#cadastrocorretor').submit(function(){
					var nome=$('#nome').val();
					var email=$('#email').val();
					var telefone=$('#telefone').val();
					var senha=$('#senha').val();
					var cpf=$('#cpf').val();
					var cidade=$('#cidadec').val();
					var creci=$('#creci').val();
					$('#errolog').hide();
					$('#log').show();
					$.ajax({
						url:"CRUD/inserir_corretor.php",
						type:"POST",
						data: "nome="+nome+"&email="+email+"&telefone="+telefone+"&senha="+senha+"&cpf="+cpf+"&cidade="+cidade+"&creci="+creci,
						dataType: "json",
						beforeSend: function(){
                            $('#logcdstcorretor').show();
							$('#logcdstcorretor').text('Validando...');
							$('#logcdstcorretor').css('color', 'blue');
                        },
						success: function (result){
							if(result.codigo == 0){
							    $( "#dialogcdstcorretor" ).dialog( "open" );
							}else if(result.codigo != 0){
								$('#logcdstcorretor').show();
								$('#logcdstcorretor').text(result.msg);
								$('#logcdstcorretor').css('color', 'red');
							}else{
								alert('Erro Fatal');
							}
						}
					})
					return false;
				})
			})
			
			$( function() {
				$( "#dialogcdstcorretor" ).dialog({/*Cria a funçao de dialogo do jquery*/
					autoOpen: false,/*Deixa o autoOpen desativado*/
					dialogClass: "no-close",
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {/*Cria o batao de ok redirecionando para outra pagina*/
						OK: function() {
							location.reload();
						}
					}
				});
			});
			
			/*Script para o editar corretor*/
			$( function() {
				$( "#dialogeditcorretor" ).dialog({
					autoOpen: false,
					height: 700,
					width: 550,
					modal: true,
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {
	
						Cancel: function() {
						$("#dialogeditcorretor").dialog( "close" );
						}
					}
				});
			});
			/*function para abrir o modal e enviar os parametros*/
			function abrirmodal(id,nome,telefone,celular,creci){
				
				$("#dialogeditcorretor").dialog("open");
				
				$('#id_corretoredit').val(id);
				$('#nomeedit').val(nome);
				$('#telefoneedit').val(telefone);
				$('#celularedit').val(celular);
				$('#CRECIedit').val(creci);
				
			}
			
			/*Script para enviar o form do cadastro de imovel*/
			$(document).ready(function(){
				$('#logeditcorretor').hide();
				$('#editcorretor').submit(function(){
					var id_corretor	=$('#id_corretoredit').val();
					var nome		=$('#nomeedit').val();
					var telefone	=$('#telefoneedit').val();
					var celular		=$('#celularedit').val();
					var CRECI		=$('#CRECIedit').val();
					$.ajax({
						url:"CRUD/editar_corretor.php",
						type:"POST",
						data: "id_corretor="+id_corretor+"&nome="+nome+"&telefone="+telefone+"&celular="+celular+"&CRECI="+CRECI,
						dataType: "json",
						beforeSend: function(){
                            $('#logeditcorretor').show();
							$('#logeditcorretor').text('Validando...');
							$('#logeditcorretor').css('color', 'blue');
                        },
						success: function (result){
							if(result.codigo == 0){
							    $( "#dialogeditc" ).dialog( "open" );
							}else if(result.codigo != 0){
								$('#logeditcorretor').show();
								$('#logeditcorretor').text(result.msg);
								$('#logeditcorretor').css('color', 'red');
							}else{
								alert('Erro Fatal');
							}
						}
					})
					return false;
				})
			})
			
			$( function() {
				$( "#dialogeditc" ).dialog({/*Cria a funçao de dialogo do jquery*/
					autoOpen: false,/*Deixa o autoOpen desativado*/
					dialogClass: "no-close",
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {/*Cria o batao de ok redirecionando para outra pagina*/
						OK: function() {
							location.reload();
						}
					}
				});
			});
			
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/



			$( function() {
				$( "#dialogeditimoveis" ).dialog({/*Cria a funçao de dialogo do jquery*/
					autoOpen: false,/*Deixa o autoOpen desativado*/
					dialogClass: "no-close",
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {/*Cria o batao de ok redirecionando para outra pagina*/
						OK: function() {
							location.reload();
						}
					}
				});
			});
			
			/*Script para o editar corretor*/
			$( function() {
				$( "#dialogeditimoveis" ).dialog({
					autoOpen: false,
					height: 700,
					width: 550,
					modal: true,
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {
	
						Cancel: function() {
						$("#dialogeditimvoeis").dialog( "close" );
						}
					}
				});
			});
			/*function para abrir o modal e enviar os parametros*/
			function abrirmodalimovel(id,titulo,descricao,valor,area,nvagas){
				
				$("#dialogeditimoveis").dialog("open");
				
				$('#id_imoveisedit').val(id);
				$('#tituloedit').val(titulo);
				$('#descricaoedit').val(descricao);
				$('#valoredit').val(valor);
				$('#areaedit').val(area);
				$('#nvagasedit').val(nvagas);
			}
			
			/*Script para enviar o form do cadastro de imovel*/
			$(document).ready(function(){
				$('#logeditimoveis').hide();
				$('#editimoveis').submit(function(){
					var id_imovel	=$('#id_imoveisedit').val();
					var titulo		=$('#tituloedit').val();
					var descricao	=$('#descricaoedit').val();
					var valor		=$('#valoredit').val();
					var aream2		=$('#areaedit').val();
					var n_vagas		=$('#nvagasedit').val();
					$.ajax({
						url:"CRUD/editar_imoveis.php",
						type:"POST",
						data: "id_imovel="+id_imovel+"&titulo="+titulo+"&descricao="+descricao+"&valor="+valor+"&aream2="+aream2+"&n_vagas="+n_vagas,Z
						dataType: "json",
						beforeSend: function(){
                            $('#logeditimovel').show();
							$('#logeditimovel').text('Validando...');
							$('#logeditimovel').css('color', 'blue');
                        },
						success: function (result){
							if(result.codigo == 0){
							    $( "#dialogeditc" ).dialog( "open" );
							}else if(result.codigo != 0){
								$('#logeditimovel').show();
								$('#logeditimovel').text(result.msg);
								$('#logeditimovel').css('color', 'red');
							}else{
								alert('Erro Fatal');
							}
						}
					})
					return false;
				})
			})
			
			$( function() {
				$( "#dialogeditc" ).dialog({/*Cria a funçao de dialogo do jquery*/
					autoOpen: false,/*Deixa o autoOpen desativado*/
					dialogClass: "no-close",
					show: {/*Executa um efeito quando aberto o dialogo*/
						effect: "blind",
						duration: 500
					},
					buttons: {/*Cria o batao de ok redirecionando para outra pagina*/
						OK: function() {
							location.reload();
						}
					}
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
                $('#id_adminalterarnome').val(id);
				$('#tipoenome').val("nome");
            }
			function openalteraremail(id){
                
                $("#dialogalteraremail").dialog("open");
                $('#id_adminalteraremail').val(id);
				$('#tipoeemail').val("email");
            }
			function openalterarfoto(id){
                
                $("#dialogalterarfoto").dialog("open");
                $('#id_adminalterarfoto').val(id);
                $('#tipoefoto').val("foto");
            }
			function openalterartelefone(id){
                
                $("#dialogalterartelefone").dialog("open");
                $('#id_adminalterartelefone').val(id);
				$('#tipoetelefone').val("telefone");
            }
			function openalterarcelular(id){
                
                $("#dialogalterarcelular").dialog("open");
                $('#id_adminalterarcelular').val(id);
				$('#tipoecelular').val("celular");
            }
			function openalterarsenha(id){
                
                $("#dialogalterarsenha").dialog("open");
                $('#id_adminalterarsenha').val(id);
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
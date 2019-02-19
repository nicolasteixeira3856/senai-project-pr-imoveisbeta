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
?> 
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<meta charset="utf-8">
		<title>Painel de Administração</title>
		<link rel="StyleSheet" href="../../css/style.css">
		<link rel="StyleSheet" href="../../css/bootstrap.css">
		<link rel="stylesheet" href="../../css/jquery-ui.css">
	</head>
	<body>
<style>
@media print{
	.sidenav{
		diplay:none;
	}
}
</style>
		<!-- Conteúdo da página -->
		<ul class="sidenav">
			<a href="../../../../index.php"><img class="logositepainel" src="../../img/logo.png"></a>
			<li><a>Painel do administrador</a></li>
			<li><a href="#" class="tablinks active" onclick="openCity(event, 'home')">Home</a></li>
			<li><a href="#" class="tablinks" onclick="openCity(event, 'cdstcorretor')">Cadastrar Corretor</a></li>
			<li><a href="#" class="tablinks" onclick="openCity(event, 'cdstimovel')">Cadastrar imóvel</a></li>
			<li><a href="#" class="tablinks" onclick="openCity(event, 'gerenciarimovel')">Gerenciar imóveis</a></li>
			<li><a href="#" class="tablinks" onclick="openCity(event, 'gerenciarcorretor')">Gerenciar corretores</a></li>
			<li><a href="../../../../index.php" class="tablinks">Voltar para o site</a></li>
		</ul>
		<div class="tabcontent" id="home">
			<div class="content">
				<h2>Bem-Vindo <?php echo $_SESSION["nome"]?></h2>
			</div>
		</div>
		<div class="tabcontent" id="cdstcorretor">
			<div class="content">
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
								<input type="text" name="nome" id="nome" onkeypress="return Onlychars(event)" onBLur="validanome();" placeholder="*Nome completo..." onChange="limpamsgnome();" class="form-first-name form-control" id="form-first-name" title="Somente Letras." required autofocus>
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
						<input type="text" name="creci" id="creci" onBlur="validacreci();" placeholder="*Creci do corretor..."  onChange="limpamsgcreci();" class="form-first-name form-control"title="Apenas n&#711026;os." pattern="[0-9]+$" maxlength="6" required="required">
						<div id="msgcreci"></div>
					</div>
					<br>
						<button type="submit" class="btn" id="button" value="CONFIRMAR" style="width:65%;">Cadastrar corretor</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<section class="tabcontent" id="cdstimovel">
			<div class="content">
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
		</section>
		<section class="tabcontent" id="gerenciarimovel">
			<div class="content">
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
				<h1 class="page-header">Tabela com todos os Imóveis</h1>
				<div class="table-responsive">	
					<table class="table table-hover">
						<tr>
							<th class="id1">ID</th>
							<th>Finalidade</th>
							<th>Rua</th>
							<th class="cidade1">Cidade</th>
							<th>Bairro</th>
							<th>Negociacao</th>
							<th>Tipo</th>
							<th>Area M2</th>
							<th>Valor</th>
							<th colspan="3" class="gerenciar1">Gerenciar</th>
						</tr>
						
					<?php
						echo "<br>Há ".$listarimv -> rowCount()." imóveis Cadastrados!";
						foreach($listarimv as $lsm){
							echo "
								<tr>
									<td class='id1' id='id_imovel'>".$lsm['id_imovel']."</td>								
									<td>".$lsm['finalidade']."</td>
									<td>".$lsm['rua']."</td>
									<td class='cidade1'>".$lsm['nome_cidade']."</td>
									<td>".$lsm['nome_bairro']."</td>
									<td>".$lsm['tipo_nego']."</td>
									<td>".$lsm['nome_tipo']."</td>
									<td>".$lsm['aream2']."</td>
									<td>".$lsm['valor']."</td>
									<td class='gerenciar1'><form action='editarimv.php' method='POST'><input type='hidden' value=".$lsm['id_imovel']." name='id_imovel'><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span></button></form></td>
									<td class='gerenciar1'><button type='button' class='btn btn-primary' id='btnDelete' onclick='confirmacaodeletarimovel(".$lsm['id_imovel'].")'><span class='glyphicon glyphicon-trash'></span></button></td>
									<td class='gerenciar1'><a href='../../../imovel?id=".$lsm['id_imovel']."'><button type='button' class='btn btn-primary'>Mais</button></a></td>
								</tr>";
						}/*data-whateverid='".$lsm['id_imovel']."' data-whateverTitulo='".$lsm['titulo']."' data-whateverDescricao='".$lsm['descricao']."' data-whateverQuartos='".$lsm['n_quartos']."' data-whateverVagas='".$lsm['n_vagas']."' data-whateverNegociacao='".$lsm['id_imovel']."' data-whateverFinalidade='".$lsm['id_imovel']."' data-whateverValor='".$lsm['valor']."' data-whateverArea='".$lsm['aream2']."'*/
					  echo"</table>";
					?>
					</table>
					<input type="button" name="imprimir" class="btn btn-primary imprimir" align="center" value="Imprimir" onclick="window.print();">
				</div>
			</div>
		</section>
		<section class="tabcontent" id="gerenciarcorretor">
			<div class="content">
				<?php
					
					/*Selecionar as tabelas*/
					
					$sql = "SELECT * FROM Usuario_tb 
					JOIN Cidade_tb ON Usuario_tb.id_cidade = Cidade_tb.id_cidade
					WHERE nivel = 2";
					
					$listarc = $conet -> prepare($sql);
					$listarc -> execute();	
				?>
				<h1 class="page-header">Tabela com todos os Corretores</h1>
				<?php echo "<br>Há ".$listarc -> rowCount()." corretor(es) Cadastrados!"; ?>
				<div class="table-responsive">							
					<table class="table table-hover">
						<tr>
							<th>ID</th>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Cidade</th>
							<th>CPF</th>
							<th>Creci</th>
							<!--<th>Nível</th>-->
							<th colspan="2">Gerenciar</th>
						</tr>
					<?php
						foreach($listarc as $ls){
					?>	
							<tr>
								<td><?php echo $ls['id_usuario']?></td>								
								<td><?php echo $ls['nome']?></td>
								<td><?php echo $ls['email']?></td>
								<td><?php echo $ls['nome_cidade']?></td>
								<td><?php echo $ls['CPF']?></td>
								<td><?php echo $ls['CRECI']?></td>
								
								<td><button type='button' class='btn btn-primary' onclick='abrirmodal("<?php echo $ls['id_usuario']?>","<?php echo $ls['nome']?>","<?php echo $ls['telefone']?>","<?php echo $ls['celular']?>","<?php echo $ls['CRECI']?>");' ><span class='glyphicon glyphicon-edit'></span></button></td>
								<td><button type='button' class='btn btn-primary' onclick='confirmacaodeletar(<?php echo $ls['id_usuario'] ?>)'><span class='glyphicon glyphicon-trash'></span></button></td>
							</tr>
					<?php
						}
					?>
					</table>
					<input type="button" name="imprimir" class="btn btn-primary imprimir" align="center" value="Imprimir" onclick="window.print();">
				</div> 	
			</div>
		</section>
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
		
		<div id="dialogeditcorretor" title="Create new user">
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
					<input type="text" name="telefoneedit" id="telefoneedit" placeholder="*Telefone..."  onkeypress="return valTELEFONE(event,this); return false;"  class="form-first-name form-control wid" id="form-first-name" required="required"  maxlength="13">
				</div>
				<div class="form-group">
					<label for="form-first-name">Celular</label>
					<input type="text" name="celularedit" id="celularedit" placeholder="*Celular..." onkeypress="return valTELEFONE(event,this); return false;"  class="form-first-name form-control wid" id="form-first-name" required="required"  maxlength="14">
				</div>
				<div class="form-group">
					<label for="form-first-name">CRECI</label>
					<input type="text" name="CRECIedit" id="CRECIedit" onkeypress="return Onlynumber(event)" placeholder="CRECI..."  class="form-first-name form-control" title="Somente Letras.">
				</div>
				<br>
				<input type="hidden" id="id_corretoredit">
				<button type="submit" class="btn" id="button"  style="width:65%;">Finalizar Edição</button>
			</form>
		</div>
		
		<!-- /Alert mostrando cadastrado com sucesso -->
		
		<div id="dialogeditcorretor" title="Create new user">
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
					<input type="text" class="form-email form-control" name="valoredit" id="valoredit" placeholder="*Valor"  onkeypress="return Onlynumber(event)" maxlength="15" required>
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
				<button type="submit" class="btn" id="button" style="width:65%;">Finalizar Edição</button>
			</form>
		</div>
		<!-- JavaScript -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../js/jquery-ui.js"></script>
		<script src="../../js/script.js"></script>
		<script src="../../js/validacao.js"></script>

		<script src="../../js/jquery.maskMoney.js"></script>
		<script>
		
			/* Oculta section */ 
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
			            $('#modalcorretor').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) // Button that triggered the modal
              var idcorretor = button.data('whateverid') // Extract info from data-* attributes
              var nome = button.data('whatevernome') // Extract info from data-* attributes
              var email = button.data('whateveremail') // Extract info from data-* attributes
              var senha = button.data('whateversenha') // Extract info from data-* attributes
              // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
              // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
              var modal = $(this)
              modal.find('#id-corretor').val(idcorretor);
              modal.find('#nome').val(nome);
              modal.find('#email').val(email);
              modal.find('#senhabanco').val(senha);

            });            
            
            
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
			$(document).ready(function(){
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
					var senha=$('#senha1').val();
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
			]
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

			
			$( function() {
				$( "#dialogcdstimoveis" ).dialog({/*Cria a funçao de dialogo do jquery*/
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
			function abrirmodal(id,nome,telefone,celular,creci){
				
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
				$('#editcorretor').submit(function(){
					var id_imovel	=$('#id_imoveisedit').val();
					var titulo		=$('#tituloedit').val();
					var descricao	=$('#descricaoedit').val();
					var valor		=$('#valoredit').val();
					var area		=$('#areaedit').val();
					var nvagas		=$('#nvagasedit').val();
					$.ajax({
						url:"CRUD/editar_imovel.php",
						type:"POST",
						data: "id_imovel="+id_imovel+"&titulo="+titulo+"&descricao="+descricao+"&valor="+valor+"&area="+area+"&nvagas="+nvagas,
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
		</script>

	</body>	
</html>	
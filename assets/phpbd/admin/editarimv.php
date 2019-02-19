<?php
	
	if( !empty($_GET)){
		include_once "../connection.php";
		
		$id_imovel = $_GET['id_imovel'];
		
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
        <title>Editando imóvel</title>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../../css/bootstrap.css" rel="stylesheet">
		<link rel="StyleSheet" href="../../css/style.css">
		<link rel="stylesheet" href="../../css/jquery-ui.css">
	</head>
	<body>
		<div class="colorbck" style="border-bottom:0px; margin-top:0px;">
			<br>
            <a href="../../../index.php"><img class="headlogo" src="../../img/logo.png"></a>
			<br>
			<br>
        </div>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">	
					<h2>Editando imóvel de ID <?php echo $id_imovel ?></h2>
					<h2><a href="admin">Voltar ao painel</a></h2><br>
					<?php 
			            $sql = "SELECT * FROM Imoveis_tb
							JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
							WHERE Imoveis_tb.id_imovel = '$id_imovel'
							";
						
						$listar = $conet -> prepare($sql);
						$listar -> execute();
						
						$sqlfoto = "SELECT * FROM Foto_tb WHERE id_imovel = '$id_imovel'";
						
						$listarfoto = $conet -> prepare($sqlfoto);
						$listarfoto -> execute();
						
						foreach($listar as $lms){}
			            
			            echo "
							<div align='center'>
								<h1>Perfil</h1><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>Titulo:</label> <br>".$lms['titulo']."</span> 
									<br><br><a onclick='openalterartitulo(".$id_imovel.")'>ALTERAR</a><br>
								</div><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>Descrição:</label> <br>".$lms['descricao']."</span> 
									<br><br><a onclick='openalterardescricao(".$id_imovel.")'>ALTERAR</a><br>
								</div><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>Área:</label> <br>".$lms['aream2']."</span>
									<br><br><a onclick='openalterararea(".$id_imovel.")'>ALTERAR</a><br>
								</div><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>Numero de Vagas:</label> <br>".$lms['n_vagas']."</span> 
									<br><br><a onclick='openalterarnvaga(".$id_imovel.")'>ALTERAR</a><br>
								</div><br>
								<div style='border-bottom: 1px solid black; padding-bottom:20px;'>
									<span><label>Foto Principal:</label> <br><img class='img-rounded' src='../../img/fotosimoveis/".$lms['foto_principal']."' alt='Destaque1' width='150px' height='100px'> </span>
									<br><br><a onclick='openalterarfotoprin(".$id_imovel.")'>ALTERAR</a><br><br>
								";
								foreach($listarfoto as $lsfoto){
									echo"
											<span><label>Foto Secundaria:</label> <br><img class='img-rounded' src='../../img/fotosimoveis/".$lsfoto['img']."' alt='Destaque1' width='150px' height='100px'> </span>
											<br><br><a onclick='openalterarfotosegun(".$lsfoto['id_foto'].",".$id_imovel.")'>ALTERAR</a><br><br>
										";
								}
							echo"</div><br>
							</div>
							";
			            
			        ?>
				</div>
				<div class="col-md-3">
				</div>
			</div>
		</div><br>
		
		<!-- Modal alterar titulo -->
		<div id="dialogalterartitulo" title="Alterar Titulo">
			<h2>Formulario de alteração do titulo</span></h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterartitulo" id="alterartitulo" method="POST" class="registration-form" action="CRUD/editar_imovel">
				<div class="form-group">
					<input type="text" name="titulo" id="tituloalterar" placeholder="*Titulo..." class="form-first-name form-control wid" required>
    			</div>
				<br>
				<input type="hidden" id="id_alterartitulo" name="id_imovel">
				<input type="hidden" id="tipoetitulo" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		<!-- Modal alterar descricao -->
		<div id="dialogalterardescricao" title="Alterar Descrição">
			<h2>Formulario de alteração do descrição</h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterardescricao" id="alterardescricao" method="POST" class="registration-form" action="CRUD/editar_imovel">
				<div class="form-group">
					<input type="text" name="descricao" id="descricaoalterar" placeholder="*Descrição..." class="form-first-name form-control wid" required>
    			</div>
				<br>
				<input type="hidden" id="id_alterardescricao" name="id_imovel">
				<input type="hidden" id="tipoedescricao" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
 
		<!-- Modal alterar area -->
		<div id="dialogalterararea" title="Alterar Área">
			<h2>Formulario de alteração do Área </h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterararea" id="alterararea" method="POST" class="registration-form" action="CRUD/editar_imovel">
				<div class="form-group">
					<input type="text" name="area" id="areaalterar" placeholder="*Área..." class="form-first-name form-control wid" required>
    			</div>
				<br>
				<input type="hidden" id="id_alterararea" name="id_imovel">
				<input type="hidden" id="tipoearea" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		<!-- Modal alterar Numero de Vagas -->
		<div id="dialogalterarnvaga" title="Alterar Numero de Vagas">
			<h2>Formulario de alteração do Numero de Vagas </h2>
			<h5>Preencher todos os campos</h5>
		 
			<form role="form" name="alterarnvaga" id="alterarnvaga" method="POST" class="registration-form" action="CRUD/editar_imovel">
				<div class="form-group">
					<input type="text" name="nvaga" id="telefonenvaga" placeholder="*Numero de Vagas..." class="form-first-name form-control wid" required>
    			</div>
				<br>
				<input type="hidden" id="id_alterarnvaga" name="id_imovel">
				<input type="hidden" id="tipoenvaga" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		<!-- Modal alterar Foto Principal -->
		<div id="dialogalterarfotoprin" title="Alterar Foto Principal">
			<h2>Formulario de alteração do Foto Principal</h2>
			<h5>Escolha uma nova foto ou clique em uma das fotos abaixo para escolher como principal</h5>
		 
			<form role="form" name="alterarfotoprin" id="alterarfotoprin" method="POST" class="registration-form" action="CRUD/editar_imovel" enctype="multipart/form-data">
				<div class="form-group">
					<input type="file" class="form-first-name form-control wid" id="foto" name="foto" required>
    			</div>
				<style>
				
					#fotoescolher:hover{
						
						border: 3px solid blue;
						border-radius:20px 20px;
					}
				</style>
				<?php
					
					$sqlfotos = "SELECT * FROM Foto_tb WHERE id_imovel = '$id_imovel'";
					
					$listarfotos = $conet -> prepare($sqlfotos);
					$listarfotos -> execute();
				
					foreach($listarfotos as $lsfotos){
						echo"
								<a onclick='escolherfoto(".$id_imovel.",".$lsfotos['id_foto'].")'><img id='fotoescolher' src='../../img/fotosimoveis/".$lsfotos['img']."' alt='Destaque1' width='150px' height='100px'></a>
							";
					}
				
				?>
				<br><br><br>
				<input type="hidden" id="id_fotoprinalterar" name="id_imovel">
				<input type="hidden" id="tipoefotoprin" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		
		<!-- Modal alterar Foto Secundaria -->
		<div id="dialogalterarfotosegun" title="Alterar Foto Secundaria">
			<h2>Formulario de alteração da Foto Secundaria</h2>
			<h5>Escolha uma nova foto</h5>
		 
			<form role="form" name="alterarfotosegun" id="alterarfotosegun" method="POST" class="registration-form" action="CRUD/editar_imovel" enctype="multipart/form-data">
				<div class="form-group">
					<input type="file" class="form-first-name form-control wid" id="foto" name="foto" required>
    			</div>
				<br>
				<input type="hidden" id="id_fotosegunalterar" name="id_foto">
				<input type="hidden" id="id_imovelalterarfotosegun" name="id_imovel">
				<input type="hidden" id="tipoefotosegun" name="tipoe">
				<button type="submit" class="btn" id="button" style="width:100%;">Enviar</button>
			</form>
		</div>
		
		<!-- Alert mostrando cadastrado com sucesso -->
		<div id="dialog" title="Editado com sucesso!!">
			<p style="color:green;">
				Editado com sucesso!!
			</p>
			<p>
				Clique em ok para continuar.
			</p>
		</div>
		<!-- /Alert mostrando cadastrado com sucesso -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../../assets/js/jquery.min.js"><\/script>')</script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/script.js"></script>
		<script src="../../js/cdst.js"></script>
		<script src="../../js/cdstimovel.js"></script>
		<script src="../../js/cidades.js"></script>
		<script src="../../js/jquery-ui.js"></script>
		<script src="../../js/jquery.maskMoney.js" type="text/javascript"></script>
		<script>
			/*Mascara do valor com R$*/
			$(function(){
				$("#valor").maskMoney({symbol:'R$ ', 
				showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
			})
			
			/*Script para enviar o form do cadastro de imovel*/
			$(document).ready(function(){
				$('#logeditimv').hide();
				$('#editarimoveis').submit(function(){
					var id_imovel	=$('#id_imovel').val();
					var titulo		=$('#titulo').val();
					var descricaoo	=$('#descricaoo').val();
					var valor		=$('#valor').val();
					var area		=$('#area').val();
					var nquarto		=$('#nquarto').val();
					var nvaga		=$('#nvaga').val();

					$.ajax({
						url:"CRUD/editar_imoveis.php",
						type:"POST",
						data: "id_imovel="+id_imovel+"&titulo="+titulo+"&descricaoo="+descricaoo+"&valor="+valor+"&area="+area+"&nquarto="+nquarto+"&nvaga="+nvaga,
						dataType: "json",
						beforeSend: function(){
                            $('#logeditimv').show();
							$('#logeditimv').text('Validando...');
							$('#logeditimv').css('color', 'blue');
                        },
						success: function (result){
							if(result.codigo == 0){
							    $( "#dialog" ).dialog( "open" );
							}else if(result.codigo != 0){
								$('#logeditimv').show();
								$('#logeditimv').text(result.msg);
								$('#logeditimv').css('color', 'red');
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
							location.href='admin.php';
						}
					}
				});
			});
			
			/*script para os alterar*/
			
			function openalterartitulo(id){
                
                $("#dialogalterartitulo").dialog("open");
                $('#id_alterartitulo').val(id);
				$('#tipoetitulo').val("titulo");
            }
			function openalterardescricao(id){
                
                $("#dialogalterardescricao").dialog("open");
                $('#id_alterardescricao').val(id);
				$('#tipoedescricao').val("descricao");
            }
			function openalterararea(id){
                
                $("#dialogalterararea").dialog("open");
                $('#id_alterararea').val(id);
                $('#tipoearea').val("area");
            }
			function openalterarnvaga(id){
                
                $("#dialogalterarnvaga").dialog("open");
                $('#id_alterarnvaga').val(id);
				$('#tipoenvaga').val("nvaga");
            }
			function openalterarfotoprin(id){
                
                $("#dialogalterarfotoprin").dialog("open");
                $('#id_fotoprinalterar').val(id);
				$('#tipoefotoprin').val("fotoprin");
            }
			function openalterarfotosegun(id_foto,id_imovel){
                
                $("#dialogalterarfotosegun").dialog("open");
                $('#id_fotosegunalterar').val(id_foto);
                $('#id_imovelalterarfotosegun').val(id_imovel);
				$('#tipoefotosegun').val("fotosegun");
            }
			
			/*Script para abrir os modais*/
			$( function() {
				$( "#dialogalterartitulo" ).dialog({
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
						$("#dialogalterartitulo").dialog( "close" );
						}
					}
				});
			});
			$( function() {
				$( "#dialogalterardescricao" ).dialog({
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
						$("#dialogalterardescricao").dialog( "close" );
						}
					}
				});
			});
			$( function() {
				$( "#dialogalterararea" ).dialog({
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
						$("#dialogalterararea").dialog( "close" );
						}
					}
				});
			});
			$( function() {
				$( "#dialogalterarnvaga" ).dialog({
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
						$("#dialogalterarnvaga").dialog( "close" );
						}
					}
				});
			});
			$( function() {
				$( "#dialogalterarfotoprin" ).dialog({
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
						$("#dialogalterarfotoprin").dialog( "close" );
						}
					}
				});
			});
			$( function() {
				$( "#dialogalterarfotosegun" ).dialog({
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
						$("#dialogalterarfotosegun").dialog( "close" );
						}
					}
				});
			});	
			
			function escolherfoto(id_imovel,id_foto){
				
				window.location.assign('CRUD/editar_imovel?id_imovel='+id_imovel+'&id_foto='+id_foto);
				
			}
			
		</script>
	</body>
</html>	
<?php
	}else{
		echo "<script>alert('Falha em tentar editar o imóvel: Falta de dados.');</script>";
		echo "<script>window.location.assign('admin');</script>";
	}
?>
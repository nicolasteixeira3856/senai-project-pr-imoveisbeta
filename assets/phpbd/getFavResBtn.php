<?php
	$tipo = $_POST['tipo'];
	@$id_usuario = $_POST['id_usuario'];
	@$id_imovel = $_POST['id_imovel'];
	@$tipo_resquest = $_POST['tipo_resquest'];
	
	include_once'connection.php';
	
	if($tipo == 'getBotao'){
		/*Pega o botao */
		
		/*Listar no banco os favoritos*/				
		$sqllistaf = "SELECT * FROM Favoritos_tb WHERE id_imovel ='$id_imovel' AND id_usuario ='$id_usuario'";

		$listafav = $conet -> prepare($sqllistaf);
		$listafav -> execute();
		
		 /*Listar no banco a reserva*/				
		$sqllistar = "SELECT * FROM Reserva_tb WHERE id_imovel ='$id_imovel' AND id_usuario ='$id_usuario'";

		$listafar = $conet -> prepare($sqllistar);
		$listafar -> execute();
		

		/*verifica os dados do banco e ve qual botao gerar*/
		if($listafav -> rowCount() > 0){
			echo"<a id='btnFavRemover' class='btn btn-default btn-lg colorbck bnimv' onclick='remfav()'><span class='glyphicon glyphicon-heart' aria-hidden='true'></span> Remover dos favoritos</a>";
			if($listafar -> rowCount() > 0){
				echo"<a id='btnResRemover' class='btn btn-default btn-lg colorbck' onclick='remres()'>Cancelar reserva</a><br>";
		
			}else{
			   echo"<a id='btnResAdicionar' class='btn btn-default btn-lg colorbck' onclick='addres()'>Reservar imóvel</a><br>";
			}
		}else{
			echo"<a id='btnFavAdicionar' class='btn btn-default btn-lg colorbck bnimv' onclick='addfav()'><span class='glyphicon glyphicon-heart-empty' aria-hidden='true'></span> Adicionar aos Favoritos</a>";
			if($listafar -> rowCount() > 0){
				echo"<a id='btnResRemover' class='btn btn-default btn-lg colorbck' onclick='remres()'>Cancelar reserva</a><br>";
		
			}else{
			   echo"<a id='btnResAdicionar' class='btn btn-default btn-lg colorbck' onclick='addres()'>Reservar imóvel</a><br>";
			}
		}
		
		
	}else if($tipo == 'getFav'){
		
		/*verficia se adiciona ou remove dos favoritos*/
		
		if($tipo_resquest == 'adicionar'){
			
			/*Comando para trazer o favorito segundo o imovel e o usuario*/
			$sqlfav = "SELECT * FROM Favoritos_tb WHERE id_imovel = $id_imovel AND id_usuario = $id_usuario";
			
			$fav = $conet -> prepare($sqlfav);
			$fav -> execute();
			
			/*Verifica se o imovel esta favoritado por esse cliente*/
			if($fav -> RowCount() == 1){
				
				$retorno = array('codigo' => 1,'msg' => 'Ja favoritado');
				echo json_encode($retorno);
				exit;
				
			}else{
				/*Cadastrar no banco*/				
				$sql = "INSERT INTO Favoritos_tb(id_imovel,id_usuario) VALUES (?,?)";

				$adcfav = $conet -> prepare($sql);
				$adcfav -> execute(array($id_imovel,$id_usuario));
				
				
				if($adcfav -> rowCount() == 1){
					$retorno = array('codigo' => 0,'msg' => 'Adicionado com sucesso');
					echo json_encode($retorno);
					exit;
				}else{
					$retorno = array('codigo' => 1,'msg' => 'Erro ao adcionar');
					echo json_encode($retorno);
					exit;
				}
			}
			
			
		}else if($tipo_resquest == 'remover'){
			
			/*Cadastrar no banco*/				
			$sql = "DELETE FROM Favoritos_tb WHERE id_imovel = (?) AND id_usuario = (?)";

			$remfav = $conet -> prepare($sql);
			$remfav -> execute(array($id_imovel,$id_usuario));
			
			if($remfav -> rowCount() == 1){
				$retorno = array('codigo' => 0,'msg' => 'Removido com sucesso');
				echo json_encode($retorno);
				exit;
			}else{
				$retorno = array('codigo' => 1,'msg' => 'Erro ao Remover');
				echo json_encode($retorno);
				exit;
			}
			
		}else{
			
			
		}
		
	}else if($tipo == 'getRes'){
		
		/*verficia se adiciona ou remove da reserva*/
		
		if($tipo_resquest == 'adicionar'){
			
			/*Comando para trazer a reserva segundo o imovel e o usuario*/
			$sqlres = "SELECT * FROM Reserva_tb WHERE id_usuario = $id_usuario AND id_imovel = $id_imovel";
			
			$res = $conet -> prepare($sqlres);
			$res -> execute();
			
			
			/*Verifica se o imovel esta reservado por esse cliente*/
			if($res -> RowCount() == 1){
				
				$retorno = array('codigo' => 1,'msg' => 'Ja reservado');
				echo json_encode($retorno);
				exit;
				
			}else{
				/*Cadastrar no banco*/				
				$sql = "INSERT INTO Reserva_tb(id_usuario,id_imovel) VALUES (?,?)";

				$adcres = $conet -> prepare($sql);
				$adcres -> execute(array($id_usuario,$id_imovel));
				
				if($adcres -> rowCount() == 1){
					$retorno = array('codigo' => 0,'msg' => 'Adicionado com sucesso');
					echo json_encode($retorno);
					exit;
				}else{
					$retorno = array('codigo' => 1,'msg' => 'Erro ao adcionar');
					echo json_encode($retorno);
					exit;
				}
			}
			
			
			
			
		}else if($tipo_resquest == 'remover'){
			
			/*Cadastrar no banco*/				
			$sql = "DELETE FROM Reserva_tb WHERE id_imovel = (?) AND id_usuario = (?)";

			$remres = $conet -> prepare($sql);
			$remres -> execute(array($id_imovel,$id_usuario));
			
			if($remres -> rowCount() == 1){
				$retorno = array('codigo' => 0,'msg' => 'Removido com sucesso');
				echo json_encode($retorno);
				exit;
			}else{
				$retorno = array('codigo' => 1,'msg' => 'Erro ao Remover');
				echo json_encode($retorno);
				exit;
			}
			
		}else{
			
			
		}
		
	}else{
		
		
	}
?>
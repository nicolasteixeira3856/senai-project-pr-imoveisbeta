<?php 

	$id_imovel = $_REQUEST['id_imovel'];
	$id_usuario = $_REQUEST['id_usuario'];
	$tipo = $_REQUEST['tipo'];
	$tipo_request = $_REQUEST['tipor'];
	
	include_once 'conexao.php';
	
	if($tipo == "fav"){
		
		if($tipo_request =="add"){
		
			$sqladd = "INSERT INTO Favoritos_tb(id_imovel,id_usuario) VALUES (?,?)";
		
			$addfav = $conet -> prepare($sqladd);
			$addfav -> execute(array($id_imovel,$id_usuario)); 
			
			if($addfav -> RowCount() == 1){
				echo"ok";
			}else{
				echo"erro";
			}
		} else if ($tipo_request =="rem"){
			
			$sqlrem = "DELETE FROM Favoritos_tb WHERE id_imovel = (?) AND id_usuario = (?)";

			$remfav = $conet -> prepare($sqlrem);
			$remfav -> execute(array($id_imovel,$id_usuario)); 
			
			if($remfav -> RowCount() == 1){
				echo"removerfav";
			}else{
				echo"erro";
			}
		} 
	} else if($tipo == "res"){
	
		if($tipo_request =="add"){
			
			$sqladd = "INSERT INTO Reserva_tb(id_usuario,id_imovel) VALUES (?,?)";
		
			$addres = $conet -> prepare($sqladd);
			$addres -> execute(array($id_usuario,$id_imovel)); 
			
			if($addres -> RowCount() == 1){
				echo"ok";
			}else{
				echo"erro";
			}
		} else if($tipo_request =="rem"){
			
			$sqlrem = "DELETE FROM Reserva_tb WHERE id_usuario = (?) AND id_imovel = (?)";
			
			$remres = $conet -> prepare($sqlrem);
			$remres -> execute(array($id_usuario,$id_imovel));
			
			if($remres -> RowCount() == 1){
				echo"removerres";
			}else{
				echo"erro";
			} 
		}
	}else{
		echo "erro";
	}
<?php
	include_once 'conexao.php';
	
	/*Pega as variaveis enviados do app*/
	$id_imovel = $_REQUEST['id_imovel'];
	$id_usuario = $_REQUEST['id_usuario'];
	
	/*Cria o array*/
	$json_data = array(); 
	
	
	/*Comando para trazer o favorito segundo o imovel e o usuario*/
	$sqlfav = "SELECT * FROM Favoritos_tb WHERE id_imovel = $id_imovel AND id_usuario = $id_usuario";
	
	$fav = $conet -> prepare($sqlfav);
	$fav -> execute();
	
	/*Verifica se o imovel esta favoritado por esse cliente*/
	if($fav -> RowCount() == 1){
		
		$json_array['favorito'] = "favoritado";
		
	}else{
		$json_array['favorito'] = "nao favoritado";
	}
	
	
	/*Comando para trazer a reserva segundo o imovel e o usuario*/
	$sqlres = "SELECT * FROM Reserva_tb WHERE id_usuario = $id_usuario AND id_imovel = $id_imovel";
	
	$res = $conet -> prepare($sqlres);
	$res -> execute();
	
	
	/*Verifica se o imovel esta reservado por esse cliente*/
	if($res -> RowCount() == 1){
		
		$json_array['reserva'] = "reservado";
		
	}else{
		$json_array['reserva'] = "nao reservado";
	}
	
	/*Adiciona os valores ao array*/
    array_push($json_data, $json_array);
	
    /*Converte os dados no formato JSON*/
    echo json_encode(array("Imoveis" => $json_data));
	
?>
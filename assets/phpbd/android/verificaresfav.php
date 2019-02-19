<?php
	$id_imovel = $_REQUEST['id_imovel'];
	$id_usuario = $_REQUEST['id_usuario'];
	
	include_once 'conexao.php';
	
	/*Comando para trazer o favorito segundo o imovel e o usuario*/
	$sqlfav = "SELECT * FROM Favoritos_tb WHERE id_imovel = $id_imovel AND id_usuario = $id_usuario";
	
	$fav = $conet -> prepare($sqlfav);
	$fav -> execute();
	
	/*Verifica se o imovel esta favoritado por esse cliente*/
	if($fav -> RowCount() == 1){
		echo"imovel_jafav,";
	} else { 
		echo"imovel_nofav,";
	}
	
	/*Comando para trazer a reserva segundo o imovel e o usuario*/
	$sqlres = "SELECT * FROM Reserva_tb WHERE id_usuario = $id_usuario AND id_imovel = $id_imovel";
	$res = $conet -> prepare($sqlres);
	$res -> execute();
	
	/*Verifica se o imovel esta reservado por esse cliente*/
	if($res -> RowCount() == 1){
		echo "imovel_jares";
	} else { 
		echo "imovel_nores";
	}
?>
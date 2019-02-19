<?php

	include_once "../../connection.php";
	
	/*Variaveis para editar*/
	
	$id_imovel  = $_POST['id_imovel'];
	$titulo     = $_POST['titulo'];
	$descricao  = $_POST['descricaoo'];
	$valor      = $_POST['valor'];
	$area		= $_POST['area'];
	$n_quartos  = $_POST['nquarto'];
	$n_vagas    = $_POST['nvaga'];	
	
	if($n_quartos == 'undefined'){
		$n_quartos = 0;
	}
	
	if($n_vagas == 'undefined'){
		$n_vagas = 0;
	}
	
	$sqledit = "UPDATE Imoveis_tb SET
			titulo  	= '$titulo',
			descricao  	= '$descricao',
			valor 		= '$valor',
			aream2 		= '$area',
			n_quartos 	= '$n_quartos',
			n_vagas 	= '$n_vagas'
			WHERE 
			id_imovel 	= '$id_imovel'";
			
	$editar = $conet -> prepare($sqledit);
	
	if($editar -> execute()){
		$retorno = array('codigo' => 0,'msg' => 'Editado com sucesso');
		echo json_encode($retorno);
		exit;
	}else{
		$retorno = array('codigo' => 1,'msg' => 'Erro ao editar');
		echo json_encode($retorno);
		exit;
	}
	
?>
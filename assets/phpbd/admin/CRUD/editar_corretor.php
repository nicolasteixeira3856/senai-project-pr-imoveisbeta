<?php
	
	include_once "../../connection.php";
	
	$id_corretor    = $_POST['id_corretor'];
	$nome           = $_POST['nome'];
	$telefone       = $_POST['telefone'];
	$celular        = $_POST['celular'];
	$CRECI          = $_POST['CRECI'];
	
	
	/*Editar a tabela usuarios_tb*/
	$sql = "UPDATE Usuario_tb SET
		nome  		= '$nome',
		telefone 	= '$telefone',
		celular 	= '$celular',
		CRECI 		= '$CRECI'
		WHERE 
		id_usuario 	= '$id_corretor'
	";		

	$editar = $conet -> prepare($sql);
	
	if($editar -> execute()){
		$retorno = array('codigo' => 0,'msg' => 'Editado com sucesso');
		echo json_encode($retorno);
		exit;
	}else{
		$retorno = array('codigo' => 1,'msg' => 'Falha ao editar');
		echo json_encode($retorno);
		exit;
	}
	
?> 
<?php

	include_once "../../../phpbd/connection.php";
	
	$id_cliente     = $_POST['id_cliente'];
	$id_corretor    = $_POST['id_corretor'];
	$nome           = $_POST['nome'];
	$email          = $_POST['email'];
	$telefone       = $_POST['telefone'];
	$mensagem       = $_POST['mensagem'];
	
	
	$sqllista = "SELECT * FROM ContatoCorretor_tb WHERE id_cliente = '$id_cliente'";
	
	$listar = $conet -> prepare($sqllista);
	$listar -> execute();
	
	/*Verificar se ele ja esta sendo atendido*/
	if($listar -> rowCount() == 1){
		
		$retorno = array('codigo' => 1,'msg' => 'Você ja esta sendo atendido por outro corretor');
		echo json_encode($retorno);
		exit;
		
	}else if($listar -> rowCount() == 0){
		$sqlcontato = "INSERT INTO ContatoCorretor_tb(id_cliente,id_corretor,nome,email,telefone,mensagem) VALUES (?,?,?,?,?,?)";
	
		$contactar = $conet -> prepare($sqlcontato);
		$contactar -> execute(array($id_cliente, $id_corretor,$nome,$email,$telefone,$mensagem));
		
		$retorno = array('codigo' => 0,'msg' => 'Enviado com sucesso');
		echo json_encode($retorno);
		exit;
	}else{
	    
	    $retorno = array('codigo' => 2,'msg' => 'Contate um administrador');
		echo json_encode($retorno);
		exit;
	    
	}
?>
<?php
	
	if(!empty($_GET)){
		$id = $_GET['id'];
		
		include_once '../../connection.php';
		
		$sqldeletar = "DELETE FROM Usuario_tb WHERE id_usuario = $id";
		
		$deletar = $conet -> prepare($sqldeletar);
		$deletar -> execute();
		
		session_start();
		session_destroy();
		
		echo"<script>alert('Conta excluida com sucesso');</script>";
		echo "<script>window.location.assign('../../../../index');</script>";
	}else{
		echo"<script>alert('Falta de dados');</script>";
		echo "<script>window.location.assign('../../../../index');</script>";
	}

?>
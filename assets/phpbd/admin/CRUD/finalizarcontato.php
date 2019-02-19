<?php
	
	include_once "../../../phpbd/connection.php";
	
	$id_atendimento  = $_GET['id'];
		
	$sql = "DELETE FROM atendimentos_tb WHERE id_atendimento = (?)";
	
	$deletar = $conet -> prepare($sql);
	$deletar -> execute(array($id_atendimento));
	
	echo "<script>alert('Deletado com sucesso');</script>";
	echo "<script>window.location.assign('../admin');</script>";
	
?>
<?php
	$id = $_GET['id'];
	
	include_once '../../connection.php';
	
	$sql = "DELETE FROM ContatoCorretor_tb WHERE id_contato = $id";
	
	$deletar = $conet -> prepare($sql);
	
	if($deletar -> execute()){
		echo "<script>alert('Finalizado com sucesso');</script>";
		echo "<script>window.location.assign('../corretor');</script>";
        
	}else{
		echo "<script>alert('Falha ao excluir');</script>";
        echo "<script>window.location.assign('../corretor');</script>";
        
	}

?>
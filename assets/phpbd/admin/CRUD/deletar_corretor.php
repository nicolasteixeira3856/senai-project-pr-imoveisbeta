<?php
	include_once "../../connection.php";
	
	$id = $_GET['id'];
	$sql = 'DELETE FROM Usuario_tb WHERE id_usuario = (?)';
	$deletar = $conet -> prepare($sql);
        $deletar -> execute(array($id));

	echo "<script>alert('Deletado com sucesso');</script>";
	echo "<script>window.location.assign('../admin.php');</script>";

?>		
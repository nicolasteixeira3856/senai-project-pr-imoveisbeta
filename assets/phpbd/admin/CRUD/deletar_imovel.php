<?php
	include_once "../../connection.php";
	
	$id = $_GET['id'];
	$sql = 'DELETE FROM Imoveis_tb WHERE id_imovel = (?)';
	$deletar = $conet -> prepare($sql);
        $deletar -> execute(array($id));

	echo "<script>alert('Deletado com sucesso');</script>";
	echo "<script>window.location.assign('../admin.php');</script>";
?>		
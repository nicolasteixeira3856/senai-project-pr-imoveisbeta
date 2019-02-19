<?php
	include_once "../../connection.php";
	
	$id_cidade = $_POST['id_cidade'];
	
	$sql ="SELECT * FROM Bairro_tb WHERE id_cidade = $id_cidade ORDER BY nome_bairro ASC";
	
	$listabairro = $conet -> prepare($sql);
	$listabairro -> execute();
	
	foreach($listabairro as $lsb){
		echo "<option value=".$lsb['id_bairro'].">".$lsb['nome_bairro']."</option> ";
	}
?>
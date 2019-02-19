<?php
	
	$valor = $_GET['valor'];
	
	$tirar = array("R$", ".", " ");
	$valor = str_replace($tirar, "", $valor);
	
	$valor = str_replace(",", ".", $valor);
	
	$valoru = number_format($valor, 2, ',', '.');
	
	echo "Tipo para o banco: ".$valor."<br>";
	echo "Tipo para o usuario: R$ ".$valoru."<br>";

?>
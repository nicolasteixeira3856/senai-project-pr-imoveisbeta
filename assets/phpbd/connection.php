<?php
//conexão com o BD
	try{
		$conet = new PDO("mysql:host=ctbarmc-imobiliariabeta.com.br.mysql;dbname=ctbarmc_imobiliariabeta_com_br","ctbarmc_imobiliariabeta_com_br","ficizo",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	catch(PDOExeception $e){
		echo $e->getMessage();
	}
?>
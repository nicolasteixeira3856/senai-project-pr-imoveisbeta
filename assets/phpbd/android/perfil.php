<?php 
	
	include_once 'conexao.php';
	
	$id_usuario = $_POST['id_usuario'];
	
	$sqlperfil = "SELECT * FROM Usuario_tb WHERE id_usuario = '$id_usuario'";
	
	$listaperfil = $conet -> prepare($sqlperfil);
	$listaperfil -> execute();
	
	if($listaperfil -> RowCount() == 1){
		echo "perfil_ok,";
		
		foreach($listaperfil as $lsp){
			
			echo $lsp['nome'].",".$lsp['email'].",".$lsp['CPF'].",".$lsp['telefone'].",".$lsp['celular'].",".$lsp['senha'] ;
		
		}
		
	}else{
		echo "Erro_perfil";
	}



?>
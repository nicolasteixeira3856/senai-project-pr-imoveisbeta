<?php
	
	include_once'conexao.php';

	$id_usuario = $_POST['id_usuario'];
	$nome 		= $_POST['nome'];
	$email 		= $_POST['email'];
	$telefone 	= $_POST['telefone'];
	$celular 	= $_POST['celular'];
	
	$pattern='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';  
	/*Valida o email*/
	if(preg_match($pattern,$email)){
		
		/*Valida o telefone*/
		if(strlen($telefone) < 10 || (strlen($telefone) > 16)){
			
			echo "telefone_erro";
			
		}else{
			
			/*Valida o telefone*/
			if(strlen($celular) < 10 || (strlen($celular) > 16)){
				echo "celular_erro";
			}else{
				if($senha == ""){
					
					$sql = "UPDATE Usuario_tb SET
					nome 		= '$nome',
					email 		= '$email',
					telefone 	= '$telefone',
					celular 	= '$celular'
					WHERE 
					id_usuario = '$id_usuario'
					";
					
					$editar = $conet -> prepare($sql);
					$editar -> execute();
					
					if($editar -> RowCount() == 1){
						
						echo"ok"; 
						
					}else{
						echo"falha"; 
					}
				}
			}
		}
	}else{
		echo "email_erro";	
	}

?>
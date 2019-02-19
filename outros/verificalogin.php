<?php
	include_once '../assets/phpbd/connection.php';

	
	if(isset($_POST['login']) && isset($_POST['senha'])){
		session_start();
		$login = $_POST['login'];
		$senha = md5($_POST['senha']);
		if(!empty($senha) && !empty($login)){
			
			$sql = "SELECT * FROM usuarios_tb where email = '$login' AND senha = '$senha'";
										
			$listaruser = $conet -> prepare($sql);
			
			$listaruser -> execute();
			
			
			if($listaruser -> rowCount() > 0){
					
				foreach($listaruser as $lgn){
					
					session_start();
					$_SESSION["senha"] = $lgn['senha'];
					$_SESSION["nome"]  = $lgn['Nome'];
					$_SESSION["email"] = $lgn['email'];
					$_SESSION["nivel"] = $lgn['nivel'];
					$_SESSION["id"]    = $lgn['Id_usuario'];
					$_SESSION["Login"] = "YES";
				
				}					
				$retorno =  1;
				echo json_encode($retorno);
				exit();
					
			}else{
				
				$retorno =  0; 
				echo json_encode($retorno);
				exit();
			}
		}else{
			
			$retorno =  0;
			echo json_encode($retorno);
			exit();
		}
	}else{
		
		$retorno =  0;
		echo json_encode($retorno);
		exit();
	}
?>
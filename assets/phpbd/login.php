<?php
	include_once 'connection.php';

	if(isset($_POST['email']) && isset($_POST['senha'])){
		
		session_start();
		
		/*pega os dados via post*/
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		
		/*Pega a senha crypt do bd*/
		$sqls="select * from Usuario_tb where email='".$email."'"; 

		$vsenha = $conet -> prepare($sqls);
		$vsenha -> execute();
		
		foreach($vsenha as $sbd){}

		$senhaBd = $sbd['senha'];
		
		/*Criptografa a senha nova na hash da senha que estava no banco*/
		$senhacrypt = crypt($senha, $senhaBd);
		
		/*Verifica se confere os dados digitado com o que estao no bd*/
		$sql = "SELECT * FROM Usuario_tb where email = '$email' AND senha = '$senhacrypt'";
									
		$listaruser = $conet -> prepare($sql);
		
		$listaruser -> execute();
		
		if($listaruser -> rowCount() == 1){
			foreach($listaruser as $lgn){

				$_SESSION["nome"]  = $lgn['nome'];
				$_SESSION["email"] = $lgn['email'];
				$_SESSION["nivel"] = $lgn['nivel'];
				$_SESSION["id"]    = $lgn['id_usuario'];
				$_SESSION['nomefoto']   = $lgn['foto'];
				$_SESSION["Login"] = "YES";
			}
			
			$retorno = array('codigo' => 1, 'nivel' => $_SESSION["nivel"]);
			echo json_encode($retorno);
			exit;
		}else{
			$retorno = array('codigo' => 2,'msg' => 'Usuario ou senha não encontrados');
			echo json_encode($retorno);
			exit;
		}
	}else{
		$retorno = array('codigo' => 3,'msg' => 'Dados não encontrados');
		echo json_encode($retorno);
		exit;
	}
?>
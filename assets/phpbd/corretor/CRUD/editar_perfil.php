<?php
	
	include_once '../../connection.php';
	
	$tipo = $_POST['tipoe'];
	$id_corretor = $_POST['id_corretor'];
	
	if($tipo == "nome"){
		
		$nome = $_POST['nome'];
		
		$sqlnome = "UPDATE Usuario_tb SET
		nome  		= '$nome'
		WHERE 
		id_usuario 	= '$id_corretor'";
		
		$inserirnome = $conet -> prepare($sqlnome);
		
		if($inserirnome -> execute()){
			
			session_start();
			
			$_SESSION["nome"]	= $nome;
			
			echo "<script>alert('Editado com sucesso');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
		
		}else{
			
			echo "<script>alert('Erro ao fazer a edição');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}
		
	}else if($tipo == 'email'){
		
		$email = $_POST['email'];
		
		$sqlemail = "UPDATE Usuario_tb SET
		email  		= '$email'
		WHERE 
		id_usuario 	= '$id_corretor'";
	
		$inseriremail = $conet -> prepare($sqlemail);
		
		if($inseriremail -> execute()){
			
			echo "<script>alert('Editado com sucesso');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}else{
			
			echo "<script>alert('Erro ao fazer a edição');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}
		
	}else if($tipo == 'telefone'){
		
		$telefone = $_POST['telefone'];
		
		$sqltelefone = "UPDATE Usuario_tb SET
		telefone  		= '$telefone'
		WHERE 
		id_usuario 	= '$id_corretor'";
	
		$inserirtelefone = $conet -> prepare($sqltelefone);
		
		if($inserirtelefone -> execute()){
			
			echo "<script>alert('Editado com sucesso');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}else{
			
			echo "<script>alert('Erro ao fazer a edição');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}
		
	}else if($tipo == 'celular'){
		
		$celular = $_POST['celular'];
		
		$sqlcelular = "UPDATE Usuario_tb SET
		celular  		= '$celular'
		WHERE 
		id_usuario 	= '$id_corretor'";
	
		$inserircelular = $conet -> prepare($sqlcelular);
		
		if($inserircelular -> execute()){
			
			echo "<script>alert('Editado com sucesso');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}else{
			
			echo "<script>alert('Erro ao fazer a edição');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}
		
	}else if($tipo == 'senha'){
		
		$senha = $_POST['senha'];
		
		@$senha = crypt($senha);
		
		$sqlsenha = "UPDATE Usuario_tb SET
		senha  		= '$senha'
		WHERE 
		id_usuario 	= '$id_corretor'";
	
		$inserirsenha = $conet -> prepare($sqlsenha);
		
		if($inserirsenha -> execute()){
			
			echo "<script>alert('Editado com sucesso');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}else{
			
			echo "<script>alert('Erro ao fazer a edição');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}
		
	}else if($tipo == 'foto'){
		
		$foto = $_FILES['foto'];
		$titulo_foto   	= $foto['name'];
		$tmp1         	= $foto['tmp_name'];
		$formato     	= pathinfo($titulo_foto, PATHINFO_EXTENSION);
		$novo_nome    	= uniqid().".".$formato;
		
		if($upload1 = move_uploaded_file($tmp1,'../../../img/fotousers'.'/'.$novo_nome)){
		
			$sqlnome = "UPDATE Usuario_tb SET
			foto  		= '$novo_nome'
			WHERE 
			id_usuario 	= '$id_corretor'";
			
			
			$inserirnome = $conet -> prepare($sqlnome);
			
			if($inserirnome -> execute()){
				
				session_start();
				$_SESSION['nomefoto']   = $novo_nome;
				
				echo "<script>alert('Editado com sucesso');</script>";
				echo "<script>window.location.assign('../corretor');</script>";
				
			}else{
				
				echo "<script>alert('Erro ao fazer a edição');</script>";
				echo "<script>window.location.assign('../corretor');</script>";
				
			}
		}else{
			
			echo "<script>alert('Erro ao fazer a edição');</script>";
			echo "<script>window.location.assign('../admin');</script>";
			
		}
	}else{
		echo "<script>alert('Falta de dados');</script>";
        echo "<script>window.location.assign('../../../cadastrologin');</script>";
	}
	
	
?>
<?php
  include_once 'connection.php';


	$cidade    = $_POST['cidade'];
	$email     = $_POST['email'];
  	$nome      = $_POST['nome'];
    $cpf       = $_POST['cpf'];
    $senha     = $_POST['senha'];
    $semfoto   = "usuario_sfoto.png";
	$telefone  = $_POST['telefone'];
	
	
	/*Buscar CPF*/
	$sqlcpf = "SELECT * FROM Usuario_tb where CPF = '$cpf' ";
										
	$listarusercpf = $conet -> prepare($sqlcpf);
	
	$listarusercpf -> execute();
	
	if($listarusercpf -> rowCount() > 0){
	    
		$retorno = array('codigo' => 1,'msg' => 'CPF Ja cadastrado');
		echo json_encode($retorno);
		exit;
	}
	else{
	    
    	/*Buscar Email*/
    	$sqlemail = "SELECT * FROM Usuario_tb where email = '$email' ";
    										
    	$listaruseremail = $conet -> prepare($sqlemail);
    	
    	$listaruseremail -> execute();
	    
		if($listaruseremail -> rowCount() > 0){
		    
			$retorno = array('codigo' => 2,'msg' => 'Email Ja cadastrado');
    		echo json_encode($retorno);
    		exit;
		}
		else{
		    /*Criptografa a senha*/
		    $senhacrypt = crypt($senha);
		    
			//Insere SQL
			$sql = "INSERT INTO Usuario_tb(id_cidade,email,nome,CPF,senha,foto,nivel,telefone) VALUES (?,?,?,?,?,?,?,?)";
			
			$inserir = $conet -> prepare($sql);
			
			$inserir -> execute(array($cidade,$email,$nome,$cpf,$senhacrypt,$semfoto,3,$telefone));
			
    		/*efetua o login apos o cadastro*/
    		
    		session_start();
    		/*Verifica se confere os dados digitado com o que estao no bd*/
    		$sqllogin = "SELECT * FROM Usuario_tb where email = '$email' AND senha = '$senhacrypt'";
    									
    		$listaruser = $conet -> prepare($sqllogin);
    		
    		$listaruser -> execute();
    		
    		if($listaruser -> rowCount() == 1){
    			foreach($listaruser as $lgn){
    
    				$_SESSION["nome"]  = $lgn['Nome'];
    				$_SESSION["email"] = $lgn['email'];
    				$_SESSION["nivel"] = $lgn['nivel'];
    				$_SESSION["id"]    = $lgn['Id_usuario'];
    				$_SESSION["Login"] = "YES";
    			}
    			
    			
    			$retorno = array('codigo' => 0,'msg' => 'cadastrado com susesso','nivel' => 3);
        		echo json_encode($retorno);
    			exit;
    		}else{
    			$retorno = array('codigo' => 2,'msg' => 'Usuario e senha não encontrados');
    			echo json_encode($retorno);
    			exit;
    		}
			
		}
	}
 ?>
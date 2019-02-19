<?php 
    include_once 'conexao.php';
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
	/*Pega a senha crypt do bd*/
	$sqls="select * from Usuario_tb where email='$email'"; 

	$vsenha = $conet -> prepare($sqls);
	$vsenha -> execute();
	
	foreach($vsenha as $sbd){}

	$senhaBd = $sbd['senha'];
	
	/*Criptografa a senha nova na hash da senha que estava no banco*/
	$senhacrypt = crypt($senha, $senhaBd);
		
    $sql = "SELECT * FROM Usuario_tb WHERE email='$email' and senha='$senhacrypt'";
    
    $listaruser = $conet -> prepare($sql);
		
	$listaruser -> execute();
	
    
    if($listaruser -> rowCount() == 1){
        echo"login_ok";
        echo",";
        foreach($listaruser as $lgn){
				echo $_SESSION["nivel"] = $lgn['nivel'];
				echo ",";
				echo $_SESSION["id_usuario"] = $lgn['id_usuario'];
				echo ",";
				echo $_SESSION["nome"] = $lgn['nome'];
			}
    } else {
        echo"Nada encontrado";
        echo",";
        echo 0;
    }
?>
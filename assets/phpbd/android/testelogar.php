<?php 
    
    
    $nome =         $_POST['nome'];
    $email =        $_POST['email'];
    $telefone =     $_POST['telefone'];
    $senha =        $_POST['senha'];
    $cpf =          $_POST['cpf'];
	
	function validaCPF($cpf = null) {
 
		// Verifica se um número foi informado
		if(empty($cpf)) {
			return false;
		}
	 
		 
		// Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verifica se nenhuma das sequências invalidas abaixo 
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' || 
			$cpf == '11111111111' || 
			$cpf == '22222222222' || 
			$cpf == '33333333333' || 
			$cpf == '44444444444' || 
			$cpf == '55555555555' || 
			$cpf == '66666666666' || 
			$cpf == '77777777777' || 
			$cpf == '88888888888' || 
			$cpf == '99999999999') 
		{
			return false;
		 // Calcula os digitos verificadores para verificar se o
		 // CPF é válido
		} else {   
			 
			for ($t = 9; $t < 11; $t++) {
				 
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}
	 
			return true;
		}
	}
	
	
	if(!validaCPF($cpf)){
		echo "cpf_erro";
	}else{
	
		$pattern='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';  
		
		if(preg_match($pattern,$email)){
			
			if(strlen($telefone) > 15){
				
				echo "telefone_erro";
				
			}else{
			
				if((strlen($senha) < 7) || (strlen($senha) > 10)){
					
					echo "senha_erro";
					
				}else{
					include_once 'conexao.php';
					
					$sqlcpf = "SELECT * FROM Usuario_tb where CPF = '$cpf' ";
					
					$listarusercpf = $conet -> prepare($sqlcpf);
					$listarusercpf -> execute();
					
					if ($listarusercpf -> rowCount() > 0){
						echo "cpf_erro";
					} else {
						
						$sqlemail = "SELECT * FROM Usuario_tb where email = '$email' ";
						$listaruseremail = $conet -> prepare($sqlemail);
						$listaruseremail -> execute();
						
						if($listaruseremail -> rowCount() > 0){
							echo "email_erro";
						} else {
							
							$senhacrypt = crypt($senha);
							$semfoto   = "usuario_sfoto.png";
							
							$sql = "INSERT INTO Usuario_tb(id_cidade,email,nome,CPF,senha,foto,nivel,telefone) VALUES (?,?,?,?,?,?,?,?)";
							$cadastraruser = $conet -> prepare($sql);
							$cadastraruser -> execute(array(1,$email,$nome,$cpf,$senhacrypt,$semfoto,3,$telefone));
							if($cadastraruser -> rowCount() == 1){
							   echo "cadastro_ok";
							}
							else {
							   echo "cadastro_erro";
							}
						}
					}
				}
			}
			
		}else{	
			echo "email_erro";
		}
	}
?>
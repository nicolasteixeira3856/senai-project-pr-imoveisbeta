<?php
	
	include_once "conexao.php";
		
	$email = $_POST['email'];
	
	$pattern='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';  
	/*Valida o email*/
	if(preg_match($pattern,$email)){
	
		$sqlgetemail = "SELECT * FROM Usuario_tb WHERE email = '$email'";
		
		$getemail = $conet -> prepare($sqlgetemail);
		$getemail -> execute();
		
		foreach($getemail as $gte){}
		
		
		$id_cliente = $gte['id_usuario'];
		
		$id_imovel = $_POST['id_imovel'];
		
		$sqlverifica = "SELECT * FROM Reserva_tb WHERE id_usuario = $id_cliente AND id_imovel = $id_imovel";

		$verifica = $conet -> prepare($sqlverifica);
		$verifica -> execute();
		
		if($verifica -> RowCount() > 0){
			
			echo "imovel_jareservado";
			
		}else{
			
			/*Cadastrar no banco*/				
			$sql = "INSERT INTO Reserva_tb(id_usuario,id_imovel) VALUES (?,?)";

			$adcres = $conet -> prepare($sql);
			
			if($adcres -> execute(array($id_cliente,$id_imovel))){
				
				echo "imovel_reservado";
				
			}else{
				
				echo "falha_reservar";
				
			}
			
		}
	}else{
		
		echo "email_erro";
		
	}
?>
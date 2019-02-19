<?php
	
	include_once "../../connection.php";
		
	$email = $_POST['email'];

	
	$sqlgetemail = "SELECT * FROM Usuario_tb WHERE email = '$email'";
	
	$getemail = $conet -> prepare($sqlgetemail);
	$getemail -> execute();
	
	foreach($getemail as $gte){}
	
	
	$id_cliente = $gte['id_usuario'];
	
	$id_imovel = $_POST['id_imovel'];
	
	
	/*Cadastrar no banco*/				
	$sqlverifica = "SELECT * FROM Reserva_tb WHERE id_usuario = $id_cliente AND id_imovel = $id_imovel";

	$verifica = $conet -> prepare($sqlverifica);
	$verifica -> execute();
	
	if($verifica -> RowCount() > 0){
		
		echo "<script>alert('Cliente ja resevou esse imovel');</script>";
		echo "<script>window.location.assign('../corretor');</script>";
		
	}else{
		
		/*Cadastrar no banco*/				
		$sql = "INSERT INTO Reserva_tb(id_usuario,id_imovel) VALUES (?,?)";

		$adcres = $conet -> prepare($sql);
		
		if($adcres -> execute(array($id_cliente,$id_imovel))){
			
			echo "<script>alert('Reservado com sucesso');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}else{
			
			echo "<script>alert('Falha ao realizar a reserva');</script>";
			echo "<script>window.location.assign('../corretor');</script>";
			
		}
		
	}
?>
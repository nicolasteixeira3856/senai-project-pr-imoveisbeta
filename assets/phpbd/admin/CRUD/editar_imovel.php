<?php
	
	include_once '../../connection.php';
	
	if(!empty($_POST)){
		
		$tipoe = $_POST['tipoe'];
		$id_imovel = $_POST['id_imovel'];
		
		
		if($tipoe == "titulo"){
			
			$titulo = $_POST['titulo'];
			
			$sql = "UPDATE Imoveis_tb SET
			titulo  	= '$titulo'
			WHERE 
			id_imovel 	= '$id_imovel'";
			
			$alterar = $conet -> prepare($sql);
			$alterar -> execute();
			
			if($alterar -> RowCount() == 1){
				
				echo "<script>alert('Alterado com sucesso');</script>";
				echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
				
			}else{
				echo "<script>alert('Erro em realizar a alteração');</script>";
				echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
			}
			
		}else if($tipoe == "descricao"){
			
			
			$descricao = $_POST['descricao'];
			
			$sql = "UPDATE Imoveis_tb SET
			descricao  	= '$descricao'
			WHERE 
			id_imovel 	= '$id_imovel'";
			
			$alterar = $conet -> prepare($sql);
			$alterar -> execute();
			
			if($alterar -> RowCount() == 1){
				
				echo "<script>alert('Alterado com sucesso');</script>";
				echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
				
			}else{
				echo "<script>alert('Erro em realizar a alteração');</script>";
				echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
			}
			
		}else if($tipoe == "area"){
			
			
			$area = $_POST['area'];
			
			$sql = "UPDATE Imoveis_tb SET
			aream2  	= '$area'
			WHERE 
			id_imovel 	= '$id_imovel'";
			
			$alterar = $conet -> prepare($sql);
			$alterar -> execute();
			
			if($alterar -> RowCount() == 1){
				
				echo "<script>alert('Alterado com sucesso');</script>";
				echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
				
			}else{
				echo "<script>alert('Erro em realizar a alteração');</script>";
				echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
			}
			
		}else if($tipoe == "nvaga"){
			
			
			$nvaga = $_POST['nvaga'];
			
			$sql = "UPDATE Imoveis_tb SET
			n_vagas  	= '$nvaga'
			WHERE 
			id_imovel 	= '$id_imovel'";
			
			$alterar = $conet -> prepare($sql);
			$alterar -> execute();
			
			if($alterar -> RowCount() == 1){
				
				echo "<script>alert('Alterado com sucesso');</script>";
				echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
				
			}else{
				echo "<script>alert('Erro em realizar a alteração');</script>";
				echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
			}
			
		}else if($tipoe == "fotosegun"){
			
			
			$id_foto 	= $_POST['id_foto'];
			$foto 		= $_FILES['foto'];
			
			$titulo_foto   	= $foto['name'];
			$tmp1         	= $foto['tmp_name'];
			
			$formato     	= pathinfo($titulo_foto, PATHINFO_EXTENSION);
			$novo_nome    	= uniqid().".".$formato;
			
			if($upload1 = move_uploaded_file($tmp1,'../../../img/fotosimoveis'.'/'.$novo_nome)){
			
				$sql = "UPDATE Foto_tb SET
				img  		= '$novo_nome'
				WHERE 
				id_foto 	= '$id_foto'";
				
				
				$alterar = $conet -> prepare($sql);
				$alterar -> execute();
				
				if($alterar -> RowCount() == 1){
					
					echo "<script>alert('Editado com sucesso');</script>";
					echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
					
				}else{
					
					echo "<script>alert('Erro ao fazer a edição');</script>";
					echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
					
				}
			}else{
				echo "<script>alert('Erro ao fazer a edição');</script>";
				echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
			}
			
		}else if($tipoe == "fotoprin"){
			
			$foto 		= $_FILES['foto'];
			
			$titulo_foto   	= $foto['name'];
			$tmp1         	= $foto['tmp_name'];
			
			$formato     	= pathinfo($titulo_foto, PATHINFO_EXTENSION);
			$novo_nome    	= uniqid().".".$formato;
			
			if($upload1 = move_uploaded_file($tmp1,'../../../img/fotosimoveis'.'/'.$novo_nome)){
			
				$sql = "UPDATE Imoveis_tb SET
				foto_principal  = '$novo_nome'
				WHERE 
				id_imovel 		= '$id_imovel'";
				
				
				$alterar = $conet -> prepare($sql);
				$alterar -> execute();
				
				if($alterar -> RowCount() == 1){
					
					echo "<script>alert('Editado com sucesso');</script>";
					echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
					
				}else{
					
					echo "<script>alert('Erro ao fazer a edição');</script>";
					echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
					
				}
			}else{
				echo "<script>alert('Erro ao fazer a edição');</script>";
				echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
			}
			
		}else{
			echo "<script>alert('Falha em tentar editar o imóvel: Falta de dados.');</script>";
			echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
		}
	}else if(!empty($_GET)){
		
		$id_imovel 			= $_GET['id_imovel'];
		$id_foto 			= $_GET['id_foto'];
		
		/*pega o nome da foto principal*/
		$sqlfotoprin = "SELECT * FROM Imoveis_tb WHERE id_imovel = '$id_imovel'";
		
		$listafotoprin = $conet -> prepare($sqlfotoprin);
		$listafotoprin -> execute();
		
		foreach($listafotoprin as $lsp){}
		
		$nome_principal = $lsp['foto_principal'];
		
		/*pega o nome da foto secundaria*/
		$sqlfotosecun = "SELECT * FROM Foto_tb WHERE id_foto = '$id_foto'";
		
		$listafotosecun = $conet -> prepare($sqlfotosecun);
		$listafotosecun -> execute();
		
		foreach($listafotosecun as $lss){}
		
		$nome_secundaria = $lss['img'];
		
		/*Troca a foto principal*/
		
		$sqltrocaprin = "UPDATE Imoveis_tb SET
			foto_principal = '$nome_secundaria'
			WHERE
			id_imovel = '$id_imovel'
		";
		
		$trocaprin = $conet -> prepare($sqltrocaprin);
		$trocaprin -> execute();
		
		
		/*Troca a foto secundaria*/
		
		$sqltrocasecun = "UPDATE Foto_tb SET
			img = '$nome_principal'
			WHERE
			id_foto = '$id_foto'
		";
		$trocasecun = $conet -> prepare($sqltrocasecun);
		$trocasecun -> execute();
		
		
		if(($trocaprin -> RowCount() == 1) && ($trocasecun -> RowCount() == 1)){
			
			echo "<script>alert('Editado com sucesso');</script>";
			echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."')</script>";
			
		}else{
			
			echo "<script>alert('Falha em tentar editar');</script>";
			echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
		
		}
		
		
		
	}else{
		echo "<script>alert('Falha em tentar editar o imóvel: Falta de dados.');</script>";
		echo "<script>window.location.assign('../editarimv?id_imovel=".$id_imovel."');</script>";
	}
?>
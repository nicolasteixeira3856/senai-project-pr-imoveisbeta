<!DOCTYPE html>
<html lang="pt-br">
	<head>
	
	</head>
	<body>
		<form method="POST" action="" enctype="multipart/form-data">
			<input type="file" name="img1">
			<input type="submit">
		</form>
<?php
	include_once "../../connection.php";
	
	$img1 = $_FILES['img1'];
	$titulo_img1   = $img1['name'];
	$tmp1          = $img1['tmp_name'];
	$formato1      = pathinfo($titulo_img1, PATHINFO_EXTENSION);
	$novo_nome1    = uniqid().".".$formato1;
	
	/* $sqlfoto = "INSERT INTO Foto_tb(id_imovel,img) VALUES (?,?)";
		
	$inserirfoto = $conet -> prepare($sqlfoto);
		
	$inserirfoto -> execute(array($id_imovel,$novo_nome1)); */
		
	$upload1 = move_uploaded_file($tmp1,'../../../img/fotosimoveis'.'/'.$novo_nome1);
?>
	</body>
</html>
<?php
	if(isset($_POST['senha'])){
		
		$senha = $_POST['senha'];
		
		@$senhacrypt = crypt($senha);
		
		echo $senhacrypt;
		
	}else{
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Senha Crypt</title>
	</head>
	<body>
		<form method="POST" action="#">
			<label>Digite a senha</label>
			<input type="text" name="senha" required><br>
			<input type="submit" value="Verificar">
		</form>
	</body>
</html>
<?php

	}
?>
<?php
	include_once "../../connection.php";
	
	/*Pegar os dados do imovel*/
	
	$negociacao     = $_POST['negociacao'];
	$finalidade     = $_POST['finalidade'];
	$tipo           = $_POST['tipo'];
	$titulo         = $_POST['titulo'];
	$descricaoo     = $_POST['descricaoo'];
	$area           = $_POST['area'];
	$valor          = $_POST['valor'];
	$nquarto        = $_POST['nquarto'];
	$nvaga          = $_POST['nvaga'];
	$cidade         = $_POST['cidade'];
	$bairro         = $_POST['bairro'];
	$regiao         = $_POST['regiao'];
	$rua            = $_POST['rua'];
	$ncasa          = $_POST['ncasa'];
	
	$img1          = $_FILES['img1'];
	$img2          = $_FILES['img2'];
	$img3          = $_FILES['img3'];
	$img4          = $_FILES['img4'];
	
	/*Separando o nome da imagem*/
	$titulo_img1   = $img1['name'];
	$titulo_img2   = $img2['name'];
	$titulo_img3   = $img3['name'];
	$titulo_img4   = $img4['name'];
	
	
	/*Separando o caminho da imagem temporario*/
	$tmp1          = $img1['tmp_name'];
	$tmp2          = $img2['tmp_name'];
	$tmp3          = $img3['tmp_name'];
	$tmp4          = $img4['tmp_name'];
	
	/*Separando a extenção da imagem*/
	$formato1      = pathinfo($titulo_img1, PATHINFO_EXTENSION);
	$formato2      = pathinfo($titulo_img2, PATHINFO_EXTENSION);
	$formato3      = pathinfo($titulo_img3, PATHINFO_EXTENSION);
	$formato4      = pathinfo($titulo_img4, PATHINFO_EXTENSION);
	
	/*Renomeando a imagem*/
	$novo_nome1    = uniqid().".".$formato1;
	$novo_nome2    = uniqid().".".$formato2;
	$novo_nome3    = uniqid().".".$formato3;
	$novo_nome4    = uniqid().".".$formato4;
	
	$unicimovel = uniqid();
	
	/*editar descricao*/
	$descricao = strtolower($descricao);
	
	if(($formato1 == "jpg" || $formato1 == "png") && ($formato2 == "jpg" || $formato2 == "png") && ($formato3 == "jpg" || $formato3 == "png") && ($formato4 == "jpg" || $formato4 == "png")){
		
		$tirar = array("R$", ".", " ");
		$valor = str_replace($tirar, "", $valor);
		
		$valor = str_replace(",", ".", $valor);
		
		$sql = "INSERT INTO Imoveis_tb(id_nego,id_fin,id_tipo,id_bairro,id_regiao,id_cidade,n_vagas,n_quartos,valor,aream2,descricao,titulo,rua,nrua,unicimovel,foto_principal) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		
		$inserir = $conet -> prepare($sql);
		$inserir -> execute(array($negociacao,$finalidade,$tipo,$bairro,$regiao,$cidade,$nvaga,$nquarto,$valor,$area,$descricaoo,$titulo,$rua,$ncasa,$unicimovel,$novo_nome1));
		
		if($inserir -> rowCount() == 0){
			
			echo "<script>alert('Erro no cadastro');</script>";
			echo "<script>window.location.assign('../admin');</script>";
		}
		
		/*Pegar o id do imovel*/
		$sqlid = "SELECT * FROM Imoveis_tb WHERE unicimovel = '$unicimovel'";
		
		$listaridimovel = $conet -> prepare($sqlid);
		$listaridimovel -> execute();	
		
		foreach($listaridimovel as $lsm){}
		
		$id_imovel = $lsm['id_imovel'];
		
		
		/*Inserir as Fotos do Imovel*/
		
		$sqlfoto = "INSERT INTO Foto_tb(id_imovel,img) VALUES (?,?)";
		
		$inserirfoto = $conet -> prepare($sqlfoto);
		
		$inserirfoto -> execute(array($id_imovel,$novo_nome2));
		$inserirfoto -> execute(array($id_imovel,$novo_nome3));
		$inserirfoto -> execute(array($id_imovel,$novo_nome4));
		
		if($inserirfoto -> rowCount() == 0){
			
			echo "<script>alert('Erro no cadastro');</script>";
			echo "<script>window.location.assign('../admin');</script>";
		}
		
		/*Enviar para a pasta as imagens*/
		$upload1 = move_uploaded_file($tmp1,'../../../img/fotosimoveis'.'/'.$novo_nome1);
		$upload2 = move_uploaded_file($tmp2,'../../../img/fotosimoveis'.'/'.$novo_nome2);
		$upload3 = move_uploaded_file($tmp3,'../../../img/fotosimoveis'.'/'.$novo_nome3);
		$upload4 = move_uploaded_file($tmp4,'../../../img/fotosimoveis'.'/'.$novo_nome4);
		
		
		echo "<script>alert('Cadastrado com sucesso');</script>";
		echo "<script>window.location.assign('../admin');</script>";
		
	}else{
		echo "<script>alert('Imagens não suportadas');</script>";
		echo "<script>window.location.assign('../admin');</script>";
		
	}
?>
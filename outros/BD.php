<?php

	try{
		$conet = new PDO("mysql:host=ctbarmc-imobiliariabeta.com.br.mysql; dbname=ctbarmc_imobiliariabeta_com_br","ctbarmc_imobiliariabeta_com_br","ficizo");
		
	}
	catch(PDOExeception $e){
		echo $e->getMessage();
	}
	
	$sql = "
		CREATE TABLE Usuario_tb (
			id_usuario int(11) PRIMARY KEY AUTO_INCREMENT,
			id_cidade int(11),
			id_bairro int(11),
			email varchar(255),
			nome varchar(75),
			CPF varchar(15),
			senha varchar(35),
			foto varchar(50),
			nivel int(1),
			CRECI int(7),
			telefone varchar(14),
			celular varchar(14)
		);

		CREATE TABLE Recuperacao_tb (
			id_recuperacao int(11) PRIMARY KEY  AUTO_INCREMENT,
			id_usuario int(11),
			token varchar(100),
			FOREIGN KEY(id_usuario) REFERENCES Usuario_tb (id_usuario)
		);

		CREATE TABLE Bairro_tb (
			id_bairro int(11) PRIMARY KEY  AUTO_INCREMENT,
			id_cidade int(11),
			nome_bairro varchar(35)
		);

		CREATE TABLE Finalidade_tb (
			id_fin int(3) PRIMARY KEY  AUTO_INCREMENT,
			finalidade varchar(30)
		);

		CREATE TABLE Regiao_tb (
			id_regiao int(3) PRIMARY KEY  AUTO_INCREMENT,
			nome_regiao varchar(20)
		);

		CREATE TABLE Foto_tb (
			id_foto int(11) PRIMARY KEY  AUTO_INCREMENT,
			id_imovel int(11),
			img varchar(40)
		);

		CREATE TABLE Negociacao_tb (
			id_nego int(3) PRIMARY KEY  AUTO_INCREMENT,
			tipo_nego varchar(30)
		);

		CREATE TABLE Imoveis_tb (
			id_imovel int(11) PRIMARY KEY  AUTO_INCREMENT,
			id_nego int(3),
			id_fin int(3),
			id_tipo int(3),
			id_bairro int(11),
			id_regiao int(3),
			id_cidade int(11),
			n_vagas int(2),
			n_quartos int(2),
			valor varchar(15),
			aream2 int(3),
			descricao varchar(255),
			titulo varchar(75),
			rua varchar(100),
			nrua varchar(5),
			FOREIGN KEY(id_nego) REFERENCES Negociacao_tb (id_nego),
			FOREIGN KEY(id_fin) REFERENCES Finalidade_tb (id_fin),
			FOREIGN KEY(id_bairro) REFERENCES Bairro_tb (id_bairro),
			FOREIGN KEY(id_regiao) REFERENCES Regiao_tb (id_regiao)
		);

		CREATE TABLE Cidade_tb (
			id_cidade int(11) PRIMARY KEY  AUTO_INCREMENT,
			nome_cidade varchar(35)
		);

		CREATE TABLE Reserva_tb (
			id_reserva int(11) PRIMARY KEY  AUTO_INCREMENT,
			id_usuario int(11),
			id_imovel int(11),
			FOREIGN KEY(id_usuario) REFERENCES Usuario_tb (id_usuario),
			FOREIGN KEY(id_imovel) REFERENCES Imoveis_tb (id_imovel)
		);

		CREATE TABLE Favoritos_tb (
			id_favorito int(11) PRIMARY KEY  AUTO_INCREMENT,
			id_imovel int(11),
			id_usuario int(11),
			FOREIGN KEY(id_imovel) REFERENCES Imoveis_tb (id_imovel),
			FOREIGN KEY(id_usuario) REFERENCES Usuario_tb (id_usuario)
		);

		CREATE TABLE Tipo_tb (
			id_tipo int(3) PRIMARY KEY  AUTO_INCREMENT,
			nome_tipo varchar(20)
		);

		ALTER TABLE Usuario_tb ADD FOREIGN KEY(id_cidade) REFERENCES Cidade_tb (id_cidade);
		ALTER TABLE Usuario_tb ADD FOREIGN KEY(id_bairro) REFERENCES Bairro_tb (id_bairro);
		ALTER TABLE Bairro_tb ADD FOREIGN KEY(id_cidade) REFERENCES Cidade_tb (id_cidade);
		ALTER TABLE Foto_tb ADD FOREIGN KEY(id_imovel) REFERENCES Imoveis_tb (id_imovel);
		ALTER TABLE Imoveis_tb ADD FOREIGN KEY(id_tipo) REFERENCES Tipo (id_tipo);
		ALTER TABLE Imoveis_tb ADD FOREIGN KEY(id_cidade) REFERENCES Cidade_tb (id_cidade);
	";
	
	$criartabelas = $conet -> prepare($sql);
	

	if($criartabelas -> execute()){
		echo "Tabelas criadas com sucesso";
	}else{
		echo "Falha ao criar as tabelas";
	}	
?>
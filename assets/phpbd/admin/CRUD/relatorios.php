<?php

	$tipo = $_GET['tipo'];
	
	if($tipo == "imvc"){
		
		// Inclui a conexão
		include_once'../../connection.php';

		// Nome do Arquivo do Excel que será gerado
		$arquivo = 'dados_imoveis.xls';

		// Criamos uma tabela HTML com o formato da planilha para excel
		$tabela = '<table border="1">';
			$tabela .= '<thead>';
				$tabela .= '<tr>';
					$tabela .= '<td colspan="9">Tabela de todos os imoveis</tr>';
				$tabela .= '</tr>';
				$tabela .= '<tr>';
					$tabela .= '<td><b>ID</b></td>';
					$tabela .= '<td><b>Finalidade</b></td>';
					$tabela .= '<td><b>Rua</b></td>';
					$tabela .= '<td><b>Cidade</b></td>';
					$tabela .= '<td><b>Bairro</b></td>';
					$tabela .= '<td><b>Negociacao</b></td>';
					$tabela .= '<td><b>Tipo</b></td>';
					$tabela .= '<td><b>Area M2</b></td>';
					$tabela .= '<td><b>Valor</b></td>';
				$tabela .= '</tr>';
			$tabela .= '</thead>';
			$tabela .= '<tbody>';
			
				$sql = "SELECT * FROM Imoveis_tb
						JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
						JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
						JOIN Finalidade_tb ON Imoveis_tb.id_fin = Finalidade_tb.id_fin
						JOIN Tipo_tb ON Imoveis_tb.id_tipo = Tipo_tb.id_tipo
						JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
						JOIN Regiao_tb ON Imoveis_tb.id_regiao = Regiao_tb.id_regiao";
				
				$lista = $conet -> prepare($sql);
				$lista -> execute();
				
				foreach($lista as $ls){
					$tabela .= '<tr>';
						$tabela .= '<td>'.$ls['id_imovel'].'</td>';
						$tabela .= '<td>'.$ls['finalidade'].'</td>';
						$tabela .= '<td>'.$ls['rua'].'</td>';
						$tabela .= '<td>'.$ls['nome_cidade'].'</td>';
						$tabela .= '<td>'.$ls['nome_bairro'].'</td>';
						$tabela .= '<td>'.$ls['tipo_nego'].'</td>';
						$tabela .= '<td>'.$ls['nome_tipo'].'</td>';
						$tabela .= '<td>'.$ls['aream2'].'</td>';
						$tabela .= "<td>R$ ".number_format($ls['valor'], 2, ',', '.')."</td>";
					$tabela .= '</tr>';
				}
			$tabela .= '</tbody>';
		$tabela .= '</table>';

		// Força o Download do Arquivo Gerado
		header ('Cache-Control: no-cache, must-revalidate');
		header ('Pragma: no-cache');
		header('Content-Type: application/x-msexcel; charset=utf-8');
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
		echo $tabela;
		exit;
		
	}else if($tipo == "corc"){
		// Inclui a conexão
		include_once'../../connection.php';
		
		// Nome do Arquivo do Excel que será gerado
		$arquivo = 'dados_corretor.xls';
		
		// Criamos uma tabela HTML com o formato da planilha para excel
		$tabela = '<table border="1">';
			$tabela .= '<thead>';
				$tabela .= '<tr>';
					$tabela .= '<td colspan="9">Tabela de todos os corretores</tr>';
				$tabela .= '</tr>';
				$tabela .= '<tr>';
					$tabela .= '<td><b>ID</b></td>';
					$tabela .= '<td><b>Nome</b></td>';
					$tabela .= '<td><b>CPF</b></td>';
					$tabela .= '<td><b>Email</b></td>';
					$tabela .= '<td><b>Creci</b></td>';
					$tabela .= '<td><b>Telefone</b></td>';
					$tabela .= '<td><b>Cidade</b></td>';
				$tabela .= '</tr>';
			$tabela .= '</thead>';
			$tabela .= '<tbody>';
			
				$sql = "SELECT * FROM Usuario_tb
						JOIN Cidade_tb ON Usuario_tb.id_cidade = Cidade_tb.id_cidade
						WHERE nivel = 2 OR nivel = 1";
				
				$lista = $conet -> prepare($sql);
				$lista -> execute();
				
				foreach($lista as $ls){
					$tabela .= '<tr>';
						$tabela .= '<td>'.$ls['id_usuario'].'</td>';
						$tabela .= '<td>'.$ls['nome'].'</td>';
						$tabela .= '<td>'.$ls['CPF'].'</td>';
						$tabela .= '<td>'.$ls['email'].'</td>';
						$tabela .= '<td>'.$ls['CRECI'].'</td>';
						$tabela .= '<td>'.$ls['telefone'].'</td>';
						$tabela .= '<td>'.$ls['nome_cidade'].'</td>';
					$tabela .= '</tr>';
				}
			$tabela .= '</tbody>';
		$tabela .= '</table>';

		// Força o Download do Arquivo Gerado
		header ('Cache-Control: no-cache, must-revalidate');
		header ('Pragma: no-cache');
		header('Content-Type: application/x-msexcel; charset=utf-8');
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
		echo $tabela;
		
	}else if($tipo == "cliec"){
		
		// Inclui a conexão
		include_once'../../connection.php';
		
		// Nome do Arquivo do Excel que será gerado
		$arquivo = 'dados_cliente.xls';
		
		// Criamos uma tabela HTML com o formato da planilha para excel
		$tabela = '<table border="1">';
			$tabela .= '<thead>';
				$tabela .= '<tr>';
					$tabela .= '<td colspan="9">Tabela de todos os corretores</tr>';
				$tabela .= '</tr>';
				$tabela .= '<tr>';
					$tabela .= '<td><b>ID</b></td>';
					$tabela .= '<td><b>Nome</b></td>';
					$tabela .= '<td><b>CPF</b></td>';
					$tabela .= '<td><b>Email</b></td>';
					$tabela .= '<td><b>Creci</b></td>';
					$tabela .= '<td><b>Telefone</b></td>';
					$tabela .= '<td><b>Cidade</b></td>';
				$tabela .= '</tr>';
			$tabela .= '</thead>';
			$tabela .= '<tbody>';
			
				$sql = "SELECT * FROM Usuario_tb
						JOIN Cidade_tb ON Usuario_tb.id_cidade = Cidade_tb.id_cidade
						WHERE nivel = 3";
				
				$lista = $conet -> prepare($sql);
				$lista -> execute();
				
				foreach($lista as $ls){
					$tabela .= '<tr>';
						$tabela .= '<td>'.$ls['id_usuario'].'</td>';
						$tabela .= '<td>'.$ls['nome'].'</td>';
						$tabela .= '<td>'.$ls['CPF'].'</td>';
						$tabela .= '<td>'.$ls['email'].'</td>';
						$tabela .= '<td>'.$ls['CRECI'].'</td>';
						$tabela .= '<td>'.$ls['telefone'].'</td>';
						$tabela .= '<td>'.$ls['nome_cidade'].'</td>';
					$tabela .= '</tr>';
				}
			$tabela .= '</tbody>';
		$tabela .= '</table>';

		// Força o Download do Arquivo Gerado
		header ('Cache-Control: no-cache, must-revalidate');
		header ('Pragma: no-cache');
		header('Content-Type: application/x-msexcel; charset=utf-8');
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");
		echo $tabela;
	}else if($tipo == "rsimv"){
		echo $tipo;
	}else{
		echo "Erro na solicitação";
	}
?>
<?php
	
	include_once "../../connection.php";
	
	/*Selecionar as tabelas*/
	
	$sqlm = "SELECT * FROM Imoveis_tb
	JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
	JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
	JOIN Finalidade_tb ON Imoveis_tb.id_fin = Finalidade_tb.id_fin
	JOIN Tipo_tb ON Imoveis_tb.id_tipo = Tipo_tb.id_tipo
	JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
	JOIN Regiao_tb ON Imoveis_tb.id_regiao = Regiao_tb.id_regiao";
	
	$listarimv = $conet -> prepare($sqlm);
	$listarimv -> execute();

	if($listarimv -> rowCount() == 0){
		echo("Nenhum cadastro encontrado");
	}else{
?>
<h1 class="page-header">Tabela com todos os Imóveis</h1>
<div class="table-responsive">	
	<table class="table table-hover">
		<tr>
			<th class="id1">ID</th>
			<th>Finalidade</th>
			<th>Rua</th>
			<th class="cidade1">Cidade</th>
			<th>Bairro</th>
			<th>Negociacao</th>
			<th>Tipo</th>
			<th>Area M2</th>
			<th>Valor</th>
			<th colspan="3" class="gerenciar1">Gerenciar</th>
		</tr>
		
	<?php
		echo "<br>Há ".$listarimv -> rowCount()." imóveis Cadastrados!";
		foreach($listarimv as $lsm){
			echo "
				<tr>
					<td class='id1' id='id_imovel'>".$lsm['id_imovel']."</td>								
					<td>".$lsm['finalidade']."</td>
					<td>".$lsm['rua']."</td>
					<td class='cidade1'>".$lsm['nome_cidade']."</td>
					<td>".$lsm['nome_bairro']."</td>
					<td>".$lsm['tipo_nego']."</td>
					<td>".$lsm['nome_tipo']."</td>
					<td>".$lsm['aream2']."</td>
					<td>".$lsm['valor']."</td>
					<td class='gerenciar1'><form action='editarimv.php' method='POST'><input type='hidden' value=".$lsm['id_imovel']." name='id_imovel'><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span></button></form></td>
					<td class='gerenciar1'><button type='button' class='btn btn-primary' id='btnDelete' onclick='confirmacaodeletarimovel(".$lsm['id_imovel'].")'><span class='glyphicon glyphicon-trash'></span></button></td>
					<td class='gerenciar1'><a href='../../../imovel?id=".$lsm['id_imovel']."'><button type='button' class='btn btn-primary'>Mais</button></a></td>
				</tr>";
		}/*data-whateverid='".$lsm['id_imovel']."' data-whateverTitulo='".$lsm['titulo']."' data-whateverDescricao='".$lsm['descricao']."' data-whateverQuartos='".$lsm['n_quartos']."' data-whateverVagas='".$lsm['n_vagas']."' data-whateverNegociacao='".$lsm['id_imovel']."' data-whateverFinalidade='".$lsm['id_imovel']."' data-whateverValor='".$lsm['valor']."' data-whateverArea='".$lsm['aream2']."'*/
	  echo"</table>";
	  exit;
	?>
	</table>
	<input type="button" name="imprimir" class="btn btn-primary imprimir" align="center" value="Imprimir" onclick="window.print();">
</div>
<?php
	}
	
?>
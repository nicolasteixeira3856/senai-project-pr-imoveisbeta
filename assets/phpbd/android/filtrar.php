<?php

    include_once 'conexao.php';
    
	$id_usuario 	= $_REQUEST['id_usuario'];
	$cidade_imovel 	= $_REQUEST['cidade_imovel'];
	$tipo_imovel 	= $_REQUEST['tipo_imovel'];
	$nego_imovel 	= $_REQUEST['nego_imovel'];
	
	
    $sql = "SELECT * FROM Imoveis_tb
			JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
			JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
			JOIN Tipo_tb ON Imoveis_tb.id_tipo = Tipo_tb.id_tipo
			JOIN Negociacao_tb ON Imoveis_tb.id_nego = Negociacao_tb.id_nego
			WHERE Cidade_tb.nome_cidade LIKE '%$cidade_imovel%'
			AND Tipo_tb.nome_tipo LIKE '%$tipo_imovel%'
			AND Negociacao_tb.tipo_nego LIKE '%$nego_imovel%'
	";
    
    $listarimo = $conet->prepare($sql);
    $listarimo -> execute(); //Executa a query
    
    
    $json_data = array(); //Cria o array
    foreach ($listarimo as $rec) //Foreach loop
    {
        $json_array['id']               = $rec['id_imovel'];
        $json_array['id_usuario']       = $id_usuario; 
        $json_array['titulo']           = $rec['titulo']; 
        $json_array['valor']            = $rec['valor']; 
        $json_array['descricao']        = $rec['descricao'];
        $json_array['rua']              = $rec['rua'];
        $json_array['nrua']             = $rec['nrua'];
        $json_array['nomeimg']          = $rec['foto_principal']; 
        $json_array['cidade']         	= $rec['nome_cidade']; 
		$json_array['bairro']          	= $rec['nome_bairro']; 
        /*$json_array['tipo']         	= $rec['nome_tipo']; 
        $json_array['negociacao']       = $rec['tipo_nego']; */
    
        //Adiciona os valores ao array
        array_push($json_data, $json_array);
    }
    //Converte os dados no formato JSON
    echo json_encode(array("Imoveis" => $json_data));
?>
<?php

    include_once 'conexao.php';
    
	$id_usuario = $_REQUEST['id_usuario'];
	
    $sql = "SELECT * FROM Imoveis_tb
			JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
			JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
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
    
        //Adiciona os valores ao array
        array_push($json_data, $json_array);
    }
    //Converte os dados no formato JSON
    echo json_encode(array("Imoveis" => $json_data));
?>
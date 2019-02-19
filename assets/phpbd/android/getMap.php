<?php
    
    include_once 'conexao.php';
    
    $sql = "SELECT * FROM Imoveis_tb
    JOIN Cidade_tb ON Imoveis_tb.id_cidade = Cidade_tb.id_cidade
    JOIN Bairro_tb ON Imoveis_tb.id_bairro = Bairro_tb.id_bairro
    ";
    
    $lista = $conet -> prepare($sql);
    $lista -> execute();
    
    $json_dados = array();
    
    foreach($lista as $ls){
        
        $json_lista['cidade'] = $ls['nome_cidade'];
        $json_lista['bairro'] = $ls['nome_bairro'];
        $json_lista['rua'] = $ls['rua'];
        $json_lista['nrua'] = $ls['nrua'];
        
        //Adiciona os valores ao array
        array_push($json_dados, $json_lista);
    }
    
    //Converte os dados no formato JSON
    echo json_encode(array("Imoveis" => $json_dados));  

?>
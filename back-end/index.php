<?php

//Cabecalhos obrigatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Incluir a conexao
include_once 'conexao.php';

$query_faq = "SELECT id, tema, pergunta, resposta FROM faq ORDER BY id DESC";
$result_faq = $conn->prepare($query_faq);
$result_faq->execute();

if(($result_faq) AND ($result_faq->rowCount() != 0)){
    while($row_faq = $result_faq->fetch(PDO::FETCH_ASSOC)){
        
        extract($row_faq);

        $lista_faq["records"][$id] = [
            'id' => $id,
            'tema' => $tema,
            'pergunta' => $pergunta,
            'resposta' => $resposta
        ];
    }

    //Resposta com status 200
    http_response_code(200);

    //Retornar os produtos em formato json
    echo json_encode($lista_produtos);
}
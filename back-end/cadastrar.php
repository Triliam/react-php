<?php

//Cabecalhos obrigatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
//header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

//Incluir a conexao
include_once 'conexao.php';

$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);

if($dados){

    $query_faq = "INSERT INTO faq (tema, pergunta, resposta) VALUES (:tema, :pergunta, :resposta)";
    $cad_faq = $conn->prepare($query_faq);

    $cad_faq->bindParam(':tema', $dados['tema']['pergunta']['resposta'], PDO::PARAM_STR);
    $cad_faq->bindParam(':pergunta', $dados['tema']['pergunta']['resposta'], PDO::PARAM_STR);
    $cad_faq->bindParam(':resposta', $dados['tema']['pergunta']['resposta'], PDO::PARAM_STR);

    $cad_faq->execute();

    if($cad_faq->rowCount()){
        $response = [
            "erro" => false,
            "messagem" => "Produto cadastrado sucesso!"
        ];
    }else{
        $response = [
            "erro" => true,
            "messagem" => "Produto não cadastrado sucesso!"
        ];
    }
    
    
}else{
    $response = [
        "erro" => true,
        "messagem" => "Produto não cadastrado sucesso!"
    ];
}

http_response_code(200);
echo json_encode($response);
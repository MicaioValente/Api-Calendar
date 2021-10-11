<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

// infos do banco
require("bootstrap.php");


$json = file_get_contents('php://input');

// converter e um objeto php
$data = json_decode($json);

// pegar os dados do formulário
$title = mysqli_real_escape_string($db, $data->title);
$date = mysqli_real_escape_string($db, $data->date);


// prepara SQL
$sql = "INSERT INTO events (date, title) VALUES ('{$date}', '{$title}')";

// executa o comando sql
mysqli_query($db, $sql);

// fechar conexão com o banco
mysqli_close($db);

// enviar mensagem de sucesso
header('Content-Type: application/json; charset=utf-8');
echo json_encode(array("msg" => "success"));
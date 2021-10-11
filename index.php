<?php
// forçar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

// infos do banco
require("bootstrap.php");

// prepara SQL
$sql = "SELECT id, date, title FROM events";

// executa o comando sql
$resultado = mysqli_query($db, $sql);


// converte o resultado para um array bonitinho
$events = [];
while ($r = mysqli_fetch_array($resultado)) {
    $events[] = array(
        "id" => (int) $r["id"],
        "title" => $r["title"],
        "date" => $r["date"]
    );
}

// fechar conexão com o banco
mysqli_close($db);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($events);
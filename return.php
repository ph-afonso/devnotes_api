<?php 

// Configuração CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

// Retorno como JSON
echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit;

?>

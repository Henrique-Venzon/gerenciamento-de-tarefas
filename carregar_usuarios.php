<?php
session_start();
include_once('include/conexao.php');

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta para buscar todos os usuários
$sql = "SELECT id, nome FROM usuario";
$result = $conn->query($sql);

$usuarios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Retorna os dados em formato JSON
header('Content-Type: application/json');
echo json_encode($usuarios);

$conn->close();
?>

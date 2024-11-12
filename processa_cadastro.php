<?php

session_start();
include_once('include/conexao.php');

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Verifica se os campos estão preenchidos
    if (!empty($nome) && !empty($email)) {
        // Prepara a consulta SQL para evitar injeções de SQL
        $stmt = $conn->prepare("INSERT INTO usuario (nome, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome, $email);

        // Executa a consulta e verifica o resultado
        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar usuário: " . $stmt->error;
        }

        // Fecha o statement
        $stmt->close();
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}

// Fecha a conexão
$conn->close();


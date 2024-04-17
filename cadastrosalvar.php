<?php

include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // coleta os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];    
    $cpf = $_POST['cpf'];
    $tel = $_POST['tel'];
    $senha = $_POST['senha'];
    // insere os dados no bd
    $sql = "INSERT INTO clientes (nome, sobrenome, email, tel, cpf, senha) VALUES ('$nome', '$sobrenome', '$email', '$tel', '$cpf', '$senha')";

    if ($conexao->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro: " . $conexao->error;
    }
    //Encerra conexão com o bd
    $conexao->close();
}
?>
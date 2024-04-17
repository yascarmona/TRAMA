<?php

include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idCliente  = $_POST['idCliente'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];    
    $cpf = $_POST['cpf'];
    $tel = $_POST['tel'];
    $senha = $_POST['senha'];
    
    $sql = "UPDATE cadastro SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', cpf = '$cpf', tel = '$tel', senha = '$senha' WHERE idCliente = $idCliente";

       
    if ($conexao->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro: " . $conexao->error;
    }

    $conexao->close();
}
?>
<?php
// Conexão com o banco de dados
include 'config.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se é cadastro de cliente ou empresa
    $tipo = $_POST['tipo'];
    
    // Se for cliente
    if ($tipo == "cliente") {
         // coleta os dados do formulário
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];    
        $cpf = $_POST['cpf'];
        $tel = $_POST['tel'];
        $senha = $_POST['senha']; // Senha sem criptografia
        
        // insere os dados no bd
        $sql = "INSERT INTO clientes (nome, sobrenome, email, tel, cpf, senha) VALUES ('$nome', '$sobrenome', '$email', '$tel', '$cpf', '$senha')";

        if ($conexao->query($sql) === TRUE) {
            header("Location: login.html");
        } else {
            echo "Erro: " . $conexao->error;
        }
    }
    // Se for empresa
    elseif ($tipo == "empresa") {
        // Recebe os dados do formulário
        $cnpj = $_POST['cnpj'];
        $RazaoSoci = $_POST['RazaoSoci'];
        $NomeFanta = $_POST['NomeFanta'];
        $email = $_POST['email'];
        $senha = $_POST['senha']; // Senha sem criptografia
        $tel = $_POST['tel'];
        
        $sql = "INSERT INTO empresas (cnpj, RazaoSoci, NomeFanta, tel, email, senha) VALUES ('$cnpj', '$RazaoSoci', '$NomeFanta', '$tel', '$email', '$senha')";

        if ($conexao->query($sql) === TRUE) {
            header("Location: login.html");
        } else {
            echo "Erro: " . $conexao->error;
        
        }
    }
}
?>

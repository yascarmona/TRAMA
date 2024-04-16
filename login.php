<?php
// Conexão com o banco de dados
include 'config.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se é login de cliente ou empresa
    $tipo = $_POST['tipo'];
    
    // Se for cliente
    if ($tipo == "cliente") {
        // Recebe os dados do formulário
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        // Verifica se os dados foram recebidos corretamente
        if (!empty($cpf) && !empty($senha)) {
            // Verifica as credenciais do cliente
            $sql = "SELECT id, senha FROM clientes WHERE cpf = '$cpf' AND senha = '$senha'";
            $result = $conexao->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                // Inicia a sessão e redireciona para o perfil do cliente
                session_start();
                $_SESSION['id'] = $row['id'];
                header("Location: perfil_Cliente.php");
                exit(); // Importante para evitar a execução adicional do código
            } else {
                echo "CPF ou senha incorretos.";
            }
        } else {
            echo "Por favor, preencha todos os campos.";
        }
    }
    // Se for empresa
    elseif ($tipo == "empresa") {
        // Recebe os dados do formulário
        $cnpj = $_POST['cnpj'];
        $senha = $_POST['senha'];

        // Verifica se os dados foram recebidos corretamente
        if (!empty($cnpj) && !empty($senha)) {
            // Verifica as credenciais da empresa
            $sql = "SELECT id, senha FROM empresas WHERE cnpj = '$cnpj' AND senha = '$senha'";
            $result = $conexao->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                // Inicia a sessão e redireciona para o perfil da empresa
                session_start();
                $_SESSION['id'] = $row['id'];
                header("Location: perfil_Empresa.php");
                exit(); // Importante para evitar a execução adicional do código
            } else {
                echo "CNPJ ou senha incorretos.";
            }
        } else {
            echo "Por favor, preencha todos os campos.";
        }
    }
}
?>

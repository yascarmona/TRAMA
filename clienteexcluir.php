<!-- excluir_cliente.php -->
<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
    // Exclui a conta do cliente do banco de dados
    $id = $_SESSION['id'];
    $stmt = $conexao->prepare("DELETE FROM clientes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Limpa a sessão e redireciona para a página de login
    session_unset();
    session_destroy();
    header("Location: login.html");
    exit();
} else {
    header("Location: perfil_cliente.php");
    exit();
}
?>
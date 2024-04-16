<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
include 'config.php';

// Obtém informações do cliente
$id = $_SESSION['id'];
$stmt = $conexao->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Cliente</title>
</head>
<body>
    <h1>Perfil do Cliente</h1>
    <p>Nome: <?php echo $row['nome'] . " " . $row['sobrenome']; ?></p>
    <p>Email: <?php echo $row['email']; ?></p>
    <p>CPF: <?php echo $row['cpf']; ?></p>
    <p>Telefone: <?php echo $row['tel']; ?></p><br><br>
    
    <!-- Adicione links para editar e excluir conta -->
    <a href="editar_cliente.php">Editar</a>
    <a href="excluir_cliente.php">Excluir Conta</a>
    
    <br><br>
    <a href="index.html">Logout</a>
</body>
</html>

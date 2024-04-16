<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
include 'config.php';

// Obtém informações da empresa
$id = $_SESSION['id'];
$stmt = $conexao->prepare("SELECT * FROM empresas WHERE id = ?");
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
    <title>Perfil da Empresa</title>
</head>
<body>
    <h1>Perfil da Empresa</h1>
    <p>Razão Social: <?php echo $row['RazaoSoci']; ?></p>
    <p>Nome Fantasia: <?php echo $row['NomeFanta']; ?></p>
    <p>Email: <?php echo $row['email']; ?></p>
    <p>CNPJ: <?php echo $row['cnpj']; ?></p>
    <p>Telefone: <?php echo $row['tel']; ?></p>

    <a href="editar_empresa.php">Editar</a>
    <a href="confirmar_excluir_empresa.php">Excluir Conta</a>
    
    <a href="index.html">Logout</a>
</body>
</html>

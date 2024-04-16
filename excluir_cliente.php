<!-- confirmar_excluir_cliente.php -->
<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Exclusão da Conta</title>
</head>
<body>
    <h1>Confirmar Exclusão da Conta</h1>
    <p>Você tem certeza que deseja excluir sua conta?</p>
    <form action="confirmar_excluir_cliente.php" method="post">
        <input type="submit" name="confirmar" value="Confirmar">
        <a href="perfil_cliente.php">Cancelar</a>
    </form>
</body>
</html>

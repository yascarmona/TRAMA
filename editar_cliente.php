<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
include 'config.php';

// Verifica se o formulário de edição foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os novos dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $tel = $_POST['tel'];

    // Atualiza os dados do cliente no banco de dados
    $stmt = $conexao->prepare("UPDATE clientes SET nome=?, sobrenome=?, email=?, cpf=?, tel=? WHERE id=?");
    $stmt->bind_param("sssssi", $nome, $sobrenome, $email, $cpf, $tel, $_SESSION['id']);
    $stmt->execute();
    $stmt->close();

    // Redireciona de volta para o perfil do cliente
    header("Location: perfil_cliente.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil do Cliente</title>
</head>
<body>
    <h1>Editar Perfil do Cliente</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nome: <input type="text" name="nome" value="<?php echo $row['nome']; ?>"><br><br>
        Sobrenome: <input type="text" name="sobrenome" value="<?php echo $row['sobrenome']; ?>"><br><br>
        Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
        CPF: <input type="text" name="cpf" value="<?php echo $row['cpf']; ?>"><br><br>
        Telefone: <input type="text" name="tel" value="<?php echo $row['tel']; ?>"><br><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>

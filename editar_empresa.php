<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Obtém informações da empresa
$id = $_SESSION['id'];
$stmt = $conexao->prepare("SELECT * FROM empresas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os novos dados do formulário
    $razao_social = $_POST['razao_social'];
    $nome_fantasia = $_POST['nome_fantasia'];
    $email = $_POST['email'];
    $cnpj = $_POST['cnpj'];
    $tel = $_POST['tel'];

    // Atualiza os dados da empresa no banco de dados
    $stmt = $conexao->prepare("UPDATE empresas SET RazaoSoci=?, NomeFanta=?, email=?, cnpj=?, tel=? WHERE id=?");
    $stmt->bind_param("sssssi", $razao_social, $nome_fantasia, $email, $cnpj, $tel, $_SESSION['id']);
    $stmt->execute();
    $stmt->close();

    // Redireciona de volta para o perfil da empresa
    header("Location: perfil_empresa.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil da Empresa</title>
</head>
<body>
    <h1>Editar Perfil da Empresa</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Razão Social: <input type="text" name="razao_social" value="<?php echo $row['RazaoSoci']; ?>"><br><br>
        Nome Fantasia: <input type="text" name="nome_fantasia" value="<?php echo $row['NomeFanta']; ?>"><br><br>
        Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
        CNPJ: <input type="text" name="cnpj" value="<?php echo $row['cnpj']; ?>"><br><br>
        Telefone: <input type="text" name="tel" value="<?php echo $row['tel']; ?>"><br><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>

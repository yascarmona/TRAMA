<?php
// Inclua o arquivo de configuração do banco de dados
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta para verificar se o administrador existe no banco de dados
    $sql = "SELECT id, email FROM administradores WHERE email='$email' AND senha='$senha'";
    $result = $conexao->query($sql);

    if ($result->num_rows == 1) {
        // Se o administrador existir, redirecione para a página de agendamento
        $row = $result->fetch_assoc();
        $admin_id = $row['id'];
        header("Location: agendamentoadmin.php?id=$admin_id");
        exit();
    } else {
        // Se as credenciais estiverem incorretas, redirecione de volta para a página de login
        header("Location: loginadm.html");
        exit();
    }
}

$conexao->close();
?>

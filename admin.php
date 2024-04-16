<?php
// Conexão com o banco de dados
include("config.php");

// Atualização do status do agendamento
if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    
    $sql = "UPDATE agendamento SET status='$status' WHERE id=$id";
    if ($conexao->query($sql) === TRUE) {
        echo "Status atualizado com sucesso";
        
        // Redirecionar de volta para a página anterior
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        echo "Erro ao atualizar o status: " . $conexao->error;
    }
}

// Consulta dos agendamentos
$sql = "SELECT * FROM agendamento";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Agendamentos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Administração de Agendamentos</h1>
    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Data do Agendamento</th>
            <th>Status</th>
            <th>Ação</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["nome"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["telefone"]."</td>";
                echo "<td>".$row["endereco"]."</td>";
                echo "<td>".$row["data_agendamento"]."</td>";
                echo "<td>".$row["status"]."</td>";
                echo "<td><form action='admin.php' method='post'><input type='hidden' name='id' value='".$row["id"]."'><select name='status' onchange='this.form.submit()'><option value='aceito'>Aceitar</option><option value='recusado'>Recusar</option></select></form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Nenhum agendamento encontrado</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conexao->close();
?>

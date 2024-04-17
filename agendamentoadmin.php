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

<!DOCTYPE html>>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
    <link rel="stylesheet" href="agendamentoadminstyle.css">
    <link rel="icon" href="trama_logo_small.svg">
</head>
<body>
<header>
    <div class="logo">
        <a href="index.html"><img src="trama_logo.png"></a>
    </div>
    <div class="hamburger-menu">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
    <ul>
        <li><a class="navlink" href="sobre.html">SOBRE</a></li>
        <li><a class="navlink" href="produtos.html">PRODUTOS</a></li>
        <li><a class="navlink" href="sustentabilidade.html">SUSTENTABILIDADE</a></li>
    </ul>
</header>

<body>
    <div class = containerbg>
    <div class="container">
    <h5>CENTRAL DE AGENDAMENTOS</h5>
    <table>
        <tr>
            <th>NOME &nbsp;</th>
            <th>&nbsp;E-MAIL</th>
            <th>&nbsp;TELEFONE</th>
            <th>&nbsp;ENDEREÇO</th>
            <th>&nbsp;DATA DA VISITA&nbsp;</th>
            <th>&nbsp;STATUS</th>
            <th>&nbsp;AÇÃO</th>
        </tr></div></div>


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
                echo "<td><form action='agendamentoadmin.php' method='post'><input type='hidden' name='id' value='".$row["id"]."'><select name='status' onchange='this.form.submit()'><option value='aceito'>Aceitar</option><option value='recusado'>Recusar</option></select></form></td>";
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

<?php
// Inclui o arquivo de configuração do banco de dados
include_once('config.php');

// Inicializa a variável de mensagem
$message = "";

// Verifica se foi enviado um formulário (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // coleta os dados do formulário
    $agendamento_id = $_POST['agendamento_id'];
    $status = $_POST['status'];
    $comentario = $_POST['comentario'];

    // Prepara e executa a query para atualizar o agendamento com o novo status e comentário
    $sql_update = "UPDATE agendamento SET status='$status', comentario='$comentario' WHERE id=$agendamento_id";

    if ($conexao->query($sql_update) === TRUE) {
        // Configura a mensagem de sucesso
        $message = "Status do agendamento atualizado com sucesso!";
    } else {
        // Configura a mensagem de erro
        $message = "Erro ao atualizar o status do agendamento: " . $conexao->error;
    }
}

// Consulta ao banco de dados para recuperar todos os agendamentos
$sql_select = "SELECT * FROM agendamento";
$result = $conexao->query($sql_select);

// Fecha a conexão com o banco de dados
$conexao->close();
?>

<!DOCTYPE html>
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
    <ul>
        <li><a class="navlink" href="sobre.html">SOBRE</a></li>
        <li><a class="navlink" href="produtos.html">PRODUTOS</a></li>
        <li><a class="navlink" href="sustentabilidade.html">SUSTENTABILIDADE</a></li>
    </ul>
    <a href="login.html">
        <button class="login-btn">LOGIN</button>
    </a>
</header>

<div class="containerbg">
    <div class="container">
        <h5>AGENDAMENTOS</h5>
        <?php
        // Exibe a mensagem de sucesso ou erro, se houver
        if (!empty($message)) {
            echo "<p class='message'>$message</p>";
        }

        // Verifica se há agendamentos
        if ($result->num_rows > 0) {
            // Loop através dos resultados
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $nome = $row['nome'];
                $email = $row['email'];
                $telefone = $row['telefone'];
                $endereco = $row['endereco'];
                $data_agendamento = $row['data_agendamento'];
                $status = $row['status'];
                $comentario = $row['comentario'];

                // Exibe os dados do agendamento em uma tabela
                echo "<div class='agendamento'>";
                echo "<p><strong>ID:</strong> $id</p>";
                echo "<p><strong>Nome:</strong> $nome</p>";
                echo "<p><strong>Email:</strong> $email</p>";
                echo "<p><strong>Telefone:</strong> $telefone</p>";
                echo "<p><strong>Endereço:</strong> $endereco</p>";
                echo "<p><strong>Data:</strong> $data_agendamento</p>";
                echo "<p><strong>Status:</strong> $status</p>";
                echo "<form method='POST' action='agendamentoadmin.php'>";
                echo "<input type='hidden' name='agendamento_id' value='$id'>";
                echo "<label for='status_$id'>Status:</label>";
                echo "<select id='status_$id' name='status'>";
                echo "<option value='Pendente'>Pendente</option>";
                echo "<option value='Aceito'>Aceito</option>";
                echo "<option value='Recusado'>Recusado</option>";
                echo "</select>";
                echo "<p><strong>Comentário:</strong> $comentario</p>";
                echo "<label for='comentario_$id'>Comentário:</label>";
                echo "<textarea id='comentario_$id' name='comentario'></textarea>";
                echo "<input type='submit' value='Atualizar'>";
                echo "</form>";



                echo "</div>";
            }
        } else {
            echo "<p>Nenhum agendamento encontrado.</p>";
        }
        ?>
    </div>
</div>

<script src="script.js"></script>

</body>
</html>

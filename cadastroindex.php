
<?php
// Incluir arquivo de configuração
include("config.php");

$sql = "SELECT * FROM clientes WHERE id = ?"; // Supondo que o usuário que você deseja editar tenha ID 1

// Executar a consulta
$result = $conexao->query($sql);

// Fechar a conexão com o banco de dados
$conexao->close();
?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
    <link rel="stylesheet" href="cadastrostyleindex.css">
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

    <a href="login.html">
        <button class="login-btn">LOGIN</button>
    </a>
</header>
<div class="containerbg">
<div class="container">
    <table>
        <tr class="TB">
            <th>NOME</th>
            <th>SOBRENOME</th>
            <th>E-MAIL</th>
            <th>SENHA</th>
            <th>CPF</th>
            <th>TELEFONE</th>
        </tr>
        <?php
    // Itera sobre os resultados da consulta
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['sobrenome'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['senha'] . "</td>";
        echo "<td>" . $row['cpf'] . "</td>";
        echo "<td>" . $row['tel'] . "</td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td><div class='button-group'><button class='edit-btn' onclick=\"window.location.href='cadastroeditar.php?id=" . $row['id'] . "'\">Editar</button><button class='delete-btn' onclick=\"window.location.href='cadastroexcluir.php?id=" . $row['id'] . "'\">Excluir</button></div></td>";
        echo "</tr>";
    }
?>
    </table>

    <!-- Botões de adicionar e logout -->
    <div class="logoutbotao">
        <a href="adicionar.php"><button class="adicionar">Adicionar Cliente </button></a><br><br>
        <a href="index.html"><button class="logout">Logout</button></a>
    </div>
</div>
</div>
<!-- FIM LOGOUT --> 

  </body>
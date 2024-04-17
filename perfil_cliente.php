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

$cpf_formatado = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $row['cpf']);
$telefone_formatado = preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '($1) $2-$3', $row['tel']);

?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
    <link rel="stylesheet" href="perfilstyle.css">
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

            <div class="title">
                <h5>SEU PERFIL</h5>
            </div>

            <div class="information">    
                <h3><b>INFORMAÇÕES PESSOAIS</b></h3>
                <p><strong><b>NOME:</b></strong> <?php echo $row['nome'] . " " . $row['sobrenome']; ?></p>
                <p><strong><b>CPF:</b></strong> <?php echo $cpf_formatado; ?></p>
                <h3><b>INFORMAÇÕES DE CONTATO</b></h3>
                <p><strong><b>E-MAIL:</b></strong> <?php echo $row['email']; ?></p>
                <p><strong><b>TELEFONE:</b></strong> <?php echo $telefone_formatado; ?></p>
                <br>
            </div>
            
            <!-- Botões de logout -->
            <div class="inline-buttons">
                <a href="clienteeditar.php"><button class="editar">EDITAR</button></a>
                <a href="index.html"><button class="logout">LOGOUT</button></a>
            </div>
    </div>
</div>
<!-- FIM LOGOUT --> 

  </body>
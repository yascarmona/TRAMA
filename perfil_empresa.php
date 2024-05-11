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

$cnpj_formatado = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $row['cnpj']);
$telefone_formatado = preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '($1) $2-$3', $row['tel']);

// Saudação personalizada
$saudacao = "Bem-vindo, " . $row['NomeFanta'];

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
</header>

<div class="containerbg">
    <div class="container">
        <div class="title">
            <h5>SEU PERFIL</h5>
        </div>
        </div>
                <!-- Adicionando a caixa de texto de boas-vindas -->
                <div class="welcome-box">
                <p>Bem-vindo, <?php echo $row['nome']; ?>!</p>
        </div>
        <div class="information">    
            <h3><b>INFORMAÇÕES DA EMPRESA</b></h3>
            <p><b>RAZÃO SOCIAL:</b> <?php echo $row['RazaoSoci']; ?></p>
            <p><b>NOME FANTASIA:</b> <?php echo $row['NomeFanta']; ?></p>
            <p><b>CNPJ:</b> <?php echo $cnpj_formatado; ?></p>
            <h3><b>INFORMAÇÕES DE CONTATO</b></h3>
            <p><b>E-MAIL:</b> <?php echo $row['email']; ?></p>
            <p><b>TELEFONE:</b> <?php echo $telefone_formatado; ?></p>
            <br>
        </div>
        <!-- Botões de logout -->
        <div class="inline-buttons">
            <a href="empresaeditar.php"><button class="editar">EDITAR</button></a>
            <a href="agendamentoindex.php"><button class="editar">AGENDAR VISITA</button></a>
            <a href="agendamentodetalhes.php?id=''"><button class="editar">DETALHES DO AGENDAMENTO</button></a>
            <a href="index.html"><button class="logout">LOGOUT</button></a>
        </div>
    </div>
</div>
<!-- FIM LOGOUT -->

</body>
</html>

<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
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
            <h1>CONFIRMAÇÃO DE EXCLUSÃO</h1>

            <p>Você tem certeza que deseja excluir sua conta? <br><small>Essa ação não poderá ser desfeita quando confirmada.</small></p>
        </div>

        <div class="deletebotao">
            <form action="empresaexcluir.php" method="post">
                <input type="submit" name="confirmar" value="CONFIRMAR">
                <a href="perfil_empresa.php"><button class="cancelar">CANCELAR</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>

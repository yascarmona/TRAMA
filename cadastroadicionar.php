
<?php
// Incluir arquivo de configuração
include("config.php");

$sql = "SELECT * FROM clientes WHERE id = 1"; // Supondo que o usuário que você deseja editar tenha ID 1

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
    <link rel="stylesheet" href="cadastrostyle.css">
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
        <h5>EDITAR USUÁRIO MANUALMENTE</h5>
        <form action="cadastrosalvar.php" method="POST">
            <div class="input-box">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?php echo isset($row['nome']) ? $row['nome'] : ''; ?>" required>
            </div>

            <div class="input-box">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" name="sobrenome" value="<?php echo isset($row['sobrenome']) ? $row['sobrenome'] : ''; ?>" required>
            </div>

            <div class="input-box">
                <label for="email">E-mail:</label>
                <input type="text" name="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" required>
            </div>

            <div class="input-box">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" value="<?php echo isset($row['senha']) ? $row['senha'] : ''; ?>" required>
            </div>

            <div class="input-box">
                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" value="<?php echo isset($row['cpf']) ? $row['cpf'] : ''; ?>" required>
            </div>

            <div class="input-box">
                <label for="tel">Telefone:</label>
                <input type="text" name="tel" value="<?php echo isset($row['tel']) ? $row['tel'] : ''; ?>" required>
            </div>

            <div class="btn-box">
                <input type="submit" value="Salvar" class="salvar">
                <button class="voltar"><a href="index.php">Voltar</a></button>
            </div>
        </form>
    </div>
</div>


<div class="video"></div>
<script src="script.js"></script>
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>

</body>
</html>

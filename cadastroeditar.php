
<?php
// Incluir arquivo de configuração
include("config.php");

$sql = "SELECT * FROM clientes WHERE id = 1"; // Supondo que o usuário que você deseja editar tenha ID 1

// Executar a consulta
$result = $conexao->query($sql);

$row = $result->fetch_assoc();


// Fechar a conexão com o banco de dados
$conexao->close();
?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
    <link rel="stylesheet" href="cadastrostyleeditar.css">
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
            <h5>EDITAR CADASTRO</h5>
            <p>INSIRA OS DADOS MANUALMENTE</p>
        </div>

    <!-- Como da mesma maneira que fizemos no edita.php -->
    <!--o meotod POST solicita que o servidor web aceite os dados anexados no corpo da mensagem de requisição para armazenamento -->
    <!-- o required  torna o preenchimento desse campo obrigatório para que o formulário seja submetido -->
    <form action="update.php" method="POST">

        <div class="input-box">
            <input type="hidden" name="acao" value="editar">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        </div>

        <div class="input-box">
            <label ><B>NOME:</B></label>
            <input type="text" name="nome" value="<?php echo $row['nome']; ?>" ><br>
        </div>
        
        <div class="input-box">
            <label ><B>SOBRENOME:</B></label>
            <input type="text" name="sobrenome" value="<?php echo $row['sobrenome']; ?>"  ><br>
        </div>

        <div class="input-box">
            <label ><B>E-MAIL:</B></label>
            <input type="text" name="email" value="<?php echo $row['email']; ?>"  ><br>
        </div>
        
        <div class="input-box">
            <label ><B>CPF:</B></label>
            <input type="text" id="cpf" name="cpf" maxlength="14" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" title="Informe um CPF válido (somente números)." value="<?php echo $row['cpf']; ?>"  ><br>
        </div>

        <div class="input-box">
            <label ><B>TELEFONE:</B></label>
            <input type="int" name="tel" value="<?php echo $row['tel']; ?>"  ><br>
        </div>

        <div class="input-box">
            <label ><B>SENHA:</B></label>
            <input type="text" name="senha" value="<?php echo $row['senha']; ?>"  ><br>
        </div>

        <div class="btn-box">
                <input type="submit" value="Atualizar">
                <button class="voltar"><a href="cadastroindex.php">Voltar</a></button>
            </div>
    </form>
    </div>
</div>


<div class="video"></div>
<script src="cadastroscripit.js"></script>
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

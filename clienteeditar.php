<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Obtém informações do cliente
$id = $_SESSION['id'];
$stmt = $conexao->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os novos dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $tel = $_POST['tel'];

    // Atualiza os dados do cliente no banco de dados
    $stmt = $conexao->prepare("UPDATE clientes SET nome=?, sobrenome=?, email=?, cpf=?, tel=? WHERE id=?");
    $stmt->bind_param("sssssi", $nome, $sobrenome, $email, $cpf, $tel, $_SESSION['id']);
    $stmt->execute();
    $stmt->close();

    // Redireciona de volta para o perfil do cliente
    header("Location: perfil_cliente.php");
    exit();
}
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <div class="input-box">
            <input type="hidden" name="acao" value="editar">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        </div>

        <div class="input-box">
            <label >NOME:</label>
            <input type="text" name="nome" value="<?php echo $row['nome']; ?>" ><br>
        </div>

        <div class="input-box">
            <label >SOBRENOME:</label>
            <input type="text" name="sobrenome" value="<?php echo $row['sobrenome']; ?>"  ><br>
        </div>

        <div class="input-box">
            <label >CPF:</label>
            <input type="int" name="cpf" value="<?php echo $row['cpf']; ?>"  ><br>
        </div>
        

        <div class="input-box">
            <label >E-MAIL:</label>
            <input type="text" name="email" value="<?php echo $row['email']; ?>"  ><br>
        </div>
        
        <div class="input-box">
            <label >TELEFONE:</label>
            <input type="int" name="tel" value="<?php echo $row['tel']; ?>"  ><br>
        </div>

        <div class="input-box">
            <label >SENHA:</label>
            <input type="text" name="senha" value="<?php echo $row['senha']; ?>"  ><br>
        </div>

        <div class="btn-box">
            <div class="inline-buttons">
                <input type="submit" value="Atualizar">
                <button class="excluir"><a href="clienteconfirmarexcluir.php">EXCLUIR</a></button>
            </div>
            <div class="center">
        <button class="voltar"><a href="perfil_cliente.php">Voltar</a></button>
    </div>
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

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
            <input type="text" id="cpf" name="cpf" maxlength="14" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" title="Informe um CPF válido (somente números)." value="<?php echo $row['cpf']; ?>"  ><br>
        </div>
        

        <div class="input-box">
            <label >E-MAIL:</label>
            <input type="text" name="email" value="<?php echo $row['email']; ?>"  ><br>
        </div>
        
        <div class="input-box">
            <label >TELEFONE:</label>
            <input type="text" id="tel" name="tel" required maxlength="15" pattern="[0-9]{2}\ [0-9]{4,5}-[0-9]{4}" title="Informe um telefone válido (somente números).">
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
<script>
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,'');
    if(cpf == '') return false;
    // Elimina CPFs invalidos conhecidos
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
            return false;
    // Valida 1o digito
    let add = 0;
    for (let i=0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    let rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    // Valida 2o digito
    add = 0;
    for (let i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('cpf').addEventListener('input', function() {
        let cpf = this.value.replace(/\D/g, '');
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        this.value = cpf;
    });

    document.getElementById('tel').addEventListener('input', function() {
    let tel = this.value.replace(/\D/g, '');
    tel = tel.replace(/^(\d{2})(\d)/g, '($1) $2');
    tel = tel.replace(/(\d)(\d{4})$/, '$1-$2');
    this.value = tel;
});

    document.querySelector('form').addEventListener('submit', function(event) {
        let cpf = document.getElementById('cpf').value;
        if (cpf.trim() !== '') { // Verifica se o campo CPF está preenchido
            if (!validarCPF(cpf)) { // Valida CPF
                alert("CPF inválido!");
                event.preventDefault(); // Impede o envio do formulário
            } else {
                alert("Parabéns, cadastro atualizado!");
            }
        }
    });
});

</script>
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

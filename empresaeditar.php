<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Obtém informações da empresa
$id = $_SESSION['id'];
$stmt = $conexao->prepare("SELECT * FROM empresas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os novos dados do formulário
    $razao_social = $_POST['razao_social'];
    $nome_fantasia = $_POST['nome_fantasia'];
    $email = $_POST['email'];
    $cnpj = $_POST['cnpj'];
    $tel = $_POST['tel'];

    // Atualiza os dados da empresa no banco de dados
    $stmt = $conexao->prepare("UPDATE empresas SET RazaoSoci=?, NomeFanta=?, email=?, cnpj=?, tel=? WHERE id=?");
    $stmt->bind_param("sssssi", $razao_social, $nome_fantasia, $email, $cnpj, $tel, $_SESSION['id']);
    $stmt->execute();
    $stmt->close();

    // Redireciona de volta para o perfil da empresa
    header("Location: perfil_empresa.php");
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
        <label for="razao_social"><B>RAZÃO SOCIAL:</B></label>
        <input type="text" name="razao_social" id="razao_social" value="<?php echo $row['RazaoSoci']; ?>"><br>
    </div>
    
    <div class="input-box">
        <label for="nome_fantasia"><b>NOME FANTASIA: </b></label>
        <input type="text" name="nome_fantasia" id="nome_fantasia" value="<?php echo $row['NomeFanta']; ?>"><br>
    </div>
    
    <div class="input-box">
        <label for="cnpj"><b>CNPJ:</b> </label>
        <input type="text" id="cnpj" name="cnpj" maxlength="18" pattern="[0-9]{2}\.[0-9]{3}\.[0-9]{3}/[0-9]{4}-[0-9]{2}" title="Informe um CNPJ válido (somente números)." value="<?php echo $row['cnpj']; ?>"><br>
    </div>

    <div class="input-box">
        <label for="email"><b>E-MAIL:</b> </label>
        <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>"><br>
    </div>

    <div class="input-box">
        <label for="tel"><b>TELEFONE:</b></label>
        <input type="text" name="tel" id="tel" value="<?php echo $row['tel']; ?>"><br>
    </div>

    <div class="btn-box">
            <div class="inline-buttons">
                <input type="submit" value="Atualizar">
                <button class="excluir"><a href="empresaconfirmarexcluir.php">EXCLUIR</a></button>
            </div>
            <div class="center">
        <button class="voltar"><a href="perfil_empresa.php">Voltar</a></button>
    </div>
</form>
    </div>
</div>


<div class="video"></div>
<script>
    function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g,'');
    if(cnpj == '') return false;
    if (cnpj.length != 14)
        return false;
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
            return false;
    // Valida DVs
    let tamanho = cnpj.length - 2;
    let numeros = cnpj.substring(0,tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('cnpj').addEventListener('input', function() {
        let cnpj = this.value.replace(/\D/g, '');
        cnpj = cnpj.replace(/^(\d{2})(\d)/, '$1.$2');
        cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        cnpj = cnpj.replace(/\.(\d{3})(\d)/, '.$1/$2');
        cnpj = cnpj.replace(/(\d{4})(\d)/, '$1-$2');
        this.value = cnpj;
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        let cnpj = document.getElementById('cnpj').value;
        if (cnpj.trim() !== '') { // Verifica se o campo CNPJ está preenchido
            if (!validarCNPJ(cnpj)) { // Valida CNPJ
                alert("CNPJ inválido!");
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

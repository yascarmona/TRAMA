<?php
include_once('config.php');

// Inicializa a variável de mensagem
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];    
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];    
    $data_agendamento = $_POST['data_agendamento'];

    // prepara a declaração SQL para evitar SQL injection
    $sql = "INSERT INTO agendamento (nome, email, telefone, endereco, data_agendamento) VALUES  ('$nome', '$email', '$telefone', '$endereco', '$data_agendamento')";
   
    if ($conexao->query($sql) === TRUE) {
        // Configura a mensagem de sucesso
        $message = "Agendamento realizado com sucesso! Clique em OK para ver os detalhes.";

        // Obtém o ID do último registro inserido
        $agendamento_id = $conexao->insert_id;

        // Define o link para os detalhes do agendamento
        $details_link = "agendamentodetalhes.php?id=" . $agendamento_id;
    } else {
        // Configura a mensagem de erro
        $message = "Erro: " . $conexao->error;
    }    
    //Encerra conexão com o bd
    $conexao->close();
    
}
?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
    <link rel="stylesheet" href="cadastrostyle.css">
    <link rel="icon" href="trama_logo_small.svg">
    <script>
        // Função para exibir o alerta com o botão para ver detalhes
        function showAlert(message, detailsLink) {
            // Cria o alerta com a mensagem e o botão
            var alertMessage = message;

            // Exibe o alerta
            alert(alertMessage);

            // Redireciona para a página de detalhes após clicar em "OK"
            window.location.href = detailsLink;
        }
    </script>
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
        <h5>AGENDAMENTO DE VISITA</h5>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
            <div class="input-box">
                <label for="nome"><b>NOME:</b></label>
                <input type="text" id="nome" name="nome" placeholder="Nome" required><br>
            </div>

            <div class="input-box">
                <label for="email"><b>E-MAIL:</b></label>
                <input type="email" id="email" name="email" placeholder="Email" required><br>
            </div>

            <div class="input-box">
                <label for="tel"><b>TELEFONE:</b></label>
                <input type="text" id="telefone" name="telefone" placeholder="Telefone" required max="15" pattern="[0-9]{2}\ [0-9]{4,5}-[0-9]{4}"title="Informe um telefone válido (somente números)."><br> 
            </div>

            <div class="input-box">
                <label for="endereco"><b>ENDEREÇO:</b></label>
                <input type="text" id="endereco" name="endereco" placeholder="Endereço" required><br>
            </div>

            <div class="input-box">
                <label for="data">DATA DA VISITA:</label>
                <input type="date" id="data_agendamento" name="data_agendamento" placeholder="Data" required><br><br>
            </div>

            <div class="btn-box">
                <input type="submit" value="Agendar" class="salvar">
                <button class="voltar"><a href="perfil_empresa.php">Voltar</a></button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('tel').addEventListener('input', function() {
    let tel = this.value.replace(/\D/g, '');
    tel = tel.replace(/^(\d{2})(\d)/g, '($1) $2');
    tel = tel.replace(/(\d)(\d{4})$/, '$1-$2');
    this.value = tel;
});
</script>

<!-- Exibe a mensagem de sucesso ou erro -->
<?php if (!empty($message)): ?>
    <script>
        // Chama a função showAlert após a página ser completamente carregada
        window.onload = function() {
            showAlert("<?php echo $message; ?>", "<?php echo $details_link; ?>");
        };
    </script>
<?php endif; ?>

</body>
</html>

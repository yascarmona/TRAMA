<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
    <link rel="stylesheet" href="agendamentodetalhestyle.css">
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
<?php
// Inclui o arquivo de configuração do banco de dados
include_once('config.php');

// Verifica se foi fornecido um ID na URL
if(isset($_GET['id'])) {
    // Obtém o ID do agendamento da URL
    $id = $_GET['id'];
    
    // Consulta ao banco de dados para recuperar os detalhes do agendamento com o ID fornecido
    $sql = "SELECT * FROM agendamento WHERE id = $id";
    $result = $conexao->query($sql);

    // Verifica se há resultados na consulta
    if ($result->num_rows > 0) {
        // Obtém os dados do agendamento encontrados
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $email = $row['email'];
        $telefone = $row['telefone'];
        $endereco = $row['endereco'];
        $data_agendamento = $row['data_agendamento'];
        
        // Exibe os detalhes do agendamento
        echo "<div class='details-container'>";
        echo "<div class='detail'><h5>DETALHES DO AGENDAMENTO</h5></div>";
        echo "<div class='detail'><strong>Nome:</strong> $nome</div>";
        echo "<div class='detail'><strong>Email:</strong> $email</div>";
        echo "<div class='detail'><strong>Telefone:</strong> $telefone</div>";
        echo "<div class='detail'><strong>Endereço:</strong> $endereco</div>";
        echo "<div class='detail'><strong>Data:</strong> $data_agendamento</div>";
        echo "<div class='detail'><strong>Status:</strong> Pendente</div>";
        echo "</div>";
        
        // Adiciona um botão para voltar para a página inicialecho '<button class="voltar-button" onclick="window.location.href = \'index.php\';">Voltar para a página inicial</button>';
        echo '<button class="voltar-button" onclick="window.location.href = \'index.html\';">Página Inicial</button>';
 
    } else {
        // Se nenhum detalhe for encontrado para o ID fornecido, exibe uma mensagem
        echo "Nenhum detalhe encontrado.";
    }
    
    // Fecha a conexão com o banco de dados
    $conexao->close();
} else {
    // Se nenhum ID foi fornecido na URL, exibe uma mensagem informando isso
    echo "ID não fornecido.";
}
?>
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

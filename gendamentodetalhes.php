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
        echo "<h2>Detalhes do Agendamento</h2>";
        echo "<p><strong>Nome:</strong> $nome</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Telefone:</strong> $telefone</p>";
        echo "<p><strong>Endereço:</strong> $endereco</p>";
        echo "<p><strong>Data:</strong> $data_agendamento</p>";
        echo "<p><strong>Status:</strong> Pendente</p>";
        
        // Adiciona um botão para voltar para a página inicial
        echo '<button onclick="window.location.href = \'index.php\';">Voltar para a página inicial</button>';
        
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

<?php
include_once('config.php');

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
        echo "Operação realizada com sucesso! <br>";
        echo '<button onclick="window.location.href = \'detalhes.php?id=' . $conexao->insert_id . '\';">Ver Detalhes</button>';
    } else {
        echo "Erro: " . $conexao->error;
    }    
    //Encerra conexão com o bd
    $conexao->close();
    
}
?>

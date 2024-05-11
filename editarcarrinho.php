<?php
include_once('config.php');

session_start();

// Verifica se o produto_id e a quantidade foram enviados
if(isset($_POST["produto_id"]) && isset($_POST["quantidade"])) {
    $produto_id = $_POST["produto_id"];
    $quantidade = $_POST["quantidade"];

    // Atualiza a quantidade do produto no carrinho na sessão
    $_SESSION["carrinho"][$produto_id] = $quantidade;

    // Atualiza a quantidade do produto no carrinho no banco de dados
    $stmt = $conexao->prepare("UPDATE carrinho SET quantidade = ? WHERE produto_id = ?");
    $stmt->bind_param("ii", $quantidade, $produto_id);
    if ($stmt->execute()) {
        header("Location: carrinho.php");
        exit();
    } else {
        echo "Erro ao atualizar quantidade do produto no carrinho: " . $stmt->error;
    }
} else {
    echo "Dados incompletos para atualizar quantidade do produto.";
}
?>

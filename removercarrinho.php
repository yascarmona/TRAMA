<?php
include_once('config.php');

session_start();

// Verifica se o produto_id foi enviado
if(isset($_POST["produto_id"])) {
    $produto_id = $_POST["produto_id"];

    // Remove o produto da tabela carrinho no banco de dados
    $stmt = $conexao->prepare("DELETE FROM carrinho WHERE id = ?");
    $stmt->bind_param("i", $produto_id);
    if ($stmt->execute()) {
        // Remove o produto da sessão do carrinho
        $index = array_search($produto_id, $_SESSION["carrinho"]);
        if($index !== false) {
            unset($_SESSION["carrinho"][$index]);
            echo "Produto removido do carrinho com sucesso.";
        } else {
            echo "Erro ao encontrar o produto no carrinho.";
        }
    } else {
        echo "Erro ao remover produto do carrinho: " . $stmt->error;
    }
} else {
    echo "Nenhum produto selecionado para remover.";
}

// Redireciona de volta para a página do carrinho
header("Location: carrinho.php");
exit;
?>

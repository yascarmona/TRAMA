<?php
include_once('config.php');

session_start();

echo "<h1>Meu Carrinho</h1>";

// Verifica se há produtos no carrinho
if(isset($_SESSION["carrinho"]) && count($_SESSION["carrinho"]) > 0) {
    $carrinho_ids = implode(",", array_keys($_SESSION["carrinho"])); // Usamos array_keys para obter apenas os IDs dos produtos

    // Constrói a consulta SQL após definir $carrinho_ids
    $sql = "SELECT * FROM produtos WHERE id IN ($carrinho_ids)";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='item-carrinho'>";
            echo "<img src='" . $row["imagem"] . "' alt=''>";
            echo "<h2>" . $row["nome"] . "</h2>";
            echo "<p>" . $row["marca"] . "</p>";
            echo "<h3>R$ " . $row["preco"] . "</h3>";
            echo "<form action='editarcarrinho.php' method='post'>";
            echo "<input type='hidden' name='produto_id' value='" . $row["id"] . "'>";
            echo "<input type='number' name='quantidade' value='" . $_SESSION["carrinho"][$row["id"]] . "' min='1'>";
            echo "<input type='submit' value='OK'>";
            echo "</form>";
            echo "<a href='removercarrinho.php?produto_id=" . $row["id"] . "' class='excluir'>Remover do Carrinho</a>";
            echo "</div>";
        }
    } else {
        echo "Nenhum produto encontrado no carrinho.";
    }
    

} else {
    echo "Seu carrinho está vazio.";
}

echo "<a href='pedido.php'><button>Finalizar Compra</button></a>";

$conexao->close();
?>

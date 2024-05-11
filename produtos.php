<?php
include_once('config.php');

$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='produtinho'>";
        echo "<img src='" . $row["imagem"] . "' alt=''>";
        echo "<h2>" . $row["nome"] . "</h2>";
        echo "<p>" . $row["marca"] . "</p>";
        echo "<h3>R$ " . $row["preco"] . "</h3>";
        echo "<form action='adicionar_carrinho.php' method='post'>";
        echo "<input type='hidden' name='produto_id' value='" . $row["id"] . "'>";
        echo "<input type='submit' value='Adicionar ao Carrinho'>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "0 resultados";
}
$conexao->close();
?>

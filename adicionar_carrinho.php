<?php
include_once('config.php');

session_start();


if(isset($_POST["produto_id"]) && !empty($_POST["produto_id"])) {
    $produto_id = $_POST["produto_id"];

    // Verifica se o produto já está no carrinho
    if(isset($_SESSION["carrinho"][$produto_id])) {
        $_SESSION["carrinho"][$produto_id] += 1;

    } else {
        $_SESSION["carrinho"][$produto_id] = 1;
    }

   
    $sql = "INSERT INTO carrinho (produto_id, quantidade) VALUES ('$produto_id', 1) ON DUPLICATE KEY UPDATE quantidade = quantidade + 1";
    if ($conexao->query($sql) === TRUE) {
        
        header("Location: produtoslogado.html");
        exit();
    } else {
        
        header("Location: produtoslogado.html?error=db_error");
        exit();
    }
} else {
    
    header("Location: produtoslogado.html");
    exit();
}
?>

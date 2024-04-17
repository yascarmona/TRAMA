<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
    <link rel="stylesheet" href="cadastrostyle.css">
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
            include_once('config.php');

            // o GET envia os dados de um formulário web para processamento atarves do PHP
            if (isset($_GET['idCliente'])) {
                $idCliente = $_GET['idCliente'];

                // atribuimos a sql a intrução delete que tem o objetivo de excluir uma info da tb_relatorio
                $sql = "DELETE FROM cadastro WHERE idCliente = $idCliente";
                // verifica se a instrução foi executada com sucesso ou não
                if ($conexao->query($sql) === TRUE) {
                    echo "Relatório excluído com sucesso.";
                } else {
                    echo "Erro ao excluir o relatório: " . $conexao->error;
                }
            } else {
                echo "ID do relatório não especificado.";
            }
            // encerramos conexao com o bd
            $conexao->close();
        ?>
            <div class="btn-box">
                <button class="voltar"><a href="index.php">Voltar</a></button>
            </div>
        </form>
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

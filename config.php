<?php 
// aqui conseguimos criar uma conexão com nosso banco de dados
    $dbHost = 'Localhost';
    $dbUsername ='root';
    $dbPassword='';
    $dbname = 'trama';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbname);

    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

?>
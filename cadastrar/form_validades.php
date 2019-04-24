<?php
require("../c.php");

$nome = trim($_POST['nome_produto']);
$data = trim($_POST['data_vencimento']);
date_default_timezone_set('America/Sao_Paulo');
$hora_cadastro = date("Y-m-d H:i:s");

$cadastrar = mysqli_query($connect, "INSERT INTO $produtos(nome_produto, validade, hora_cadastro) VALUES('$nome', '$data', '$hora_cadastro')");

if ($cadastrar) {
    echo "Cadastrado com sucesso!";
}else{
    echo "Ocorreu um erro!";
}
?>
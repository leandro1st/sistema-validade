<?php
require("../c.php");

$nome = trim($_POST['nome_produto']);
$data = trim($_POST['data_vencimento']);
date_default_timezone_set('America/Sao_Paulo');
$hora_cadastro = date("Y-m-d H:i:s");

if ($nome == "" || $data < "2019-01-01" || $data > "2099-12-31" || $data == "0000-00-00") {
    echo "0";
} else{
    echo "1";
    $cadastrar = mysqli_query($connect, "INSERT INTO $produtos(nome_produto, validade, hora_cadastro) VALUES('$nome', '$data', '$hora_cadastro')");
} ?>
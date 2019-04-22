<?php
require("../c.php");

$nome = trim($_POST['nome_produto']);
$data = trim($_POST['data_vencimento']);

$cadastrar = mysqli_query($connect, "INSERT INTO $produtos(nome_produto, validade) VALUES('$nome', '$data')");

if ($cadastrar) {
    echo "Cadastrado com sucesso!";
}else{
    echo "Ocorreu um erro!";
}
?>
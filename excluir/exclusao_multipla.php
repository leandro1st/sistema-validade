<?php
require("../externo/c.php");
// print_r($_POST['check_list']);

if (isset($_POST['check_list'])) {
    foreach ($_POST['check_list'] as $item) {
        $pesquisar = mysqli_query($connect, "SELECT * FROM $vencimentos WHERE id = '$item'");
        $vetor_produto = mysqli_fetch_array($pesquisar);
        $nome_produto = $vetor_produto['nome_produto'];
        $validade = $vetor_produto['validade'];
        $id = $vetor_produto['id'];
        date_default_timezone_set('America/Sao_Paulo');
        $hora_cadastro = $vetor_produto['hora_cadastro'];
        $hora_exclusao = date("Y-m-d H:i:s");

        $excluir = mysqli_query($connect, "DELETE FROM $vencimentos WHERE id = '$item'");
        $add_exclusao = mysqli_query($connect, "INSERT INTO $excluidos(nome_produto, validade, hora_cadastro, hora_exclusao, id) VALUES('$nome_produto', '$validade', '$hora_cadastro', '$hora_exclusao', '$id')");
    }
}

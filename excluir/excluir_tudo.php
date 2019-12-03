<?php
require("../c.php");

$pesquisar = mysqli_query($connect, "SELECT * FROM $produtos");
$numero_pesquisa = mysqli_num_rows($pesquisar);
//Excluindo 1 por 1
for ($i = 0; $i < $numero_pesquisa; $i++) {
    $vetor_produto = mysqli_fetch_array($pesquisar);
    $vetor_nome_produto = $vetor_produto['nome_produto'];
    $vetor_validade = $vetor_produto['validade'];
    $vetor_id = $vetor_produto['id'];
    date_default_timezone_set('America/Sao_Paulo');
    $hora_cadastro = $vetor_produto['hora_cadastro'];
    $hora_exclusao = date("Y-m-d H:i:s");

    $excluir_1 = mysqli_query($connect, "DELETE FROM $produtos WHERE id = $vetor_id");
    $add_exclusao = mysqli_query($connect, "INSERT INTO $excluidos(nome_produto, validade, hora_cadastro, hora_exclusao, id) VALUES('$vetor_nome_produto', '$vetor_validade', '$hora_cadastro', '$hora_exclusao', '$vetor_id')");
}
if ($pesquisar) {
    echo "Todos os registros foram excluídos!";
} else {
echo "Ocorreu um erro!";
}
?>
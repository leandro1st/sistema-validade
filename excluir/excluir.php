<?php
require("../c.php");
// $nome = $_POST['nome_produto'];
$cod_produto = $_POST['cod_produto'];

$pesquisar = mysqli_query($connect, "SELECT * FROM $produtos WHERE id = '$cod_produto'");
$vetor_produto = mysqli_fetch_array($pesquisar);
$vetor_nome_produto = $vetor_produto['nome_produto'];
$vetor_validade = $vetor_produto['validade'];
$vetor_id = $vetor_produto['id'];
date_default_timezone_set('America/Sao_Paulo');
$hora_cadastro = $vetor_produto['hora_cadastro'];
$hora_exclusao = date("Y-m-d H:i:s");

$numero_pesquisa = mysqli_num_rows($pesquisar);
if ($numero_pesquisa > 0){
    $excluir = mysqli_query($connect, "DELETE FROM $produtos WHERE id = '$cod_produto'");
    $add_exclusao = mysqli_query($connect, "INSERT INTO $excluidos(nome_produto, validade, hora_cadastro, hora_exclusao, id) VALUES('$vetor_nome_produto', '$vetor_validade', '$hora_cadastro', '$hora_exclusao', '$vetor_id')");
} else{
    ?>
        <script>
            alert("Ocorreu um erro!");
        </script>
    <?php
}
?>
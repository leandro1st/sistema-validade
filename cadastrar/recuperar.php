<?php
require("../c.php");
// $nome = $_POST['nome_produto'];
$cod_produto = $_POST['cod_produto'];

$pesquisar = mysqli_query($connect, "SELECT * FROM $excluidos WHERE id = '$cod_produto'");
$vetor_produto = mysqli_fetch_array($pesquisar);
$vetor_nome_produto = $vetor_produto['nome_produto'];
$vetor_validade = $vetor_produto['validade'];
$vetor_id = $vetor_produto['id'];
$hora_cadastro = $vetor_produto['hora_cadastro'];

$numero_pesquisa = mysqli_num_rows($pesquisar);
if ($numero_pesquisa > 0){
    $excluir = mysqli_query($connect, "DELETE FROM $excluidos WHERE id = '$cod_produto'");
    $recuperar = mysqli_query($connect, "INSERT INTO $produtos(nome_produto, validade, hora_cadastro, id) VALUES('$vetor_nome_produto', '$vetor_validade', '$hora_cadastro', '$vetor_id')");
} else{
    ?>
        <script>
            alert("Ocorreu um erro!");
        </script>
    <?php
}
?>
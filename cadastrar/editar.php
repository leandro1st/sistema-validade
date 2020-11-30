<?php
require("../externo/c.php");
// $nome = $_POST['nome_produto'];
$vencimento = $_POST['validade'];
$cod_produto = $_POST['cod_produto'];

$pesquisar = mysqli_query($connect, "SELECT * FROM $vencimentos WHERE id = '$cod_produto'");
$vetor_produto = mysqli_fetch_array($pesquisar);
$vetor_nome = $vetor_produto['nome_produto'];
$vetor_validade = $vetor_produto['validade'];

$numero_pesquisa = mysqli_num_rows($pesquisar);
if ($numero_pesquisa > 0) {
    $editar = mysqli_query($connect, "UPDATE vencimentos SET validade = '$vencimento' WHERE id = '$cod_produto'");
} else {
    ?>
    <script>
        alert("Ocorreu um erro!");
    </script>
<?php
}
?>
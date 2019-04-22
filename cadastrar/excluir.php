<?php
require("../c.php");
// $nome = $_POST['nome_produto'];
$cod_produto = $_POST['cod_produto'];

$pesquisar = mysqli_query($connect, "SELECT * FROM $produtos WHERE id = '$cod_produto'");
$numero_pesquisa = mysqli_num_rows($pesquisar);
if ($numero_pesquisa > 0){
    $excluir = mysqli_query($connect, "DELETE FROM $produtos WHERE id = '$cod_produto'");
} else{
    ?>
        <script>
            alert("Ocorreu um erro!");
        </script>
    <?php
}
?>
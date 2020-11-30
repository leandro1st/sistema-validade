<?php
require("../externo/c.php");
$cod_produto = $_POST['cod_produto'];
$excluir = mysqli_query($connect, "DELETE FROM $excluidos WHERE id = '$cod_produto'");
?>
<?php
require("../c.php");
$cod_produto = $_POST['cod_produto2'];
$excluir = mysqli_query($connect, "DELETE FROM $excluidos WHERE id = '$cod_produto'");
?>
<?php
require("../c.php");

$excluir_tudo = mysqli_query($connect, "DELETE FROM $produtos");

if ($excluir_tudo) {
    echo "Todos os registros foram excluídos!";
} else {
echo "Ocorreu um erro!";
}
?>

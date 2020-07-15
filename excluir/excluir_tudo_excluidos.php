<?php
require("../externo/c.php");

$excluir_tudo = mysqli_query($connect, "DELETE FROM $excluidos");
if ($excluir_tudo) {
    echo "Todos os registros foram excluídos!";
} else {
echo "Ocorreu um erro!";
}
?>
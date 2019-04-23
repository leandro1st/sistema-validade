<?php
require("../c.php");

$excluir_tudo = mysqli_query($connect, "DELETE FROM $produtos");
if ($excluir_tudo) {
    ?>
    <script>
        alert("Todos os registros foram excluídos!");
        document.location.href = "../";
    </script>
<?php } else {  ?>
    <script>
        alert("Ocorreu um erro!");
        document.location.href = "../";
    </script>
<?php
}
?>
<?php
if (isset($_POST['barcode'])) {
    require('../externo/c.php');
    
    $barcode = trim($_POST['barcode']);
    
    $pesquisa_produto = mysqli_query($connect, "SELECT * FROM $produtos WHERE $cod_barras1 = '$barcode' or $cod_barras2 = '$barcode'");
    $vetor_produto = mysqli_fetch_array($pesquisa_produto);
    
    if (isset($vetor_produto)) {
        // data
        echo $vetor_produto[0] . "|" . $vetor_produto[1] . "|" . $vetor_produto[2];
    }
} else {
    header("location: ../");
}

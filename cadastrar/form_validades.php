<?php
require("c.php");

$nome = trim($_POST['nome_produto']);
$data = trim($_POST['data_vencimento']);

$cadastrar = mysqli_query($connect, "INSERT INTO $produtos(nome_produto, validade) VALUES('$nome', '$data')");

if ($cadastrar) {
    ?><script>
        // alert("Cadastrado com sucesso!");
        // document.location.href = "cadastrar.php";
    </script>
    <?php
    echo "1";
}else{
    ?><script>
        // alert("Erro ao cadastrar!");
        // document.location.href = "cadastrar.php";
    </script>
    <?php
    echo "0";
}
?>
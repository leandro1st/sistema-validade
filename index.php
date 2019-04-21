<?php
require("c.php");
$pesquisar_produtos = mysqli_query($connect, "SELECT * FROM $produtos");
$numero_produtos = mysqli_num_rows($pesquisar_produtos);
// echo $numero_produtos;
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validades</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><i class="far fa-calendar-alt" style="font-size: 35px;"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastrar/cadastrar.php">Cadastrar</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="pesquisa/pesquisar.php" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav><br>
    <main class="container">
        <h1 class="text-center">Validades</h1><br>
        <table class="table table-bordered">
            <thead class="thead-light" style="font-size:20px">
                <tr class="text-center">
                    <th scope="col" width="10%">#</th>
                    <th scope="col">Produto</th>
                    <th scope="col" width="20%">Validade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < $numero_produtos; $i++) {
                    $vetor = mysqli_fetch_assoc($pesquisar_produtos);
                    $vetor_produto = $vetor['nome_produto'];
                    $vetor_validade = $vetor['validade'];
                    $vetor_id = $vetor['id'];
                    ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                        <td><?php echo $vetor_produto ?></td>
                        <td class="text-center"><?php echo date("d-m-Y", strtotime($vetor_validade)) ?></td>
                    </tr>
                <?php }
            ?>
            </tbody>
        </table>
    </main>
</body>

</html>
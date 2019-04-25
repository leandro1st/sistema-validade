<?php
require("../c.php");

$produto = trim($_POST['nome_pesquisa']);
$pesquisar = mysqli_query($connect, "SELECT * FROM $produtos WHERE $nome_produto like '%" . $produto . "%' or DATE_FORMAT(validade, '%d/%m/%Y') like '%" . $produto . "%' ORDER BY validade ASC");
$numero_produto = mysqli_num_rows($pesquisar);
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesquisar</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../">
            <img src="../imagens/logo.png" alt="logo" width="35px">
            <!-- <i class="far fa-calendar-alt" style="font-size: 35px;"></i> -->
        </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../cadastrar/cadastrar.php">Cadastrar</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#"><i class="fas fa-search" style="font-size: 18px"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="pesquisar.php" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>
    <header class="jumbotron" style="padding: 2.5em">
        <h1 class="text-center">Validades</h1>
    </header>
    <main class="container">
        <h4>Resultados: <small><?php echo $produto ?></small></h4>
        <?php
        if ($numero_produto == 1) {
            echo "<b>" . $numero_produto . "</b> encontrado";
        } else {
            echo "<b>" . $numero_produto . "</b> encontrados";
        }
        ?><br><br>
        <table class="table table-bordered">
            <thead class="thead-light" style="font-size:20px">
                <tr class="text-center">
                    <th scope="col" width="10%">#</th>
                    <th scope="col">Produto</th>
                    <th scope="col" width="20%">Validade</th>
                    <th scope="col" width="20%">Data do cadastro</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numero_produto > 0) {
                    for ($i = 0; $i < $numero_produto; $i++) {
                        $vetor = mysqli_fetch_array($pesquisar);
                        $vetor_produto = $vetor['nome_produto'];
                        $vetor_validade = $vetor['validade'];
                        $vetor_hora_cadastro = $vetor['hora_cadastro'];
                        $vetor_id = $vetor['id'];
                        if (date('d-m-Y') == date("d-m-Y", strtotime($vetor_validade))) { ?>
                            <tr id="linha-<?php echo $vetor_id ?>" class="bg-warning">
                                <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                                <td><?php echo $vetor_produto ?></td>
                                <td class="text-center"><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                                <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_cadastro)) ?></td>
                            </tr>
                        <?php
                    } else { ?>
                            <tr id="linha-<?php echo $vetor_id ?>">
                                <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                                <td><?php echo $vetor_produto ?></td>
                                <td class="text-center"><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                                <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_cadastro)) ?></td>
                            </tr>
                            </form>
                        <?php }
                }
            } else { ?>
                    <script>
                        alert("Nada encontrado!");
                        document.location.href = "../";
                    </script>
                <?php }
            ?>
            </tbody>
        </table>
    </main>
</body>

</html>
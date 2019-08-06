<?php
require("../c.php");

date_default_timezone_set('America/Sao_Paulo');
$produto = trim($_POST['nome_pesquisa']);
$pesquisar = mysqli_query($connect, "SELECT * FROM $produtos WHERE $nome_produto like '%" . $produto . "%' or DATE_FORMAT(validade, '%d/%m/%Y') like '%" . $produto . "%' ORDER BY validade ASC");
$numero_produto = mysqli_num_rows($pesquisar);
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php
        if ($produto != "" || $produto != null) {
            echo "Pesquisa | " . $produto;
        } else {
            echo "Pesquisa";
        }
        ?>
    </title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../jquery/jquery-3.4.0.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        .underline {
            border-bottom: 3px solid #4EBA6F;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            font-family: "Font Awesome 5 Free";
            content: "\f105";
            font-weight: 900;
            color: #4EBA6F;
        }

        a:link {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../">
            <img src="../imagens/logo.png" alt="logo" width="35px">
            <!-- <i class="far fa-calendar-alt" style="font-size: 35px;"></i> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item px-1">
                    <a class="nav-link" href="../"><i class="fas fa-home" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link text-success" href="../cadastrar/cadastrar.php">Cadastrar <i class="fas fa-plus-circle text-success" style="font-size: 24px; vertical-align: middle"></i> </a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../cadastrar/excluidos.php"><i class="fas fa-trash-alt" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1 active underline">
                    <a class="nav-link" href="#"><i class="fas fa-search" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="pesquisar.php" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>
    <nav aria-label="breadcrumb" style="position: absolute">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li class="breadcrumb-item active"><a href="#" class="none_li"><i class="fas fa-search"></i>
                <?php if ($produto != "" || $produto != null) {
                    echo "Pesquisa | " . $produto;
                } else {
                    echo "Pesquisa";
                } ?>
            </a></li>
        </ol>
    </nav>
    <?php
    if ($numero_produto > 0) { ?>
        <header class="jumbotron" style="padding: 2.5em">
            <h1 class="text-center">Validades</h1>
        </header>
        <main class="container">
            <h4>Resultados: <small><?php echo $produto ?></small></h4>
            <p class="lead">
                <?php if ($numero_produto == 1) {
                    echo "<b>" . $numero_produto . "</b> encontrado";
                } else {
                    echo "<b>" . $numero_produto . "</b> encontrados";
                } ?>
            </p>
            <table class="table table-bordered table-hover">
                <thead class="thead-light" style="font-size:20px">
                    <tr class="text-center">
                        <th scope="col" width="8%">#</th>
                        <th scope="col">Produto</th>
                        <th scope="col" width="20%">Validade</th>
                        <th scope="col" width="20%">Data do cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < $numero_produto; $i++) {
                        $vetor = mysqli_fetch_array($pesquisar);
                        $vetor_produto = $vetor['nome_produto'];
                        $vetor_validade = $vetor['validade'];
                        $vetor_hora_cadastro = $vetor['hora_cadastro'];
                        $vetor_id = $vetor['id'];
                        if (date('d-m-Y') == date("d-m-Y", strtotime($vetor_validade))) { ?>
                            <tr id="linha-<?php echo $vetor_id ?>" class="bg-warning">
                                <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                                <td style="max-width: 600px; word-wrap: break-word;"><?php echo $vetor_produto ?></td>
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
                    } ?>
                </tbody>
            </table>
        </main><br><br><br><br><br><br><br>
    <?php } else { ?>
        <header class="jumbotron" style="padding: 2.5em">
            <h1 class="text-center">Validades</h1>
        </header>
        <main class="container">
            <h4>Resultados: <small><?php echo $produto ?></small></h4>
            <p class="lead"><?php echo "<b>" . $numero_produto . "</b> encontrado" ?></p>
        </main>
        <script>
            var nome = "<?php echo $produto ?>";
            alert(nome + " não encontrado!");
            document.location.href = "../";
        </script>
    <?php } ?>
    <br>
    <!-- Footer -->
    <footer class="footer">
        <!-- Footer Elements -->
        <div style="background-color: #3e4551; padding: 16px">
            <center>
                <div class="row" style="display: inline-block">
                    <a href="https://www.facebook.com/sakamototen/" class="btn-social btn-facebook" style="margin-right: 40px;"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://github.com/leandro1st" class="btn-social btn-github" style="margin-right: 40px;"><i class="fab fa-github"></i></a>
                    <a href="https://www.instagram.com/sakamototen/" class="btn-social btn-instagram" style="margin-right: 40px;"><i class="fab fa-instagram"></i></a>
                </div>
            </center>
        </div>
        <!-- Footer Elements -->
        <!-- Copyright -->
        <div class="text-center" style="background-color: #323741; padding: 16px; color: #dddddd">©
            2019 Copyright –
            <a href="https://sakamototen.com.br/" style="text-decoration: none"> SakamotoTen – Produtos Orientais e
                Naturais</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>
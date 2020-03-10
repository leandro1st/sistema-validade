<?php
require("../c.php");

date_default_timezone_set('America/Sao_Paulo');
$produto = trim($_POST['nome_pesquisa']);
$pesquisar = mysqli_query($connect, "SELECT * FROM $produtos WHERE $nome_produto like '%" . $produto . "%' or DATE_FORMAT(validade, '%d/%m/%Y') like '%" . $produto . "%' or id like '%" . $produto . "%' ORDER BY validade ASC");
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
    <script>
        /* Ao clicar no ícone de editar, executa a seguinte função que oculta a validade antiga e mostra um input */
        function editar(id) {
            // alert(id);
            document.getElementById('editar_validade-' + id + '').style.display = 'inline';
            document.getElementById('editar_validade-' + id + '').focus();
            document.getElementById('validade_editada-' + id + '').style.display = 'none';
        } /* Ao clicar no ícone de editar, executa a seguinte função que oculta a validade antiga e mostra um input */

        /* Data de hoje */
        var hoje = new Date();
        var dd = String(hoje.getDate()).padStart(2, '0');
        var mm = String(hoje.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = hoje.getFullYear();
        hoje = yyyy + '-' + mm + '-' + dd; /* Data de hoje */

        /* Função que ao perder o foco do input, oculta o input e retorna a validade editada, ao final executa o ajax */
        function mouse(id, produto, validade_antiga) {
            var validade_nova = $('#editar_validade-' + id).val();
            if (validade_nova == hoje) {
                var arr = validade_nova.split("-");
                document.getElementById('editar_validade-' + id + '').style.display = 'none';
                document.getElementById('editar_validade-' + id + '').className = 'form-control is-valid';
                document.getElementById('validade_editada-' + id + '').style.display = 'inline';
                document.getElementById('validade_editada-' + id + '').value = arr[2] + "/" + arr[1] + "/" + arr[0];
                document.getElementById('linha-' + id + '').className = 'bg-warning';
                $.ajax({
                    method: 'POST',
                    url: '../cadastrar/editar.php',
                    data: $('#form-' + id + '').serialize(),
                    success: function(data) {
                        document.getElementById("produto_editado").innerHTML = produto;
                        document.getElementById("validade_antiga").innerHTML = validade_antiga;
                        document.getElementById('validade_nova').innerHTML = arr[2] + "/" + arr[1] + "/" + arr[0];
                        $("#modalEditado").modal('show');
                    },
                    error: function(data) {
                        alert("Ocorreu um erro!");
                    }
                });
            } else if (validade_nova > hoje) {
                var arr = validade_nova.split("-");
                document.getElementById('editar_validade-' + id + '').style.display = 'none';
                document.getElementById('editar_validade-' + id + '').className = 'form-control is-valid';
                document.getElementById('validade_editada-' + id + '').style.display = 'inline';
                document.getElementById('validade_editada-' + id + '').value = arr[2] + "/" + arr[1] + "/" + arr[0];
                document.getElementById('linha-' + id + '').className = '';
                $.ajax({
                    method: 'POST',
                    url: '../cadastrar/editar.php',
                    data: $('#form-' + id + '').serialize(),
                    success: function(data) {
                        document.getElementById("produto_editado").innerHTML = produto;
                        document.getElementById("validade_antiga").innerHTML = validade_antiga;
                        document.getElementById('validade_nova').innerHTML = arr[2] + "/" + arr[1] + "/" + arr[0];
                        $("#modalEditado").modal('show');
                    },
                    error: function(data) {
                        alert("Ocorreu um erro!");
                    }
                });
            } else {
                hoje2 = dd + '/' + mm + '/' + yyyy; /* Data de hoje */
                document.getElementById('editar_validade-' + id + '').style.display = 'none';
                document.getElementById('editar_validade-' + id + '').className = 'form-control is-valid';
                document.getElementById('validade_editada-' + id + '').style.display = 'inline';
                if (validade_nova < validade_antiga) {
                    document.getElementById('validade_editada-' + id + '').value = validade_antiga;
                    document.getElementById("validade_nova").innerHTML = validade_antiga;
                } else if (validade_nova > validade_antiga) {
                    document.getElementById('validade_editada-' + id + '').value = arr[2] + "/" + arr[1] + "/" + arr[0];
                    document.getElementById('validade_nova').innerHTML = arr[2] + "/" + arr[1] + "/" + arr[0];
                } else {
                    document.getElementById('validade_editada-' + id + '').value = arr[2] + "/" + arr[1] + "/" + arr[0];
                    document.getElementById('validade_nova').innerHTML = arr[2] + "/" + arr[1] + "/" + arr[0];
                }
                if (validade_antiga != hoje2 && validade_nova != hoje2) {
                    document.getElementById('linha-' + id + '').className = '';
                }
                
                document.getElementById("id_produto_editado").innerHTML = id;
                document.getElementById("produto_editado").innerHTML = produto;
                document.getElementById("validade_antiga").innerHTML = validade_antiga;
                $("#modalEditado").modal('show');
                //document.getElementById('editar_validade-' + id + '').className = 'form-control is-invalid';
            };
        } /* Função que ao perder o foco do input, oculta o input e retorna a validade editada, ao final executa o ajax */
    </script>
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
                    <a class="nav-link text-success" href="../cadastrar/"><i class="fas fa-edit text-success" style="font-size: 24px; vertical-align: middle"></i> </a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../excluir/"><i class="far fa-trash-alt text-danger" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1 active">
                    <a class="nav-link underline" href="#"><i class="fas fa-search" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="./" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" type="search" placeholder="Nome do produto" aria-label="Search" style="width: 300px; background-color: #eee; border-radius: 9999px; border: none; padding-left: 20px; padding-right: 42px">
                <button type="submit" style="position: absolute; margin-left: 259px; border: none; cursor: pointer"><i class="fas fa-search text-success"></i></button>
            </form>
        </div>
    </nav>
    <nav aria-label="breadcrumb" style="position: absolute; z-index: 10;">
        <ol class="breadcrumb" style="background: none; margin: 0">
            <li class="breadcrumb-item"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li class="breadcrumb-item active">
                <a href="#" class="none_li"><i class="fas fa-search"></i>
                    <?php if ($produto != "" || $produto != null) {
                        echo "Pesquisa | " . $produto;
                    } else {
                        echo "Pesquisa";
                    } ?>
                </a>
            </li>
        </ol>
    </nav>
    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="view">
                    <img class="d-block w-100" src="../imagens/mountain.jpg" alt="First slide">
                </div>
                <div class="carousel-caption">
                    <h1 style="padding-bottom: 10px">Validades</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="view">
                    <img class="d-block w-100" src="../imagens/emilia.png" alt="Second slide">
                </div>
                <div class="carousel-caption">
                    <h1 style="padding-bottom: 10px">Validades</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="view">
                    <img class="d-block w-100" src="../imagens/kimi_no_na.jpg" alt="Third slide">
                </div>
                <div class="carousel-caption">
                    <h1 style="padding-bottom: 10px">Validades</h1>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div><br>
    <?php
    if ($numero_produto > 0) { ?>
        <main class="container">
            <h4>Resultados: <small><a href="#" class="none_li"><?php echo $produto ?></a></small></h4>
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
                        <th scope="col" width="5%"><i class="fas fa-cogs"></i></th>
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
                            <form id="form-<?php echo $vetor_id ?>" method="post">
                                <tr id="linha-<?php echo $vetor_id ?>" class="bg-warning">
                                    <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                                    <td style="max-width: 600px; word-wrap: break-word;"><?php echo $vetor_produto ?></td>
                                    <td class="text-center">
                                        <?php $hj = date("Y-m-d"); ?>
                                        <b id="teste" class="text-danger">
                                            <input id="validade_editada-<?php echo $vetor_id ?>" value="<?php echo date("d/m/Y", strtotime($vetor_validade)) ?>" style="all: unset; cursor: text;" readonly>
                                            <div id="div-vencimento">
                                                <input type="hidden" id="id_produto" name="cod_produto" value="<?php echo $vetor_id ?>">
                                                <input id="editar_validade-<?php echo $vetor_id ?>" name="validade" type="date" class="form-control" min="<?php echo $hj ?>" max="2099-12-31" style="display: none; width: 175px;" required onblur="mouse(<?php echo $vetor_id ?>, '<?php echo $vetor_produto ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')" onkeydown="return event.key != 'Enter';">
                                                <div class="invalid-feedback">
                                                    <?php $hoje = date("d/m/Y"); ?>
                                                    Por favor, digite o data de vencimento! (min: <?php echo $hoje ?> | máx: 31-12-2099)
                                                </div>
                                            </div>
                                        </b>
                                    </td>
                                    <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_cadastro)) ?></td>
                                    <td align="center" class="td_53x53">
                                        <i class="fas fa-edit" style="cursor: pointer; color: green; font-size: 25px;" onclick="editar(<?php echo $vetor_id ?>)"></i>
                                    </td>
                                </tr>
                            </form>
                        <?php
                                } else { ?>
                            <form id="form-<?php echo $vetor_id ?>" method="post">
                                <tr id="linha-<?php echo $vetor_id ?>">
                                    <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                                    <td><?php echo $vetor_produto ?></td>
                                    <td class="text-center">
                                        <?php $hj = date("Y-m-d"); ?>
                                        <b id="teste" class="text-danger">
                                            <input id="validade_editada-<?php echo $vetor_id ?>" value="<?php echo date("d/m/Y", strtotime($vetor_validade)) ?>" style="all: unset; cursor: text;" readonly>
                                            <div id="div-vencimento">
                                                <input type="hidden" id="id_produto" name="cod_produto" value="<?php echo $vetor_id ?>">
                                                <input id="editar_validade-<?php echo $vetor_id ?>" name="validade" type="date" class="form-control" min="<?php echo $hj ?>" max="2099-12-31" style="display: none; width: 175px;" required onblur="mouse(<?php echo $vetor_id ?>, '<?php echo $vetor_produto ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')" onkeydown="return event.key != 'Enter';">
                                                <div class="invalid-feedback">
                                                    <?php $hoje = date("d/m/Y"); ?>
                                                    Por favor, digite o data de vencimento! (min: <?php echo $hoje ?> | máx: 31-12-2099)
                                                </div>
                                            </div>
                                        </b>
                                    </td>
                                    <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_cadastro)) ?></td>
                                    <td align="center" class="td_53x53">
                                        <i class="fas fa-edit" style="cursor: pointer; color: green; font-size: 25px;" onclick="editar(<?php echo $vetor_id ?>)"></i>
                                    </td>
                                </tr>
                            </form>
                    <?php }
                        } ?>
                </tbody>
            </table>
        </main><br><br><br><br><br><br><br><br><br>
    <?php } else { ?>
        <main class="container">
            <h4>Resultados: <small><a href="#" class="none_li"><?php echo $produto ?></a></small></h4>
            <p class="lead"><?php echo "<b>" . $numero_produto . "</b> encontrado" ?></p>
        </main>
        <script>
            var nome = "<?php echo $produto ?>";
            alert(nome + " não encontrado!");
            window.history.go(-1);
        </script>
    <?php } ?>
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

    <!--Modal: modalEditado-->
    <div class="modal fade" id="modalEditado" tabindex="-1" role="dialog" aria-labelledby="modalEditadoTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center bg-success">
                    <h3 class="modal-title w-100 lead" id="exampleModalLongTitle" style="font-size: 26px"><b>Validade alterada</b></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-justify lead">
                    <!-- Mostra mensagem no modal -->
                    <div class="container">
                        <div class="row">
                            <div class="col-4" style="padding-right: 0">Código:</div>
                            <div class="col-8" style="padding: 0"><b id="id_produto_editado"></b></div>
                        </div>
                        <div class="row">
                            <div class="col-4" style="padding-right: 0">Produto:</div>
                            <div class="col-8" style="padding: 0"><b id="produto_editado"></b></div>
                        </div>
                        <div class="row">
                            <div class="col-4" style="padding-right: 0">Validade antiga:</div>
                            <div class="col-8" style="padding: 0"><b id="validade_antiga"></b></div>
                        </div>
                        <div class="row">
                            <div class="col-4" style="padding-right: 0">Validade nova:</div>
                            <div class="col-8" style="padding: 0"><b><span id='validade_nova' class='text-success'></span></b></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal: modalEditado-->
</body>

</html>
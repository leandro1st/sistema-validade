<?php
require("../c.php");
$pesquisar_produtos_excluidos = mysqli_query($connect, "SELECT * FROM $excluidos ORDER BY hora_exclusao ASC");
$numero_excluidos = mysqli_num_rows($pesquisar_produtos_excluidos);
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php
        if ($numero_excluidos == 0) {
            echo "Excluídos | Nenhum registro";
        } else if ($numero_excluidos == 1) {
            echo "Excluídos | " . $numero_excluidos . " registro";
        } else if ($numero_excluidos > 1) {
            echo "Excluídos | " . $numero_excluidos . " registros";
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
        function recuperarProduto(id, produto, validade) {
            document.getElementById("cod_produto").value = id;
            // document.getElementById("nome_produto").value = produto;
            document.getElementById("nome").innerHTML = produto;
            document.getElementById("vencimento").innerHTML = validade;
        }
        var num = "<?php echo $numero_excluidos ?>";

        function recuperar(id) {
            // alert(id);
            $.ajax({
                method: 'POST',
                url: 'recuperar.php',
                data: $('#form_recuperar-' + id + '').serialize(),
                success: function(data) {
                    $('#linha-' + id).fadeOut(300, function() {
                        $('#linha-' + id).remove();
                    });
                    num -= 1;
                    if (num > 1) {
                        document.getElementById("contagem").innerHTML = 'Deseja realmente excluir todos (' + num + ') os registros?';
                        document.getElementById("contagem2").innerHTML = 'Você excluirá ' + num + ' registros!';
                        document.title = "Excluídos | " + num + " registros";
                    } else if (num == 1) {
                        document.getElementById("botao_excluir").innerHTML = 'Excluir';
                        document.getElementById("contagem").innerHTML = 'Deseja realmente excluir o registro?';
                        document.getElementById("contagem2").innerHTML = 'Você excluirá ' + num + ' registro!';
                        document.getElementById("btn_modal_excluir").innerHTML = 'Excluir';
                        document.title = "Excluídos | " + num + " registro";
                    } else if (num == 0) {
                        document.getElementById("sem_dados").innerHTML = 'Não há nenhum registro excluído!';
                        document.getElementById("sem_dados").style.margin = '70px';
                        document.getElementById("sem_dados").className = 'text-center lead';
                        document.getElementById("sem_dados").style.display = 'block';
                        document.getElementById("tabela").innerHTML = '';
                        document.getElementById("botao_excluir").disabled = 'true';
                        document.getElementById("botao_excluir").style.cursor = 'not-allowed';
                        document.getElementById("botao_excluir").title = 'Não há nada para ser excluído!';
                        document.title = "Excluídos | Nenhum registro";
                    }
                },
                error: function(data) {
                    alert("Ocorreu um erro!");
                }
            });
        }

        function excluirProduto(id, produto, validade) {
            document.getElementById("cod_produto2").value = id;
            // document.getElementById("nome_produto").value = produto;
            document.getElementById("nome2").innerHTML = produto;
            document.getElementById("vencimento2").innerHTML = validade;
        }

        function excluir(id) {
            // alert(id);
            $.ajax({
                method: 'POST',
                url: 'excluir_def.php',
                data: $('#form_recuperar-' + id + '').serialize(),
                success: function(data) {
                    $('#linha-' + id).fadeOut(300, function() {
                        $('#linha-' + id).remove();
                    });
                    num -= 1;
                    if (num > 1) {
                        document.getElementById("contagem").innerHTML = 'Deseja realmente excluir todos (' + num + ') os registros?';
                        document.getElementById("contagem2").innerHTML = 'Você excluirá ' + num + ' registros!';
                        document.title = "Excluídos | " + num + " registros";
                    } else if (num == 1) {
                        document.getElementById("botao_excluir").innerHTML = 'Excluir';
                        document.getElementById("contagem").innerHTML = 'Deseja realmente excluir o registro?';
                        document.getElementById("contagem2").innerHTML = 'Você excluirá ' + num + ' registro!';
                        document.getElementById("btn_modal_excluir").innerHTML = 'Excluir';
                        document.title = "Excluídos | " + num + " registro";
                    } else if (num == 0) {
                        document.getElementById("sem_dados").innerHTML = 'Não há nenhum registro excluído!';
                        document.getElementById("sem_dados").className = 'text-center lead';
                        document.getElementById("sem_dados").style.display = 'block';
                        document.getElementById("tabela").innerHTML = '';
                        document.getElementById("botao_excluir").disabled = 'true';
                        document.getElementById("botao_excluir").style.cursor = 'not-allowed';
                        document.getElementById("botao_excluir").title = 'Não há nada para ser excluído!';
                        document.title = "Excluídos | Nenhum registro";
                    }
                },
                error: function(data) {
                    alert("Ocorreu um erro!");
                }
            });
        }

        function excluirTudo() {
            $.ajax({
                method: 'POST',
                url: 'excluir_tudo_excluidos.php',
                data: $('#form_excluirTudo').serialize(),
                async: false,
                success: function(data) {
                    alert(data);
                },
                error: function(data) {
                    alert(data);
                }
            });
        }
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
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

        .td_53x53 {
            width: 53px;
            height: 53px;
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
                <li class="nav-item px-1 active underline">
                    <a class="nav-link" href="#"><i class="fas fa-trash-alt" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="../pesquisa/pesquisar.php" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>
    <nav aria-label="breadcrumb" style="position: absolute; z-index: 1;">
        <ol class="breadcrumb" style="background: none; margin: 0">
            <li class="breadcrumb-item"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li class="breadcrumb-item"><a href="./cadastrar.php"><i class="far fa-file-alt"></i> Cadastro</a></li>
            <li class="breadcrumb-item active"><a href="#" class="none_li"><i class="fas fa-trash-alt"></i> Produtos Excluídos</a></li>
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
                    <h1 style="padding-bottom: 10px">Excluídos</h1>
                    <?php if ($numero_excluidos == "0") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo" style="display: none;">Excluir tudo</button>
                    <?php } else if ($numero_excluidos == "1") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir</button>
                    <?php } else { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir tudo</button>
                    <?php } ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="view">
                    <img class="d-block w-100" src="../imagens/emilia.png" alt="Second slide">
                </div>
                <div class="carousel-caption">
                    <h1 style="padding-bottom: 10px">Excluídos</h1>
                    <?php if ($numero_excluidos == "0") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo" style="display: none;">Excluir tudo</button>
                    <?php } else if ($numero_excluidos == "1") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir</button>
                    <?php } else { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir tudo</button>
                    <?php } ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="view">
                    <img class="d-block w-100" src="../imagens/kimi_no_na.jpg" alt="Third slide">
                </div>
                <div class="carousel-caption">
                    <h1 style="padding-bottom: 10px">Excluídos</h1>
                    <?php if ($numero_excluidos == "0") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo" style="display: none;">Excluir tudo</button>
                    <?php } else if ($numero_excluidos == "1") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir</button>
                    <?php } else { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir tudo</button>
                    <?php } ?>
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
    <main class="container">
        <form id="form_excluirTudo" method="POST">
            <div class="modal fade" id="modalExcluirTudo" tabindex="-1" role="dialog" aria-labelledby="modalExcluirTudoTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalTitle">
                                <?php if ($numero_excluidos == 1) { ?>
                                <font class="text-danger">Deseja realmente excluir o registro?</font>
                                <?php } else { ?>
                                <font class="text-danger" id="contagem">Deseja realmente excluir todos(<?php echo $numero_excluidos ?>) os registros?</font>
                                <?php } ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-9">
                                    <?php if ($numero_excluidos == 1) { ?>
                                    <h6 class="text-warning">Você excluirá 1 registro!</h6>
                                    <?php } else { ?>
                                    <h6 class="text-warning" id="contagem2">Você excluirá <?php echo $numero_excluidos ?> registros!</h6>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btn_modal_excluir" class="btn btn-danger" onclick="excluirTudo()">Excluir tudo</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        if ($numero_excluidos == 0) { ?>
        <p class="text-center lead" style="font-size: 1.75rem; margin: 70px;">Não há nenhum registro excluído!</p>
        <?php } else { ?>
        <h3 class="text-secondary text-center" id="sem_dados" style="display: none; font-size: 1.75rem;"></h3>
        <table id="tabela" class="table table-bordered table-hover">
            <thead class="thead-light" style="font-size:20px">
                <tr class="text-center">
                    <th scope="col" width="8%">#</th>
                    <th scope="col">Produto</th>
                    <th scope="col" width="15%">Validade</th>
                    <th scope="col" width="20%">Data da exclusão</th>
                    <th scope="col" colspan="2"><i class="fas fa-cogs"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    for ($i = 0; $i < $numero_excluidos; $i++) {
                        $vetor = mysqli_fetch_assoc($pesquisar_produtos_excluidos);
                        $vetor_produto = $vetor['nome_produto'];
                        $vetor_validade = $vetor['validade'];
                        $vetor_hora_exclusao = $vetor['hora_exclusao'];
                        $vetor_id = $vetor['id'];
                        date_default_timezone_set('America/Sao_Paulo');
                        // echo 'Agora em São Paulo é: <strong>'. date('d/m/Y H:i:s').'</strong><br /><br />';
                        // echo date('d-m-Y')."<br>";
                        // echo date("d-m-Y", strtotime($vetor_validade));
                        if (date('d-m-Y') == date("d-m-Y", strtotime($vetor_validade))) { ?>
                <form id="form_recuperar-<?php echo $vetor_id ?>">
                    <tr id="linha-<?php echo $vetor_id ?>" class="bg-warning">
                        <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                        <td style="max-width: 600px; word-wrap: break-word;"><?php echo $vetor_produto ?></td>
                        <td class="text-center"><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                        <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_exclusao)) ?></td>
                        <td align="center" class="td_53x53">
                            <span data-toggle="modal" data-target="#modalRecuperar">
                                <i class="fas fa-history" data-toggle="tooltip" data-placement="top" data-html="true" title="<b><font color='#25d366'>Recuperar</font></b>" style="cursor: pointer; color: #25d366; font-size: 25px;" onclick="recuperarProduto(<?php echo $vetor_id ?>, '<?php echo $vetor_produto ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
                            </span>
                        </td>
                        <td align="center" class="td_53x53">
                            <span data-toggle="modal" data-target="#modalExcluir">
                                <i class="fas fa-times" data-toggle="tooltip" data-placement="top" data-html="true" title="<b><font color='red'>Excluir</font></b>" style="cursor: pointer; color: red; font-size: 25px;" onclick="excluirProduto(<?php echo $vetor_id; ?>, '<?php echo $vetor_produto; ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
                            </span>
                        </td>
                    </tr>
                    <div class="modal fade" id="modalRecuperar" tabindex="-1" role="dialog" aria-labelledby="modalRecuperarTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalTitle">
                                        <font color="#25d366">Deseja realmente recuperar?</font>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="cod_produto" class="form-control" name="cod_produto" value="<?php echo $vetor_id ?>" readonly>
                                    <!-- <input type="hidden" id="nome_produto" class="form-control" name="nome_produto" value="" readonly> -->
                                    <div class="row">
                                        <div class="col-9">
                                            <b>Nome do produto: </b>
                                            <nome id="nome" style="overflow-wrap: break-word;"></nome>
                                        </div>
                                        <div class="col">
                                            <b>
                                                <validade id="vencimento" style="color: firebrick;"></validade>
                                            </b>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success" onclick="recuperar(document.getElementById('cod_produto').value)" data-dismiss="modal">Recuperar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalTitle">
                                        <font color="#dc3545">Deseja realmente excluir?</font>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="cod_produto2" class="form-control" name="cod_produto2" value="<?php echo $vetor_id ?>" readonly>
                                    <!-- <input type="hidden" id="nome_produto" class="form-control" name="nome_produto" value="" readonly> -->
                                    <div class="row">
                                        <div class="col-9">
                                            <b>Nome do produto: </b>
                                            <nome id="nome2" style="overflow-wrap: break-word;"></nome>
                                        </div>
                                        <div class="col">
                                            <b>
                                                <validade id="vencimento2" style="color: firebrick;"></validade>
                                            </b>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger" onclick="excluir(document.getElementById('cod_produto2').value)" data-dismiss="modal">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                        } else { ?>
                <form id="form_recuperar-<?php echo $vetor_id ?>">
                    <tr id="linha-<?php echo $vetor_id ?>">
                        <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                        <td><?php echo $vetor_produto ?></td>
                        <td class="text-center"><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                        <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_exclusao)) ?></td>
                        <td align="center" class="td_53x53">
                            <span data-toggle="modal" data-target="#modalRecuperar">
                                <i class="fas fa-history" data-toggle="tooltip" data-placement="top" data-html="true" title="<b><font color='#25d366'>Recuperar</font></b>"" title="<b><font color='#25d366'>Recuperar</font></b>" style="cursor: pointer; color: #25d366; font-size: 25px;" onclick="recuperarProduto(<?php echo $vetor_id ?>, '<?php echo $vetor_produto ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
                            </span>
                        </td>
                        <td align="center" class="td_53x53">
                            <span data-toggle="modal" data-target="#modalExcluir">
                                <i class="fas fa-times" data-toggle="tooltip" data-placement="top" data-html="true" title="<b><font color='red'>Excluir</font></b>" style="cursor: pointer; color: red; font-size: 25px;" onclick="excluirProduto(<?php echo $vetor_id; ?>, '<?php echo $vetor_produto; ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
                            </span>
                        </td>
                    </tr>
                    <div class="modal fade" id="modalRecuperar" tabindex="-1" role="dialog" aria-labelledby="modalRecuperarTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalTitle">
                                        <font color="#25d366">Deseja realmente recuperar?</font>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="cod_produto" class="form-control" name="cod_produto" value="<?php echo $vetor_id ?>" readonly>
                                    <!-- <input type="hidden" id="nome_produto" class="form-control" name="nome_produto" value="" readonly> -->
                                    <div class="row">
                                        <div class="col-9">
                                            <b>Nome do produto: </b>
                                            <nome id="nome" style="overflow-wrap: break-word;"></nome>
                                        </div>
                                        <div class="col">
                                            <b>
                                                <validade id="vencimento" style="color: firebrick;"></validade>
                                            </b>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success" onclick="recuperar(document.getElementById('cod_produto').value)" data-dismiss="modal">Recuperar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalTitle">
                                        <font color="#dc3545">Deseja realmente excluir?</font>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="cod_produto2" class="form-control" name="cod_produto2" value="<?php echo $vetor_id ?>" readonly>
                                    <!-- <input type="hidden" id="nome_produto" class="form-control" name="nome_produto" value="" readonly> -->
                                    <div class="row">
                                        <div class="col-9">
                                            <b>Nome do produto: </b>
                                            <nome id="nome2" style="overflow-wrap: break-word;"></nome>
                                        </div>
                                        <div class="col">
                                            <b>
                                                <validade id="vencimento2" style="color: firebrick;"></validade>
                                            </b>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger" onclick="excluir(document.getElementById('cod_produto2').value)" data-dismiss="modal">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php }
                    }
                    ?>
            </tbody>
        </table>
        <?php }
        ?>
    </main><br><br><br><br><br><br><br><br><br>
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
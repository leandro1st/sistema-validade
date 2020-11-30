<?php
require("../externo/c.php");
$pesquisar_produtos_excluidos = mysqli_query($connect, "SELECT * FROM $excluidos ORDER BY hora_exclusao DESC");
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
    <link rel="stylesheet" href="../externo/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../externo/style.css">
    <script src="../externo/bootstrap/js/bootstrap.min.js"></script>
    <script src="../externo/jquery/jquery-3.4.0.min.js"></script>
    <script src="../externo/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../externo/funcoes.js"></script>
    <script>
        /* Recuperar produto da 'lixeira' */
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
                        // document.getElementById("sem_dados").style.paddingTop = '8%';
                        // document.getElementById("sem_dados").className = 'text-center lead';
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
        } /* Recuperar produto da 'lixeira' */

        /* Excluir produto definitivamente pela 'lixeira' */
        function excluirProdutoDef(id, produto, validade) {
            document.getElementById("cod_produto").value = id;
            // document.getElementById("nome_produto").value = produto;
            document.getElementById("nome2").innerHTML = produto;
            document.getElementById("vencimento2").innerHTML = validade;
        }

        function excluir_def(id) {
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
                        // document.getElementById("sem_dados").style.paddingTop = '8%';
                        // document.getElementById("sem_dados").className = 'text-center lead';
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
        } /* Excluir produto definitivamente pela 'lixeira' */

        /* Excluir todos produtos definitivamente pela 'lixeira' */
        function excluirTudoDef() {
            $.ajax({
                method: 'POST',
                url: 'excluir_tudo_excluidos.php',
                data: $('#form_excluirTudo').serialize(),
                async: false,
                success: function(data) {
                    $("#modalExcluirTudo").modal('toggle');
                    document.getElementById('texto_excluido').innerHTML = data;
                    $("#modalExcluido").modal('show');
                },
                error: function(data) {
                    alert(data);
                }
            });
        } /* Excluir todos produtos definitivamente pela 'lixeira' */
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
                <li class="nav-item px-1 active">
                    <a class="nav-link underline" href="javascript:void(0)"><i class="far fa-trash-alt text-danger" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="../pesquisa/" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" placeholder="Nome do produto" aria-label="Search" style="width: 300px; background-color: #eee; border-radius: 9999px; border: none; padding-left: 20px; padding-right: 42px">
                <button type="submit" style="position: absolute; margin-left: 259px; border: none; cursor: pointer"><i class="fas fa-search text-success"></i></button>
            </form>
        </div>
    </nav>
    <nav aria-label="breadcrumb" style="position: absolute; z-index: 10;">
        <ol class="breadcrumb asap_regular" style="background: none; margin: 0">
            <li class="breadcrumb-item"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)" class="none_li"><i class="far fa-trash-alt"></i> Produtos Excluídos</a></li>
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
                    <h1 class="montara" style="padding-bottom: 10px">Excluídos</h1>
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
                    <h1 class="montara" style="padding-bottom: 10px">Excluídos</h1>
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
                    <h1 class="montara" style="padding-bottom: 10px">Excluídos</h1>
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
    </div>
    <main class="container" style="margin-top: 1.5rem">
        <?php
        if ($numero_excluidos == 0) { ?>
            <script>
                $(document).ready(function() {
                    if (window.matchMedia("(max-width:1366px)").matches) {
                        document.getElementById("footer1").style.marginBottom = "-269px";
                    } else if (window.matchMedia("(min-width:1600px) and (max-width:1920px)").matches) {
                        document.getElementById("footer1").style.marginBottom = "-68px";
                    }
                });
            </script>
            <p class="text-center lead" style="font-size: 1.75rem; padding-top: 8%;">Não há nenhum registro excluído!</p>
        <?php } else { ?>
            <p class="text-center lead" id="sem_dados" style="display: none; font-size: 1.75rem; padding-top: 8%;"></p>
            <table id="tabela" class="table table-hover table-striped text-center">
                <thead>
                    <tr class="table-warning">
                        <th scope="col" class="lead" width="8%"><b>#</b></th>
                        <th scope="col" class="lead"><b>PRODUTO</b></th>
                        <th scope="col" class="lead" width="10%"><b>VALIDADE</b></th>
                        <th scope="col" class="lead" width="20%"><b>EXCLUSÃO</b></th>
                        <th scope="col" class="lead" width="10%" colspan="2"><i class="fas fa-cogs"></i></th>
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
                            <tr id="linha-<?php echo $vetor_id ?>" class="bg-warning">
                            <?php } else { ?>
                            <tr id="linha-<?php echo $vetor_id ?>">
                            <?php } ?>
                            <form id="form_recuperar-<?php echo $vetor_id ?>">
                                <input type="hidden" id="cod_produto" class="form-control" name="cod_produto" value="<?php echo $vetor_id ?>" readonly>
                                <td><?php echo $vetor_id ?></td>
                                <td class="text-left" style="max-width: 600px; word-wrap: break-word"><?php echo $vetor_produto ?></td>
                                <td><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                                <td><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_exclusao)) ?></td>
                                <td>
                                    <span data-toggle="modal" data-target="#modalRecuperar">
                                        <i class="fas fa-history" data-toggle="tooltip" data-placement="top" data-html="true" title="Recuperar <b><span class='text-success'><?php echo $vetor_produto ?></span></b>" style="cursor: pointer; color: #25d366; font-size: 25px;" onclick="recuperarProduto(<?php echo $vetor_id ?>, '<?php echo $vetor_produto ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
                                    </span>
                                </td>
                                <td>
                                    <span data-toggle="modal" data-target="#modalExcluir">
                                        <i class="fas fa-times" data-toggle="tooltip" data-placement="top" data-html="true" title="Excluir <b><span class='text-danger'><?php echo $vetor_produto ?></span></b>" style="cursor: pointer; color: red; font-size: 25px;" onclick="excluirProdutoDef(<?php echo $vetor_id; ?>, '<?php echo $vetor_produto; ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
                                    </span>
                                </td>
                            </form>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        <?php }
        ?>
    </main>

    <!-- Modal recuperar -->
    <div class="modal fade" id="modalRecuperar" tabindex="-1" role="dialog" aria-labelledby="modalRecuperarTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-success asap_regular" id="modalTitle">
                        Deseja realmente recuperar?
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body asap_regular">
                    <div class="row">
                        <div class="col-9">
                            <b>Nome do produto: </b>
                            <span id="nome" style="overflow-wrap: break-word;"></span>
                        </div>
                        <div class="col">
                            <b>
                                <span id="vencimento" class="text-danger"></span>
                            </b>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary asap_regular" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success asap_regular" onclick="recuperar(document.getElementById('cod_produto').value)" data-dismiss="modal">Recuperar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal excluir definitivamente -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-danger asap_regular" id="modalTitle">
                        Deseja realmente excluir?
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body asap_regular">
                    <div class="row">
                        <div class="col-9">
                            <b>Nome do produto: </b>
                            <span id="nome2" style="overflow-wrap: break-word;"></span>
                        </div>
                        <div class="col">
                            <b>
                                <span id="vencimento2" class="text-danger"></span>
                            </b>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary asap_regular" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger asap_regular" onclick="excluir_def(document.getElementById('cod_produto').value)" data-dismiss="modal">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal excluído -->
    <div class="modal fade" id="modalExcluido" tabindex="-1" role="dialog" aria-labelledby="modalExcluidoTitle" aria-hidden="true" onkeypress="location.reload();" onfocusout="location.reload();">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-success asap_regular" id="modalTitle">
                        Exclusão realizada com sucesso!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body asap_regular">
                    <div class="container">
                        <p id="texto_excluido" class="lead"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success asap_regular" data-dismiss="modal" onclick="location.reload();">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal excluir tudo -->
    <form id="form_excluirTudo" method="POST">
        <div class="modal fade" id="modalExcluirTudo" tabindex="-1" role="dialog" aria-labelledby="modalExcluirTudoTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-danger asap_regular" id="modalTitle">
                            <?php if ($numero_excluidos == 1) { ?>
                                Deseja realmente excluir o registro?
                            <?php } else { ?>
                                <span id="contagem">Deseja realmente excluir todos (<?php echo $numero_excluidos ?>) os registros?</span>
                            <?php } ?>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body asap_regular">
                        <div class="row">
                            <div class="col-9">
                                <?php if ($numero_excluidos == 1) { ?>
                                    <h5 class="text-warning">Você excluirá 1 registro!</h5>
                                <?php } else { ?>
                                    <h5 class="text-warning" id="contagem2">Você excluirá <?php echo $numero_excluidos ?> registros!</h5>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary asap_regular" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn_modal_excluir" class="btn btn-danger asap_regular" onclick="excluirTudoDef()">Excluir tudo</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Footer -->
    <footer id="footer1" class="footer" style="margin-bottom: -250px">
        <!-- Footer Elements -->
        <div style="background-color: #3e4551; padding: 16px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 offset-md-3 text-right">
                        <a href="https://www.facebook.com/sakamototen/" class="btn-social btn-facebook"><i class="fab fa-facebook-f"></i></a>
                    </div>
                    <div class="col-md-2 text-center">
                        <a href="https://github.com/leandro1st" class="btn-social btn-github"><i class="fab fa-github"></i></a>
                    </div>
                    <div class="col-md-2">
                        <a href="https://www.instagram.com/sakamototen/" class="btn-social btn-instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Elements -->
        <!-- Copyright -->
        <div class="text-center asap_regular" style="background-color: #323741; padding: 16px; color: #dddddd">©
            2020 Copyright –
            <a href="https://sakamototen.com.br/" style="text-decoration: none"> SakamotoTen – Produtos Orientais e
                Naturais</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>
<?php
require("externo/c.php");
$pesquisar_produtos = mysqli_query($connect, "SELECT * FROM $vencimentos ORDER BY validade ASC");
$numero_produtos = mysqli_num_rows($pesquisar_produtos);
// echo $numero_produtos;
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php
        if ($numero_produtos == 0) {
            echo "Validades | Nenhum cadastro";
        } else if ($numero_produtos == 1) {
            echo "Validades | " . $numero_produtos . " cadastro";
        } else if ($numero_produtos > 1) {
            echo "Validades | " . $numero_produtos . " cadastros";
        }
        ?>
    </title>
    <link rel="stylesheet" href="externo/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="externo/style.css">
    <script src="externo/jquery/jquery-3.4.0.min.js"></script>
    <!-- <script src="externo/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="externo/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="externo/funcoes.js"></script>
    <script>
        /* Excluir produto pelo index */
        function excluirProduto(id, produto, validade) {
            document.getElementById("cod_produto").value = id;
            // document.getElementById("nome_produto").value = produto;
            document.getElementById("nome").innerHTML = produto;
            document.getElementById("vencimento").innerHTML = validade;
        }

        var num_index = "<?php echo $numero_produtos ?>";

        function excluir(id) {
            // alert(id);
            $.ajax({
                method: 'POST',
                url: 'excluir/excluir.php',
                data: $('#form_excluir').serialize(),
                success: function(data) {
                    // alert(data);
                    $('#checkbox-' + id).prop('checked', false);

                    $('#linha-' + id).fadeOut(300, function() {
                        $('#linha-' + id).remove();
                    });

                    num_index -= 1;
                    // console.log(num_index);
                    if (num_index > 1) {
                        document.getElementById("contagem").innerHTML = 'Deseja realmente excluir todos (' + num_index + ') os registros?';
                        document.getElementById("contagem2").innerHTML = 'Você excluirá ' + num_index + ' registros!';
                        document.title = "Validades | " + num_index + " cadastros";
                    } else if (num_index == 1) {
                        document.getElementById("botao_excluir-0").innerHTML = 'Excluir';
                        document.getElementById("botao_excluir-1").innerHTML = 'Excluir';
                        document.getElementById("botao_excluir-2").innerHTML = 'Excluir';
                        document.getElementById("contagem").innerHTML = 'Deseja realmente excluir o registro?';
                        document.getElementById("contagem2").innerHTML = 'Você excluirá ' + num_index + ' registro!';
                        document.getElementById("btn_modal_excluir").innerHTML = 'Excluir';
                        document.title = "Validades | " + num_index + " cadastro";
                    } else if (num_index == 0) {
                        document.getElementById("sem_dados").innerHTML = 'Não há nenhum registro!';
                        // document.getElementById("sem_dados").style.paddingTop = '8%';
                        // document.getElementById("sem_dados").className = 'text-center lead';
                        document.getElementById("sem_dados").style.display = 'block';
                        document.getElementById("tabela").innerHTML = '';
                        document.getElementById("botao_excluir-0").disabled = 'true';
                        document.getElementById("botao_excluir-0").style.cursor = 'not-allowed';
                        document.getElementById("botao_excluir-0").title = 'Não há nada para ser excluído!';
                        document.getElementById("botao_excluir-1").disabled = 'true';
                        document.getElementById("botao_excluir-1").style.cursor = 'not-allowed';
                        document.getElementById("botao_excluir-1").title = 'Não há nada para ser excluído!';
                        document.getElementById("botao_excluir-2").disabled = 'true';
                        document.getElementById("botao_excluir-2").style.cursor = 'not-allowed';
                        document.getElementById("botao_excluir-2").title = 'Não há nada para ser excluído!';
                        document.title = "Validades | Nenhum cadastro";
                    }
                },
                error: function(data) {
                    alert("Ocorreu um erro!");
                }
            });
        }

        /* Excluir todos produtos pelo index */
        function excluirTudo() {
            $.ajax({
                method: 'POST',
                url: 'excluir/excluir_tudo.php',
                data: $('#form_excluirTudo').serialize(),
                success: function(data) {
                    $("#modalExcluirTudo").modal('toggle');
                    document.getElementById('texto_excluido').innerHTML = data;
                    $("#modalExcluido").modal('show');
                },
                error: function(data) {
                    alert(data);
                }
            });
        }

        // Função para excluir a partir das seleções realizadas nos checkboxes
        function exclusao_multipla(id_produtos_selecionados) {
            $.ajax({
                method: 'POST',
                url: 'excluir/exclusao_multipla.php',
                data: $('#form_excluir').serialize(),
                success: function(data) {
                    for (i = 0; i < id_produtos_selecionados.length; i++) {
                        // Unchecking checkbox
                        $('#checkbox-' + id_produtos_selecionados[i]).prop('checked', false);

                        // Verificando se algum checkbox está selecionado
                        // Se estiver, desativa a seleção de qualquer texto das linhas da tabela
                        if ($("#tabela input:checkbox:checked").length > 0) {
                            $('tr').addClass('unselectable');
                        } else {
                            $('tr').removeClass('unselectable');
                        }

                        $('#linha-' + id_produtos_selecionados[i]).fadeOut(300, function() {
                            $('#linha-' + id_produtos_selecionados[i]).remove();
                        });
                    }
                    // console.log(id_produtos_selecionados);

                    num_index -= id_produtos_selecionados.length;
                    // console.log(num_index);
                    if (num_index > 1) {
                        document.getElementById("contagem").innerHTML = 'Deseja realmente excluir todos (' + num_index + ') os registros?';
                        document.getElementById("contagem2").innerHTML = 'Você excluirá ' + num_index + ' registros!';
                        document.title = "Validades | " + num_index + " cadastros";
                    } else if (num_index == 1) {
                        document.getElementById("botao_excluir-0").innerHTML = 'Excluir';
                        document.getElementById("botao_excluir-1").innerHTML = 'Excluir';
                        document.getElementById("botao_excluir-2").innerHTML = 'Excluir';
                        document.getElementById("contagem").innerHTML = 'Deseja realmente excluir o registro?';
                        document.getElementById("contagem2").innerHTML = 'Você excluirá ' + num_index + ' registro!';
                        document.getElementById("btn_modal_excluir").innerHTML = 'Excluir';
                        document.title = "Validades | " + num_index + " cadastro";
                    } else if (num_index == 0) {
                        document.getElementById("sem_dados").innerHTML = 'Não há nenhum registro!';
                        // document.getElementById("sem_dados").style.paddingTop = '8%';
                        // document.getElementById("sem_dados").className = 'text-center lead';
                        document.getElementById("sem_dados").style.display = 'block';
                        document.getElementById("tabela").innerHTML = '';
                        document.getElementById("botao_excluir-0").disabled = 'true';
                        document.getElementById("botao_excluir-0").style.cursor = 'not-allowed';
                        document.getElementById("botao_excluir-0").title = 'Não há nada para ser excluído!';
                        document.getElementById("botao_excluir-1").disabled = 'true';
                        document.getElementById("botao_excluir-1").style.cursor = 'not-allowed';
                        document.getElementById("botao_excluir-1").title = 'Não há nada para ser excluído!';
                        document.getElementById("botao_excluir-2").disabled = 'true';
                        document.getElementById("botao_excluir-2").style.cursor = 'not-allowed';
                        document.getElementById("botao_excluir-2").title = 'Não há nada para ser excluído!';
                        document.title = "Validades | Nenhum cadastro";
                    }
                },
                error: function(data) {
                    alert("Ocorreu um erro!");
                }
            });
        }

        // Função que controla o botão de ativar checkbox/excluir produto
        function ativar_checkbox() {
            // Habilitando todos os checkboxes
            $('table#tabela input[type=checkbox]').attr('disabled', false);

            var icone = $('#icone_ativar_checkbox');
            // Adicionando a classe bounceOutLeft para o ícone
            icone.addClass('bounceOutLeft');

            // Função que é executada após o término da animação bounceOutLeft
            icone.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
                // Se o ícone for da classe 'fas fa-trash text-danger bounceOutLeft'
                if (document.getElementById('icone_ativar_checkbox').className == 'fas fa-trash text-danger bounceOutLeft') {
                    // Se algum checkbox estiver selecionado, ocorre a exclusão dos produtos e o ícone permanece 'fas fa-trash text-danger'
                    if ($("#tabela input:checkbox:checked").length > 0) {
                        // Convertendo os valores contidos nos checkboxes selecionados para array
                        var id_produtos_selecionados = $("#tabela input:checkbox:checked").map(function() {
                            return $(this).val();
                        }).get();
                        // Chamando a função que realiza a exclusão múltipla
                        exclusao_multipla(id_produtos_selecionados);

                        document.getElementById('icone_ativar_checkbox').className = 'fas fa-trash text-danger';
                    } else {
                        /* Se nenhum checkbox estiver selecionado, o ícone retorna à sua classe inicial 'far fa-check-square text-success'
                        e desabilita todos os checkboxes */
                        document.getElementById('icone_ativar_checkbox').className = 'far fa-check-square text-success';
                        $('table#tabela input[type=checkbox]').attr('disabled', true);
                    }
                } else {
                    // Se o ícone não for da classe 'fas fa-trash text-danger bounceOutLeft', ele muda pra classe 'fas fa-trash text-danger'
                    document.getElementById('icone_ativar_checkbox').className = 'fas fa-trash text-danger';
                }
            });
        }

        // Função para permitir a seleção múltipla dos checkboxes usando a tecla shift
        $(document).ready(function() {
            var lastChecked = null;

            var $chkboxes = $('.custom-control-input');
            $chkboxes.click(function(e) {
                // Verificando se algum checkbox está selecionado
                // Se estiver, desativa a seleção de qualquer texto das linhas da tabela
                if ($("#tabela input:checkbox:checked").length > 0) {
                    $('tr').addClass('unselectable');
                } else {
                    $('tr').removeClass('unselectable');
                }

                // console.log(this.value);
                if (!lastChecked) {
                    lastChecked = this;
                    return;
                }

                if (e.shiftKey) {
                    var start = $chkboxes.index(this);
                    var end = $chkboxes.index(lastChecked);

                    $chkboxes.slice(Math.min(start, end), Math.max(start, end) + 1).prop('checked', this.checked);
                }

                lastChecked = this;
            });
        });
    </script>
    <style>
        .unselectable {
            user-select: none;
            /* CSS3 (little to no support) */
            -ms-user-select: none;
            /* IE 10+ */
            -moz-user-select: none;
            /* Gecko (Firefox) */
            -webkit-user-select: none;
            /* Webkit (Safari, Chrome) */
        }

        .custom-control-label::before,
        .custom-control-label::after {
            width: 1.25em;
            height: 1.25em;
            left: -1.33em;
            top: 0.18em;
        }

        .bounceOutLeft {
            -webkit-animation-name: bounceOutLeft;
            animation-name: bounceOutLeft;
            -webkit-animation-duration: 0.7s;
            animation-duration: 0.7s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        @keyframes bounceOutLeft {

            20%,
            100% {
                -webkit-transform: translate3d(0, 0, 0);
                -moz-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0)
            }

            40%,
            80% {
                opacity: 1;
                -webkit-transform: translate3d(5px, 0, 0);
                -moz-transform: translate3d(5px, 0, 0);
                transform: translate3d(5px, 0, 0)
            }

            50% {
                opacity: 0;
                -webkit-transform: translate3d(-10px, 0, 0);
                -moz-transform: translate3d(-10px, 0, 0);
                transform: translate3d(-10px, 0, 0)
            }
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="javascript:void(0)">
            <img src="imagens/logo.png" alt="logo" width="35px">
            <!-- <i class="far fa-calendar-alt" style="font-size: 35px;"></i> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item px-1 active">
                    <a class="nav-link underline" href="javascript:void(0)"><i class="fas fa-home" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link text-success" href="cadastrar/"><i class="fas fa-edit text-success" style="font-size: 24px; vertical-align: middle"></i> </a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="excluir/"><i class="far fa-trash-alt text-danger" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="pesquisa/" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" placeholder="Nome do produto" aria-label="Search" style="width: 300px; background-color: #eee; border-radius: 9999px; border: none; padding-left: 20px; padding-right: 42px">
                <button type="submit" style="position: absolute; margin-left: 259px; border: none; cursor: pointer"><i class="fas fa-search text-success"></i></button>
            </form>
        </div>
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
                    <img class="d-block w-100" src="imagens/mountain.jpg" alt="First slide">
                </div>
                <div class="carousel-caption">
                    <h1 class="montara" style="padding-bottom: 10px">Validades</h1>
                    <?php if ($numero_produtos == "0") { ?>
                        <button type="button" id="botao_excluir-0" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo" style="display: none;">Excluir tudo</button>
                    <?php } else if ($numero_produtos == "1") { ?>
                        <button type="button" id="botao_excluir-0" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir</button>
                    <?php } else { ?>
                        <button type="button" id="botao_excluir-0" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir tudo</button>
                    <?php } ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="view">
                    <img class="d-block w-100" src="imagens/emilia.png" alt="Second slide">
                </div>
                <div class="carousel-caption">
                    <h1 class="montara" style="padding-bottom: 10px">Validades</h1>
                    <?php if ($numero_produtos == "0") { ?>
                        <button type="button" id="botao_excluir-1" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo" style="display: none;">Excluir tudo</button>
                    <?php } else if ($numero_produtos == "1") { ?>
                        <button type="button" id="botao_excluir-1" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir</button>
                    <?php } else { ?>
                        <button type="button" id="botao_excluir-1" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir tudo</button>
                    <?php } ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="view">
                    <img class="d-block w-100" src="imagens/kimi_no_na.jpg" alt="Third slide">
                </div>
                <div class="carousel-caption">
                    <h1 class="montara" style="padding-bottom: 10px">Validades</h1>
                    <?php if ($numero_produtos == "0") { ?>
                        <button type="button" id="botao_excluir-2" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo" style="display: none;">Excluir tudo</button>
                    <?php } else if ($numero_produtos == "1") { ?>
                        <button type="button" id="botao_excluir-2" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir</button>
                    <?php } else { ?>
                        <button type="button" id="botao_excluir-2" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir tudo</button>
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
        if ($numero_produtos == 0) { ?>
            <script>
                $(document).ready(function() {
                    if (window.matchMedia("(max-width:1366px)").matches) {
                        document.getElementById("footer1").style.marginBottom = "-269px";
                    } else if (window.matchMedia("(min-width:1600px) and (max-width:1920px)").matches) {
                        document.getElementById("footer1").style.marginBottom = "-68px";
                    }
                });
            </script>
            <p class="text-center lead" style="font-size: 1.75rem; padding-top: 8%;">Não há nenhum registro!</p>
        <?php } else { ?>
            <p class="text-center lead" id="sem_dados" style="display: none; font-size: 1.75rem; padding-top: 8%;"></p>
            <table id="tabela" class="table table-hover table-striped text-center">
                <thead>
                    <tr class="table-warning">
                        <th scope="col" class="lead" width="1%"><i id="icone_ativar_checkbox" class="far fa-check-square text-success" style="font-size: 24px; cursor: pointer" onclick="ativar_checkbox()"></i></th>
                        <th scope="col" class="lead" width="8%"><b>#</b></th>
                        <th scope="col" class="lead"><b>NOME</b></th>
                        <th scope="col" class="lead" width="10%"><b>VALIDADE</b></th>
                        <th scope="col" class="lead" width="20%"><b>CADASTRO</b></th>
                        <th scope="col" class="lead" width="5%"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <form id="form_excluir">
                        <!-- Input para controlar o produto a ser excluído -->
                        <input type="hidden" id="cod_produto" class="form-control" name="cod_produto" value="">
                        <?php
                        for ($i = 0; $i < $numero_produtos; $i++) {
                            $vetor = mysqli_fetch_assoc($pesquisar_produtos);
                            $vetor_produto = $vetor['nome_produto'];
                            $vetor_validade = $vetor['validade'];
                            $vetor_hora_cadastro = $vetor['hora_cadastro'];
                            $vetor_id = $vetor['id'];
                            date_default_timezone_set('America/Sao_Paulo');
                            // echo 'Agora em São Paulo é: <strong>'. date('d/m/Y H:i:s').'</strong><br /><br />'
                            // echo date('d-m-Y')."<br>";
                            // echo date("d-m-Y", strtotime($vetor_validade));

                            if (date('d-m-Y') == date("d-m-Y", strtotime($vetor_validade))) { ?>
                                <!-- Se data de vencimento for hoje, mostra a linha com cor de fundo -->
                                <tr id="linha-<?php echo $vetor_id ?>" class="bg-warning">
                                <?php } else { ?>
                                <tr id="linha-<?php echo $vetor_id ?>">
                                <?php } ?>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="check_list[]" id="checkbox-<?php echo $vetor_id ?>" value="<?php echo $vetor_id ?>" disabled>
                                        <label class="custom-control-label" for="checkbox-<?php echo $vetor_id ?>"></label>
                                    </div>
                                </td>
                                <td><?php echo $vetor_id ?></td>
                                <td class="text-left" style="max-width: 600px; word-wrap: break-word;"><?php echo $vetor_produto ?></td>
                                <td>
                                    <b id="validade" class="text-danger">
                                        <?php echo date("d/m/Y", strtotime($vetor_validade)) ?>
                                    </b>
                                </td>
                                <td><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_cadastro)) ?></td>
                                <td>
                                    <span data-toggle="modal" data-target="#modalExcluir">
                                        <i class="fas fa-times" data-toggle="tooltip" data-placement="top" data-html="true" title="Excluir <b><span class='text-danger'><?php echo $vetor_produto ?></span></b>" style="cursor: pointer; color: red; font-size: 25px;" onclick="excluirProduto(<?php echo $vetor_id ?>, '<?php echo $vetor_produto ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
                                    </span>
                                </td>
                                </tr>
                            <?php } ?>
                    </form>
                </tbody>
            </table>
        <?php } ?>
    </main>

    <!-- Modal excluir Produto -->
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
                    <button type="submit" class="btn btn-danger asap_regular" onclick="excluir(document.getElementById('cod_produto').value)" data-dismiss="modal">Excluir</button>
                </div>
            </div>
        </div>
    </div><!-- Modal excluir Produto -->

    <!-- Modal excluido -->
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
                            <?php if ($numero_produtos == 1) { ?>
                                Deseja realmente excluir o registro?
                            <?php } else { ?>
                                <span id="contagem">Deseja realmente excluir todos (<?php echo $numero_produtos ?>) os registros?</span>
                            <?php } ?>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body asap_regular">
                        <div class="row">
                            <div class="col-9">
                                <?php if ($numero_produtos == 1) { ?>
                                    <h5 class="text-warning">Você excluirá 1 registro!</h5>
                                <?php } else { ?>
                                    <h5 class="text-warning" id="contagem2">Você excluirá <?php echo $numero_produtos ?> registros!</h5>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary asap_regular" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn_modal_excluir" class="btn btn-danger asap_regular" onclick="excluirTudo()">Excluir tudo</button>
                    </div>
                </div>
            </div>
        </div>
    </form><!-- Modal excluir tudo -->

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

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
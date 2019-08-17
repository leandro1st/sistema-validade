<?php
require("c.php");
$pesquisar_produtos = mysqli_query($connect, "SELECT * FROM $produtos ORDER BY validade ASC");
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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="dataTables/css/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jquery/jquery-3.4.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="dataTables/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="dataTables/js/dataTables.bootstrap4.min.js"></script> -->
    <script>
        function excluirProduto(id, produto, validade) {
            document.getElementById("cod_produto").value = id;
            // document.getElementById("nome_produto").value = produto;
            document.getElementById("nome").innerHTML = produto;
            document.getElementById("vencimento").innerHTML = validade;
        }
        var num = "<?php echo $numero_produtos ?>";

        function excluir(id) {
            // alert(id);
            $.ajax({
                method: 'POST',
                url: 'cadastrar/excluir.php',
                data: $('#form_excluir-' + id + '').serialize(),
                success: function(data) {
                    $('#linha-' + id).fadeOut(300, function() {
                        $('#linha-' + id).remove();
                    });
                    num -= 1;
                    if (num > 1) {
                        document.getElementById("contagem").innerHTML = 'Deseja realmente excluir todos (' + num + ') os registros?';
                        document.getElementById("contagem2").innerHTML = 'Você excluirá ' + num + ' registros!';
                        document.title = "Validades | " + num + " cadastros";
                    } else if (num == 1) {
                        document.getElementById("botao_excluir").innerHTML = 'Excluir';
                        document.getElementById("contagem").innerHTML = 'Deseja realmente excluir o registro?';
                        document.getElementById("contagem2").innerHTML = 'Você excluirá ' + num + ' registro!';
                        document.getElementById("btn_modal_excluir").innerHTML = 'Excluir';
                        document.title = "Validades | " + num + " cadastro";
                    } else if (num == 0) {
                        document.getElementById("sem_dados").innerHTML = 'Não há nenhum registro!';
                        document.getElementById("sem_dados").style.margin = '70px';
                        document.getElementById("sem_dados").className = 'text-center lead';
                        document.getElementById("sem_dados").style.display = 'block';
                        document.getElementById("tabela").innerHTML = '';
                        document.getElementById("botao_excluir").disabled = 'true';
                        document.getElementById("botao_excluir").style.cursor = 'not-allowed';
                        document.getElementById("botao_excluir").title = 'Não há nada para ser excluído!';
                        document.title = "Validades | Nenhum cadastro";
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
                url: 'cadastrar/excluir_tudo.php',
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
        // $(document).ready(function() {
        //     $('#tabela').DataTable({
        //         "language": {
        //             "sEmptyTable": "Nenhum registro encontrado",
        //             "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        //             "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        //             "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        //             "sInfoPostFix": "",
        //             "sInfoThousands": ".",
        //             "sLengthMenu": "_MENU_ resultados por página",
        //             "sLoadingRecords": "Carregando...",
        //             "sProcessing": "Processando...",
        //             "sZeroRecords": "Nenhum registro encontrado",
        //             "sSearch": "Pesquisar",
        //             "oPaginate": {
        //                 "sNext": "Próximo",
        //                 "sPrevious": "Anterior",
        //                 "sFirst": "Primeiro",
        //                 "sLast": "Último"
        //             },
        //             "oAria": {
        //                 "sSortAscending": ": Ordenar colunas de forma ascendente",
        //                 "sSortDescending": ": Ordenar colunas de forma descendente"
        //             }
        //         }
        //     });
        // });
    </script>
    <style>
        .underline {
            border-bottom: 3px solid #4EBA6F;
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="imagens/logo.png" alt="logo" width="35px">
            <!-- <i class="far fa-calendar-alt" style="font-size: 35px;"></i> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item px-1 active underline">
                    <a class="nav-link" href="#"><i class="fas fa-home" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link text-success" href="cadastrar/cadastrar.php">Cadastrar <i class="fas fa-plus-circle text-success" style="font-size: 24px; vertical-align: middle"></i> </a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="cadastrar/excluidos.php"><i class="fas fa-trash-alt" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="pesquisa/pesquisar.php" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
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
                    <h1 style="padding-bottom: 10px">Validades</h1>
                    <?php if ($numero_produtos == "0") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo" style="display: none;">Excluir tudo</button>
                    <?php } else if ($numero_produtos == "1") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir</button>
                    <?php } else { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir tudo</button>
                    <?php } ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="view">
                    <img class="d-block w-100" src="imagens/emilia.png" alt="Second slide">
                </div>
                <div class="carousel-caption">
                    <h1 style="padding-bottom: 10px">Validades</h1>
                    <?php if ($numero_produtos == "0") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo" style="display: none;">Excluir tudo</button>
                    <?php } else if ($numero_produtos == "1") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir</button>
                    <?php } else { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo">Excluir tudo</button>
                    <?php } ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="view">
                    <img class="d-block w-100" src="imagens/kimi_no_na.jpg" alt="Third slide">
                </div>
                <div class="carousel-caption">
                    <h1 style="padding-bottom: 10px">Validades</h1>
                    <?php if ($numero_produtos == "0") { ?>
                    <button type="button" id="botao_excluir" class="btn btn-lg btn-outline-danger" data-toggle="modal" data-target="#modalExcluirTudo" style="display: none;">Excluir tudo</button>
                    <?php } else if ($numero_produtos == "1") { ?>
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
                                <?php if ($numero_produtos == 1) { ?>
                                <font class="text-danger">Deseja realmente excluir o registro?</font>
                                <?php } else { ?>
                                <font class="text-danger" id="contagem">Deseja realmente excluir todos(<?php echo $numero_produtos ?>) os registros?</font>
                                <?php } ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-9">
                                    <?php if ($numero_produtos == 1) { ?>
                                    <h6 class="text-warning">Você excluirá 1 registro!</h6>
                                    <?php } else { ?>
                                    <h6 class="text-warning" id="contagem2">Você excluirá <?php echo $numero_produtos ?> registros!</h6>
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
        if ($numero_produtos == 0) { ?>
        <p class="text-center lead" style="font-size: 1.75rem; margin: 70px;">Não há nenhum registro!</p>
        <?php } else { ?>
        <h3 class="text-secondary text-center" id="sem_dados" style="display: none; font-size: 1.75rem;"></h3>
        <table id="tabela" class="table table-bordered table-hover">
            <thead class="thead-light" style="font-size:20px">
                <tr class="text-center">
                    <th scope="col" width="8%">#</th>
                    <th scope="col">Produto</th>
                    <th scope="col" width="15%">Validade</th>
                    <th scope="col" width="20%">Data do cadastro</th>
                    <th scope="col" width="5%"><i class="fas fa-cogs"></i></th>
                </tr>
            </thead>
            <tbody>
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
                <form id="form_excluir-<?php echo $vetor_id ?>">
                    <tr id="linha-<?php echo $vetor_id ?>" class="bg-warning">
                        <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                        <td style="max-width: 600px; word-wrap: break-word;"><?php echo $vetor_produto ?></td>
                        <td class="text-center"><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                        <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_cadastro)) ?></td>
                        <td align="center">
                            <span data-toggle="modal" data-target="#modalExcluir">
                                <i class="fas fa-times" data-toggle="tooltip" data-placement="top" data-html="true" title="<b><font color='red'>Excluir</font></b>" style="cursor: pointer; color: red; font-size: 25px;" onclick="excluirProduto(<?php echo $vetor_id; ?>, '<?php echo $vetor_produto; ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
                            </span>
                        </td>
                    </tr>
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
                                    <button type="submit" class="btn btn-danger" onclick="excluir(document.getElementById('cod_produto').value)" data-dismiss="modal">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                        } else { ?>
                <form id="form_excluir-<?php echo $vetor_id ?>">
                    <tr id="linha-<?php echo $vetor_id ?>">
                        <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                        <td style="max-width: 600px; word-wrap: break-word;"><?php echo $vetor_produto ?></td>
                        <td class="text-center"><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                        <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_cadastro)) ?></td>
                        <td align="center">
                            <span data-toggle="modal" data-target="#modalExcluir">
                                <i class="fas fa-times" data-toggle="tooltip" data-placement="top" data-html="true" title="<b><font color='red'>Excluir</font></b>" style="cursor: pointer; color: red; font-size: 25px;" onclick="excluirProduto(<?php echo $vetor_id; ?>, '<?php echo $vetor_produto; ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
                            </span>
                        </td>
                    </tr>
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
                                    <button type="submit" class="btn btn-danger" onclick="excluir(document.getElementById('cod_produto').value)" data-dismiss="modal">Excluir</button>
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
        // $hoje = date('Y-m-d');
        // $vence_hoje = mysqli_query($connect, "SELECT * FROM $produtos WHERE validade = '$hoje'");
        // $num_hoje = mysqli_num_rows($vence_hoje);
        // $resto = mysqli_query($connect, "SELECT * FROM $produtos WHERE validade != '$hoje'");
        // $num_resto = mysqli_num_rows($resto);
        ?>
        <!-- <script src="chartjs/dist/Chart.bundle.min.js"></script> -->
        <!-- <canvas id="doughnut-chart" width="400" height="150" style="margin-bottom: 80px"></canvas>
        <script type="text/javascript">
            var produtos_hoje = "<?php echo $num_hoje ?>";
            var produtos_resto = "<?php echo $num_resto ?>";
            new Chart(document.getElementById("doughnut-chart"), {
                type: 'doughnut',
                data: {
                    labels: ["Hoje", "Outros"],
                    datasets: [{
                        label: "Vencimento",
                        backgroundColor: ["#dc3545", "#15A4F2"],
                        data: [produtos_hoje, produtos_resto]
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Vencimentos',
                        fontSize: 24,
                        fontColor: "black"
                    },
                    legend: {
                        labels: {
                            fontSize: 15,
                            fontColor: "black"
                        }
                    },
                }
            });
        </script> -->
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
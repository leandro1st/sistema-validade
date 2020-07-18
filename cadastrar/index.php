<?php
require('../externo/c.php');

$pesquisar_produtos = mysqli_query($connect, "SELECT * FROM $todos_produtos ORDER BY $nome");
$numero_produtos = mysqli_num_rows($pesquisar_produtos);
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de validades</title>
    <link rel="stylesheet" href="../externo/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../externo/style.css">
    <script src="../externo/bootstrap/js/bootstrap.min.js"></script>
    <script src="../externo/jquery/jquery-3.4.0.min.js"></script>
    <script src="../externo/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-pt_BR.min.js"></script>
    <script src="../externo/funcoes.js"></script>
    <script>
        /* Cadastrar produto */
        function cadastrar() {
            var nome_input = $("#nome option:selected").text();
            var validade_input = $("#vencimento").val();
            var validade_formatado = validade_input.split("-")[2] + "/" + validade_input.split("-")[1] + "/" + validade_input.split("-")[0];
            $.ajax({
                method: "post",
                url: "cadastrar.php",
                data: $("#form_cadastrar").serialize(),
                success: function(data) {
                    // alert(data);
                    if (data == "0") {
                        // document.getElementById('btn_enviar').className = 'btn btn-danger';
                        // document.getElementById('btn_enviar').disabled = true;
                        // document.getElementById('btn_enviar').style.cursor = 'not-allowed';
                    } else if (data == "1") {
                        location.reload();
                        // document.getElementById("form_cadastrar").reset();
                        // alert("Cadastrado com sucesso!");
                    } else if (data == "Existente") {
                        $('#modalExistente').modal('show');
                        document.getElementById('span_nome').innerHTML = nome_input;
                        document.getElementById('span_validade').innerHTML = validade_formatado;
                    }
                },
            });
        } /* Cadastrar produto */

        function validar_inputs() {
            var nome_input = $("#nome").val().trim();
            var validade_input = $("#vencimento").val().trim();

            var today = new Date();
            var date = today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-' + ("0" + today.getDate()).slice(-2);

            if ((nome_input && validade_input) && (validade_input > date)) {
                document.getElementById('btn_enviar').className = 'btn btn-success';
                document.getElementById('btn_enviar').disabled = false;
                document.getElementById('btn_enviar').style.cursor = 'pointer';
            } else {
                document.getElementById('btn_enviar').className = 'btn btn-danger';
                document.getElementById('btn_enviar').disabled = true;
                document.getElementById('btn_enviar').style.cursor = 'not-allowed';
            }
        }
    </script>
    <style>
        li.no-results {
            padding: .25rem 1.5rem !important;
            margin: 0 !important;
            background-color: transparent !important;
        }

        /* custom cancel button */
        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
            margin: 0px;
            height: 20px;
            width: 20px;
            background: #d9534f;
            -webkit-mask: url(../imagens/times-solid.svg) center / contain no-repeat;
            cursor: pointer;
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
                    <a class="nav-link underline" href="javascript:void(0)"><i class="fas fa-edit text-success" style="font-size: 24px; vertical-align: middle"></i> </a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../excluir/"><i class="far fa-trash-alt text-danger" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="../pesquisa/" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" placeholder="Nome do produto" aria-label="Search" style="width: 300px; background-color: #eee; border-radius: 9999px; border: none; padding-left: 20px; padding-right: 42px">
                <button type="submit" style="position: absolute; margin-left: 259px; border: none; cursor: pointer"><i class="fas fa-search text-success"></i></button>
            </form>
        </div>
    </nav>
    <nav aria-label="breadcrumb" style="position: absolute; z-index: 10;">
        <ol class="breadcrumb" style="background: none; margin: 0">
            <li class="breadcrumb-item"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)" class="none_li"><i class="fas fa-edit"></i> Cadastrar Produtos</a></li>
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
                    <h1 style="padding-bottom: 10px">Cadastrar produtos</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="view">
                    <img class="d-block w-100" src="../imagens/emilia.png" alt="Second slide">
                </div>
                <div class="carousel-caption">
                    <h1 style="padding-bottom: 10px">Cadastrar produtos</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="view">
                    <img class="d-block w-100" src="../imagens/kimi_no_na.jpg" alt="Third slide">
                </div>
                <div class="carousel-caption">
                    <h1 style="padding-bottom: 10px">Cadastrar produtos</h1>
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
        <form id="form_cadastrar" method="post" class="needs-validation" novalidate onsubmit="return false;">
            <div class="form-row">
                <div class="col">
                    <div id="div-nome">
                        <div class="form-group">
                            <label for="nome"><b>Nome do produto:</b></label>
                            <select id="nome" name="nome_produto" class="selectpicker show-tick" data-live-search="true" data-width="100%" data-size="6" title="Selecione um produto" data-none-results-text="Nenhum resultado encontrado!" required autofocus onchange="validar_inputs()">
                                <?php
                                for ($i = 0; $i < $numero_produtos; $i++) {
                                    $vetor_produto = mysqli_fetch_array($pesquisar_produtos);
                                    $produto = $vetor_produto['nome'];
                                    $codigo_banco = $vetor_produto['id'];
                                    echo "<option value='" . $codigo_banco . "'>" . $produto . " </option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, selecione o nome do produto!
                            </div>
                        </div>
                    </div>
                    <?php
                    date_default_timezone_set('America/Sao_Paulo');
                    $amanha = date("Y-m-d", strtotime("+1 days"));
                    ?>
                    <div id="div-vencimento">
                        <div class="form-group">
                            <label for="vencimento"><b>Data do vencimento:</b></label>
                            <input class="form-control" type="date" id="vencimento" name="data_vencimento" min="<?php echo $amanha ?>" max="2099-12-31" required onkeyup="validar_inputs()" onchange="validar_inputs()">
                            <div class="invalid-feedback">
                                <?php
                                $amanha2 = date("d/m/Y", strtotime("+1 days"));
                                ?>
                                Por favor, digite a data de vencimento! (min: <?php echo $amanha2 ?> | máx: 31/12/2099)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="btn_enviar" class="btn btn-success" onclick="cadastrar()" style="float: right">Cadastrar</button>
        </form>
        <?php
        $pesquisar_recentes = mysqli_query($connect, "SELECT * FROM $produtos WHERE hora_cadastro >= DATE_SUB(NOW(),INTERVAL 24 HOUR) ORDER BY hora_cadastro DESC");
        $qntd_pesquisa_recentes = mysqli_num_rows($pesquisar_recentes);
        $pesquisar_ultimos50 = mysqli_query($connect, "SELECT * FROM $produtos ORDER BY hora_cadastro DESC limit 50");
        $qntd_pesquisa_ultimos50 = mysqli_num_rows($pesquisar_ultimos50);
        ?>
        <center>
            <!-- <h4 class="text-primary" style="margin: 15px">Cadastros Recentes</h4> -->
            <div id="accordion" style="margin-top: 65px">
                <div class="card border-0">
                    <div class="card-header pointer" id="header_ultimas24h" data-toggle="collapse" data-target="#ultimas_24h" aria-expanded="true" aria-controls="ultimas_24h" style="background-color: white">
                        <button class="btn btn_transparente text-primary">
                            <h5 class="mb-0">
                                Cadastros das últimas 24 horas
                            </h5>
                        </button>
                    </div>
                    <?php
                    if ($qntd_pesquisa_recentes == 0) { ?>
                        <div id="ultimas_24h" class="collapse show" aria-labelledby="header_ultimas24h" data-parent="#accordion" style="transition: 0.3s">
                            <div class="card-body">
                                <p class="lead">Nenhum cadastro nas últimas 24 horas</p>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div id="ultimas_24h" class="collapse show" aria-labelledby="header_ultimas24h" data-parent="#accordion" style="transition: 0.3s">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead class="thead-light" style="font-size:20px">
                                        <tr class="text-center">
                                            <th scope="col">#</th>
                                            <th scope="col">Produto</th>
                                            <th scope="col">Validade</th>
                                            <th scope="col">Hora do cadastro</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < $qntd_pesquisa_recentes; $i++) {
                                            $vetor_pesquisa = mysqli_fetch_array($pesquisar_recentes);
                                            $vetor_nome = $vetor_pesquisa['nome_produto'];
                                            $vetor_hora = $vetor_pesquisa['hora_cadastro'];
                                            $vetor_validade = $vetor_pesquisa['validade'];
                                            $data_hora = new DateTime($vetor_hora);
                                            $hora = $data_hora->format('H:i:s');
                                        ?>
                                            <tr>
                                                <th width="5%" class="text-center"><?php echo $i + 1 ?></th>
                                                <td width="65%"><?php echo $vetor_nome ?></td>
                                                <td width="*" class="text-center"><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                                                <td width="*" class="text-center"><?php echo $hora ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="card border-0">
                    <div class="card-header pointer" id="header_ultimos50" data-toggle="collapse" data-target="#ultimos50" aria-expanded="false" aria-controls="ultimos50" style="background-color: white">
                        <button class="btn btn_transparente text-primary">
                            <h5 class="mb-0">
                                Últimos 50 cadastros
                            </h5>
                        </button>
                    </div>
                    <?php if ($qntd_pesquisa_ultimos50 == 0) { ?>
                        <div id="ultimos50" class="collapse" aria-labelledby="header_ultimos50" data-parent="#accordion" style="transition: 0.3s">
                            <div class="card-body">
                                <p class="lead">Não há nenhum cadastro!</p>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div id="ultimos50" class="collapse" aria-labelledby="header_ultimos50" data-parent="#accordion" style="transition: 0.3s">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead class="thead-light" style="font-size:20px">
                                        <tr class="text-center">
                                            <th scope="col">#</th>
                                            <th scope="col">Produto</th>
                                            <th scope="col">Validade</th>
                                            <th scope="col">Data do cadastro</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < $qntd_pesquisa_ultimos50; $i++) {
                                            $vetor_pesquisa = mysqli_fetch_array($pesquisar_ultimos50);
                                            $vetor_nome = $vetor_pesquisa['nome_produto'];
                                            $vetor_hora = $vetor_pesquisa['hora_cadastro'];
                                            $vetor_validade = $vetor_pesquisa['validade'];
                                            // $data_hora = new DateTime($vetor_hora);
                                            // $hora = $data_hora->format('H:i:s');
                                        ?>
                                            <tr>
                                                <th width="5%" class="text-center"><?php echo $i + 1 ?></th>
                                                <td width="*"><?php echo $vetor_nome ?></td>
                                                <td width="15%" class="text-center"><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                                                <td width="20%" class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora)) ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </center>
    </main>
    <!-- Modal cadastro existente -->
    <div class="modal fade" id="modalExistente" tabindex="-1" role="dialog" aria-labelledby="modalExistenteTitle" aria-hidden="true" onkeypress="$('#modalExistente').modal('toggle');">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-warning" id="modalTitle">
                        Cadastro já existe!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p class="lead"><b>Nome: </b><span id="span_nome"></span></p>
                        <p class="lead"><b>Validade: </b><span id="span_validade"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer" style="margin-bottom: -250px">
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
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    // button onclick
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            // button css
                            document.getElementById('btn_enviar').className = 'btn btn-danger';
                            document.getElementById('btn_enviar').disabled = true;
                            document.getElementById('btn_enviar').style.cursor = 'not-allowed';

                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // onchange validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    // button onclick
                    form.addEventListener('change', function(event) {
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
</body>

</html>
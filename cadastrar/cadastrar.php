<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de validades</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../jquery/jquery-3.4.0.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function cadastrar() {
            var nome_input = $("#nome").val();
            var validade_input = $("#vencimento").val();
            var arr = validade_input.split("-");
            $.ajax({
                type: "post",
                url: "form_validades.php",
                cache: false,
                data: $("#form_cadastrar").serialize(),
                success: function(data) {
                    if (data == "0") {
                        //pass
                    } else if (data == "1") {
                        // alert("Cadastrado com sucesso!");
                    } else if (data == "Existente") {
                        alert("Nome: " + nome_input + "\nValidade: " + arr[2] + "/" + arr[1] + "/" + arr[0] + "\nCadastro já existe!");
                    }
                },
            });
        }
    </script>
    <style>
        .underline {
            border-bottom: 3px solid #4EBA6F;
        }

        .pointer {
            cursor: pointer;
        }

        .btn_transparente {
            outline: none;
            border: 0;
            box-shadow: none;
            background-color: transparent;
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
                <li class="nav-item px-1 underline">
                    <a class="nav-link text-success" href="#">Cadastrar <i class="fas fa-plus-circle text-success" style="font-size: 24px; vertical-align: middle"></i> </a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="excluidos.php"><i class="fas fa-trash-alt" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="../pesquisa/pesquisar.php" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>
    <nav aria-label="breadcrumb" style="position: absolute">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li class="breadcrumb-item"><a href="#"><i class="far fa-file-alt"></i> Cadastro</a></li>
            <li class="breadcrumb-item active"><i class="fas fa-plus-circle"></i> Cadastrar Produtos</li>
        </ol>
    </nav>
    <header class="jumbotron" style="padding: 2.5em;">
        <h1 class="text-center">Cadastrar produtos</h1>
    </header>
    <main class="container">
        <form id="form_cadastrar" method="post" class="needs-validation" novalidate>
            <div class="form-row">
                <div class="col">
                    <div id="div-nome">
                        <label for="nome"><b>Nome do produto:</b></label>
                        <input type="text" id="nome" name="nome_produto" class="form-control" placeholder="Nome do produto" list="lista" autofocus required>
                        <datalist id="lista">
                            <?php
                            require('lista_produtos.html');
                            ?>
                        </datalist>
                        <div class="invalid-feedback">
                            Por favor, digite o nome do produto!
                        </div><br>
                    </div>
                    <?php
                    date_default_timezone_set('America/Sao_Paulo');
                    $hj = date("Y-m-d");
                    ?>
                    <div id="div-vencimento">
                        <label for="vencimento"><b>Data do vencimento:</b></label>
                        <input class="form-control" type="date" id="vencimento" name="data_vencimento" min="<?php echo $hj ?>" max="2099-12-31" required>
                        <div class="invalid-feedback">
                            <?php
                            date_default_timezone_set('America/Sao_Paulo');
                            $hoje = date("d/m/Y");
                            ?>
                            Por favor, digite o data de vencimento! (min: <?php echo $hoje ?> | máx: 31-12-2099)
                        </div>
                    </div>
                </div>
            </div><br>
            <button type="submit" id="btn_enviar" class="btn btn-success" onclick="cadastrar()" style="float: right;">Cadastrar</button>
        </form><br><br><br>
        <?php
        require('../c.php');
        $pesquisar_recentes = mysqli_query($connect, "SELECT * FROM $produtos WHERE hora_cadastro >= DATE_SUB(NOW(),INTERVAL 24 HOUR) ORDER BY hora_cadastro DESC");
        $qntd_pesquisa_recentes = mysqli_num_rows($pesquisar_recentes);
        $pesquisar_ultimos50 = mysqli_query($connect, "SELECT * FROM $produtos ORDER BY hora_cadastro DESC limit 50");
        $qntd_pesquisa_ultimos50 = mysqli_num_rows($pesquisar_ultimos50);
        ?>
        <center>
            <!-- <h4 class="text-primary" style="margin: 15px">Cadastros Recentes</h4> -->
            <div id="accordion">
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
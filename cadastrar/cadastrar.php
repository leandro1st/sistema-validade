<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de validades</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../jquery/jquery-3.4.0.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function cadastrar() {
            var nome_input = $("#nome").val();
            var validade_input = $("#vencimento").val();
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
                        alert("Nome: " + nome_input + "\nValidade: " + validade_input + "\nCadastro já existe!");
                    }
                },
            });

        }
    </script>
    <style>
        .underline {
            border-bottom: 3px solid #4EBA6F;
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
        </form><br><br>
        <?php
        require('../c.php');
        $pesquisar_recentes = mysqli_query($connect, "SELECT * FROM $produtos WHERE hora_cadastro >= DATE_SUB(NOW(),INTERVAL 12 HOUR) ORDER BY hora_cadastro DESC");
        $qntd_pesquisa = mysqli_num_rows($pesquisar_recentes);
        ?>
        <center>
            <h4 class="text-primary" style="margin: 15px">Cadastros Recentes</h4>
            <table class="table table-hover">
                <thead class="thead-light" style="font-size:20px">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Validade</th>
                        <th scope="col">Hora Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < $qntd_pesquisa; $i++) {
                        $vetor_pesquisa = mysqli_fetch_array($pesquisar_recentes);
                        $vetor_nome = $vetor_pesquisa['nome_produto'];
                        $vetor_hora = $vetor_pesquisa['hora_cadastro'];
                        $vetor_validade = $vetor_pesquisa['validade'];
                        $data_hora = new DateTime($vetor_hora);
                        $hora = $data_hora -> format('H:i:s');
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
        </center><br>
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
    </main>
</body>

</html>
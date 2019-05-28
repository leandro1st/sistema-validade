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
            $.ajax({
                type: "post",
                url: "form_validades.php",
                data: $("#form_cadastrar").serialize(),
                success: function(data) {
                    if (data == "1") {
                        alert("Cadastrado com sucesso!");
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
                        <input type="text" id="nome" name="nome_produto" class="form-control" placeholder="Nome do produto" autofocus required>
                        <div class="invalid-feedback">
                            Por favor, digite o nome do produto!
                        </div><br>
                    </div>
                    <div id="div-vencimento">
                        <label for="vencimento"><b>Data do vencimento:</b></label>
                        <input class="form-control" type="date" id="vencimento" name="data_vencimento" min="2019-01-01" max="2099-12-31" required>
                        <div class="invalid-feedback">
                            Por favor, digite o data de vencimento! (min: 01/01/2019 | máx: 31-12-2099)
                        </div>
                    </div>
                </div>
            </div><br>
            <button type="submit" id="btn_enviar" class="btn btn-success" onclick="cadastrar()" style="float: right;">Cadastrar</button>
        </form>
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
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de validades</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function cadastrar() {
            $.ajax({
                method: "post",
                url: "form_validades.php",
                data: $("#form_cadastrar").serialize(),
                cache: false,
                success: function() {
                    alert("Cadastrado");
                },
            });
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="./"><i class="far fa-calendar-alt" style="font-size: 35px;"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastrar.php">Cadastrar</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav><br>
    <main class="container">
        <h1 class="text-center">Cadastrar produtos</h1><br>
        <form id="form_cadastrar">
            <div class="form-group row">
                <label for="nome" class="col-2 col-form-label">Nome do produto</label>
                <div class="col-10">
                    <input type="text" id="nome" name="nome_produto" class="form-control" id="nome" autofocus><br>
                </div>
                <label for="data_vencimento" class="col-2 col-form-label">Data do vencimento</label>
                <div class="col-10">
                    <input class="form-control" type="date" id="vencimento" name="data_vencimento" min="2019-01-01" max="2099-12-31">
                </div>
            </div>
            <input type="submit" class="btn btn-success" value="Cadastrar" onclick="cadastrar()" style="float: right;">
        </form>
    </main>
</body>

</html>
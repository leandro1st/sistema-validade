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
                        document.title = "Excluídos | " + num + " registros";
                    } else if (num == 1) {
                        document.title = "Excluídos | " + num + " registro";
                    } else if (num == 0) {
                        document.getElementById("sem_dados").innerHTML = 'Não há nenhum registro excluído!';
                        document.getElementById("sem_dados").style.display = 'block';
                        document.getElementById("tabela").innerHTML = '';
                        document.title = "Excluídos | Nenhum registro";
                    }
                },
                error: function(data) {
                    alert("Ocorreu um erro!");
                }
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
    <header class="jumbotron" style="padding: 2.5em;">
        <h1 class="text-center">Excluídos</h1>
    </header>
    <main class="container">
        <?php
        if ($numero_excluidos == 0) { ?>
            <h3 class="text-secondary text-center">Não há nenhum registro excluído!</h3>
        <?php } else { ?>
            <h3 class="text-secondary text-center" id="sem_dados" style="display: none;"></h3>
            <table id="tabela" class="table table-bordered">
                <thead class="thead-light" style="font-size:20px">
                    <tr class="text-center">
                        <th scope="col" width="10%">#</th>
                        <th scope="col">Produto</th>
                        <th scope="col" width="15%">Validade</th>
                        <th scope="col" width="20%">Data da exclusão</th>
                        <th scope="col" width="5%"><i class="fas fa-cogs"></i></th>
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
                        // echo 'Agora em São Paulo é: <strong>'. date('d/m/Y H:i:s').'</strong><br /><br />'
                        // echo date('d-m-Y')."<br>";
                        // echo date("d-m-Y", strtotime($vetor_validade));
                        if (date('d-m-Y') == date("d-m-Y", strtotime($vetor_validade))) { ?>
                            <form id="form_recuperar-<?php echo $vetor_id ?>">
                                <tr id="linha-<?php echo $vetor_id ?>" class="bg-warning">
                                    <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                                    <td style="max-width: 600px; word-wrap: break-word;"><?php echo $vetor_produto ?></td>
                                    <td class="text-center"><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                                    <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_exclusao)) ?></td>
                                    <td align="center">
                                        <i class="fas fa-history" data-toggle="modal" data-target="#modalRecuperar" style="cursor: pointer; color: #25d366; font-size: 25px;" onclick="recuperarProduto(<?php echo $vetor_id ?>, '<?php echo $vetor_produto ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
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
                            </form>
                        <?php
                    } else { ?>
                            <form id="form_recuperar-<?php echo $vetor_id ?>">
                                <tr id="linha-<?php echo $vetor_id ?>">
                                    <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                                    <td><?php echo $vetor_produto ?></td>
                                    <td class="text-center"><b class="text-danger"><?php echo date("d/m/Y", strtotime($vetor_validade)) ?></b></td>
                                    <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($vetor_hora_exclusao)) ?></td>
                                    <td align="center">
                                        <i class="fas fa-history" data-toggle="modal" data-target="#modalRecuperar" style="cursor: pointer; color: #25d366; font-size: 25px;" onclick="recuperarProduto(<?php echo $vetor_id ?>, '<?php echo $vetor_produto ?>', '<?php echo date('d/m/Y', strtotime($vetor_validade)) ?>')"></i>
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
                            </form>
                        <?php }
                }
                ?>
                </tbody>
            </table>
        <?php }
    ?>
    </main>
</body>

</html>
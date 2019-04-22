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
    <title>Validades</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="jquery/jquery-3.4.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function excluirProduto(id, produto, validade) {
            document.getElementById("cod_produto").value = id;
            document.getElementById("nome_produto").value = produto;
            document.getElementById("nome").innerHTML = produto;
            document.getElementById("vencimento").innerHTML = validade;
        }

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
                },
                error: function(data) {
                    alert("Ocorreu um erro!");
                }
            });
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><i class="far fa-calendar-alt" style="font-size: 35px;"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastrar/cadastrar.php">Cadastrar</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="pesquisa/pesquisar.php" method="POST">
                <input class="form-control mr-sm-2" name="nome_pesquisa" type="search" placeholder="Pesquisar" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav><br>
    <main class="container">
        <h1 class="text-center">Validades</h1><br>
        <table class="table table-bordered">
            <thead class="thead-light" style="font-size:20px">
                <tr class="text-center">
                    <th scope="col" width="10%">#</th>
                    <th scope="col">Produto</th>
                    <th scope="col" width="20%">Validade</th>
                    <th scope="col" width="5%"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < $numero_produtos; $i++) {
                    $vetor = mysqli_fetch_assoc($pesquisar_produtos);
                    $vetor_produto = $vetor['nome_produto'];
                    $vetor_validade = $vetor['validade'];
                    $vetor_id = $vetor['id'];
                    date_default_timezone_set('America/Sao_Paulo');
                    // echo 'Agora em São Paulo é: <strong>'. date('d/m/Y H:i:s').'</strong><br /><br />'
                    // echo date('d-m-Y')."<br>";
                    // echo date("d-m-Y", strtotime($vetor_validade));
                    if (date('d-m-Y') == date("d-m-Y", strtotime($vetor_validade))) { ?>
                        <form id="form_excluir-<?php echo $vetor_id ?>">
                            <tr id="linha-<?php echo $vetor_id ?>" class="bg-warning">
                                <th scope="row" class="text-center"><?php echo $vetor_id ?></th>
                                <td><?php echo $vetor_produto ?></td>
                                <td class="text-center"><?php echo date("d-m-Y", strtotime($vetor_validade)) ?></td>
                                <td align="center">
                                    <i class="fas fa-times" data-toggle="modal" data-target="#modalExcluir" style="cursor: pointer; color: red; font-size: 25px;" onclick="excluirProduto(<?php echo $vetor_id; ?>, '<?php echo $vetor_produto; ?>', '<?php echo date('d-m-Y', strtotime($vetor_validade)) ?>')"></i></a>
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
                                            <button type="button" class="btn btn-danger" onclick="excluir(document.getElementById('cod_produto').value)" data-dismiss="modal">Excluir</button>
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
                                <td><?php echo $vetor_produto ?></td>
                                <td class="text-center"><?php echo date("d-m-Y", strtotime($vetor_validade)) ?></td>
                                <td align="center">
                                    <i class="fas fa-times" data-toggle="modal" data-target="#modalExcluir" style="cursor: pointer; color: red; font-size: 25px;" onclick="excluirProduto(<?php echo $vetor_id; ?>, '<?php echo $vetor_produto; ?>', '<?php echo date('d-m-Y', strtotime($vetor_validade)) ?>')"></i></a>
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

    </main>
</body>

</html>
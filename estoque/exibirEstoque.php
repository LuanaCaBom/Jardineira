<?php
require_once '../scripts/init.php';

$PDO = db_connect();
$sql = "SELECT E.Id, E.Localizacao, P.Nome, E.Quantidade, E.Lote 
        FROM Estoque AS E 
        INNER JOIN Produto AS P ON E.IdProduto = P.Id 
        ORDER BY E.Id DESC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jardineira</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#menu").load("../navbar/navbar.html");
        });
    </script>
</head>
<body>
    <div id="menu"></div>

    <div class="container">
        <div class="jumbotron">
            <p class="h3 text-center">Estoque</p>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Localização</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Lote</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <th scope="row"><?php echo $dados['Id']; ?></th>
                    <td><?php echo $dados['Localizacao']; ?></td>
                    <td><?php echo $dados['Nome']; ?></td>
                    <td><?php echo $dados['Quantidade']; ?></td>
                    <td><?php echo $dados['Lote']; ?></td>
                    <td>
                        <a class="btn btn-info" href="formEditEstoque.php?Id=<?php echo $dados['Id']; ?>">Editar</a>
                        <a class="btn btn-danger" href="deleteEstoque.php?Id=<?php echo $dados['Id']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <div class="card-footer">
            <p class="h6 text-center">Todos os direitos reservados &copy; Copyright</p>
        </div>
    </div>
</body>
</html>

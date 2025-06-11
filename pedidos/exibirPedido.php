<?php
    require_once '../scripts/init.php';

    $Id = isset($_GET['Id']) ? $_GET['Id'] : null;

    $PDO = db_connect();
    $sql = "SELECT P.Id, P.Nome, P.Valor, P.Tipo, Pe.Id, C.Id, Pe.IdProduto
            FROM Produto AS P
            INNER JOIN Pedido AS Pe ON P.Id = Pe.IdProduto
            INNER JOIN Compra AS C ON Pe.IdCompra = C.Id
            WHERE C.Id = $Id
            ORDER BY C.Id DESC";
            
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
            <p class="h3 text-center">Pedidos cadastrados</p>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <th scope="row"><?php echo $dados['IdProduto']; ?></th>
                    <td><?php echo $dados['Nome']; ?></td>
                    <td><?php echo $dados['Valor']; ?></td>
                    <td><?php echo $dados['Tipo']; ?></td>
                    <td><a class="btn btn-danger" href="deletePedido.php?Id=<?php echo $dados['Id']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a></td>                   
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <a class="btn btn-secondary" href="../compras/exibirCompras.php">Voltar</a>
    </div>



    <div class="container">
        <div class="card-footer">
            <p class="h6 text-center">Todos os direitos reservados &copy; Copyright</p>
        </div>
    </div>
</body>
</html>

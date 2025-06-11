<?php
    require_once '../scripts/init.php';

    $PDO = db_connect();

    $sql = "SELECT C.Id, C.DataHora, C.StatusPagamento, Cl.Nome 
            FROM Compra AS C 
            INNER JOIN Cliente AS Cl ON C.IdCliente = Cl.Id 
            ORDER BY C.Id ASC";
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
            <p class="h3 text-center">Compras Realizadas</p>
        </div>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Data e Hora da Compra</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Status do Pagamento</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <th scope="row"><?php echo $dados['Id']; ?></th>
                    <td><input type="datetime-local" readonly value="<?php echo $dados['DataHora']; ?>"></td>
                    <td><?php echo $dados['Nome']; ?></td>
                    <td><?php echo $dados['StatusPagamento']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="../pedidos/formAddPedido.php?Id=<?php echo $dados['Id']; ?>">Adicionar Produtos</a>
                        <a class="btn btn-secondary" href="../pedidos/exibirPedido.php?Id=<?php echo $dados['Id']; ?>">Ver Produtos</a>
                        <a class="btn btn-info" href="formEditCompra.php?Id=<?php echo $dados['Id']; ?>">Editar</a>
                        <a class="btn btn-danger" href="deleteCompra.php?Id=<?php echo $dados['Id']; ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
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

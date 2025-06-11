<?php
    require '../scripts/init.php';

    $IdCompra = isset($_GET['Id']) ? (int) $_GET['Id'] : null;

    if (empty($IdCompra)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    
    $sqlProduto = "SELECT Id, Nome FROM Produto ORDER BY Nome ASC";
    $stmtProduto = $PDO->prepare($sqlProduto);
    $stmtProduto->execute();
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
            <p class="h3 text-center">Fazer Pedido</p>
        </div>
    </div>

    <div class="container">
        <form action="addPedido.php" method="post">
            <div class="form-group">
                <label for="Produto">Selecione o produto</label>
                <select class="form-control" name="Produto" id="Produto" required>
                    <?php while ($dados = $stmtProduto->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $dados['Id']; ?>"><?php echo $dados['Nome']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <input type="hidden" name="IdCompra" value="<?php echo $IdCompra; ?>">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <a class="btn btn-danger" href="../compras/exibirCompras.php">Cancelar</a>
        </form>
    </div>

    <div class="container">
        <div class="card-footer">
            <p class="h6 text-center">Todos os direitos reservados &copy; Copyright</p>
        </div>
    </div>
</body>
</html>

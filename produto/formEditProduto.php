<?php
    require '../scripts/init.php';

    $Id = isset($_GET['Id']) ? (int) $_GET['Id'] : null;

    if (empty($Id)) {
        header('Location: ../msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sqlProduto = "SELECT Id, Nome, Valor, Tipo FROM Produto WHERE Id = :Id";
    $stmtProduto = $PDO->prepare($sqlProduto);
    $stmtProduto->bindParam(':Id', $Id, PDO::PARAM_INT);
    $stmtProduto->execute();
    $Produto = $stmtProduto->fetch(PDO::FETCH_ASSOC);

    if (!is_array($Produto)) {
        header('Location: ../msgErro.html');
        exit;
    }
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
            <p class="h3 text-center">Editar Produto</p>
        </div>
    </div>

    <div class="container">
        <form action="editProduto.php" method="post">
            <div class="form-group">
                <label for="Nome">Nome:</label>
                <input type="text" class="form-control" name="Nome" id="Nome" required minlength="5" value="<?php echo $Produto['Nome']; ?>">
            </div>

            <div class="form-group">
                <label for="Valor">Valor:</label>
                <input type="number" step="0.01" class="form-control" name="Valor" id="Valor" required minlength="5" value="<?php echo $Produto['Valor']; ?>">
            </div>

            <div class="form-group">
                <label for="Tipo">Tipo:</label>
                <input type="text" class="form-control" name="Tipo" id="Tipo" required minlength="5" value="<?php echo $Produto['Tipo']; ?>">
            </div>

            <input type="hidden" name="Id" value="<?php echo $Id; ?>">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <a class="btn btn-danger" href="../index.html">Cancelar</a>
        </form>
    </div>

    <div class="container">
        <div class="card-footer">
            <p class="h6 text-center">Todos os direitos reservados &copy; Copyright</p>
        </div>
    </div>
</body>
</html>

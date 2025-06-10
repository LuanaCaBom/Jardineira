<?php
    require '../scripts/init.php';

    $Id = isset($_GET['Id']) ? (int) $_GET['Id'] : null;

    if (empty($Id)) {
        header('Location: ../msgErro.html');
        exit;
    }

    $PDO = db_connect();

    $sql = "SELECT Id, Nome, Tipo FROM Produto WHERE Id = :Id ORDER BY Tipo ASC";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    $stmt->execute();
    $Produto = $stmt->fetch(PDO::FETCH_ASSOC);

    $sqlEstoque = "SELECT Id, Localizacao, Quantidade, Lote FROM Estoque WHERE Id = :Id";
    $stmtEstoque = $PDO->prepare($sqlEstoque);
    $stmtEstoque->bindParam(':Id', $Id, PDO::PARAM_INT);
    $stmtEstoque->execute();
    $Estoque = $stmtEstoque->fetch(PDO::FETCH_ASSOC);

    if (!is_array($Estoque)) {
        header('Location: ../msgErro.html');
        exit;
    }

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
            <p class="h3 text-center">Cadastrar Estoque</p>
        </div>
    </div>

    <div class="container">
        <form action="addEstoque.php" method="post">
            <div class="form-group">
                <label for="Produto">Selecione o produto:</label>
                <select class="form-control" name="Produto" id="Produto" required>
                    <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $dados['Id']; ?>"><?php echo $dados['Tipo'] . " - " . $dados['Nome']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Lote">Lote:</label>
                <input type="number" class="form-control" name="Lote" id="Lote" value="<?php echo $Estoque['Lote']; ?>">
            </div>

            <!-- Perguntar sobre essa quantidade: funcionamento dela na hora da compra -->
            <div class="form-group">
                <label for="Quantidade">Quantidade:</label>
                <input type="number" class="form-control" name="Quantidade" id="Quantidade" value="<?php echo $Estoque['Quantidade']; ?>">
            </div>

            <div class="form-group">
                <label for="Localizacao">Localização:</label>
                <input type="text" class="form-control" name="Localizacao" id="Localizacao" value="<?php echo $Estoque['Localizacao']; ?>">
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

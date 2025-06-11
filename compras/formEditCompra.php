<?php
    require '../scripts/init.php';

    $Id = isset($_GET['Id']) ? (int) $_GET['Id'] : null;

    if (empty($Id)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();

    $sqlCompra = "SELECT C.Id, C.IdCliente, C.DataHora, C.StatusPagamento, Cl.Nome
                   FROM Compra AS C 
                   INNER JOIN Cliente AS Cl ON C.IdCliente = Cl.Id 
                   WHERE C.Id = :Id";
    $stmtCompra = $PDO->prepare($sqlCompra);
    $stmtCompra->bindParam(':Id', $Id, PDO::PARAM_INT);
    $stmtCompra->execute();
    $Compra = $stmtCompra->fetch(PDO::FETCH_ASSOC);

    if (!is_array($Compra)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $sqlCliente = "SELECT Id, Nome FROM Cliente";
    $stmtCliente = $PDO->prepare($sqlCliente);
    $stmtCliente->execute();
    $Clientes = $stmtCliente->fetchAll(PDO::FETCH_ASSOC);

    if (empty($Clientes)) {
        header('Location: ../msg/msgErro.html');
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
            <p class="h3 text-center">Editar Compra</p>
        </div>
    </div>

    <div class="container">
        <form action="editCompra.php" method="post">
            <div class="form-group">
                <label for="Cliente">Selecione o cliente:</label>
                <select class="form-control" name="Cliente" id="Cliente" required>
                    <?php foreach ($Clientes as $cliente): ?>
                        <option value="<?php echo $cliente['Id']; ?>"
                            <?php echo ($cliente['Id'] == $Compra['IdCliente']) ? 'selected' : ''; ?>>
                            <?php echo $cliente['Nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="DataHora">Data e hora:</label>
                <input type="datetime-local" class="form-control" name="DataHora" id="DataHora" value="<?php echo $Compra['DataHora']; ?>">
            </div>

            <label>Status do Pagamento:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="StatusPagamento" id="StatusPagamentoSim" value="Sim" <?php echo ($Compra['StatusPagamento'] == 'Sim') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="StatusPagamentoSim">Sim</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="StatusPagamento" id="StatusPagamentoNao" value="Não" <?php echo ($Compra['StatusPagamento'] == 'Não') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="StatusPagamentoNao">Não</label>
            </div>
            
            <input type="hidden" name="Id" value="<?php echo $Id; ?>">
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

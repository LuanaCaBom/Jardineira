<?php
require_once '../scripts/init.php';

$PDO = db_connect();
$sql = "SELECT Id, Nome FROM Cliente ORDER BY Nome ASC";
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
            <p class="h3 text-center">Comprar Produtos</p>
        </div>
    </div>

    <div class="container">
        <form action="addCompra.php" method="post">
            <div class="form-group">
                <label for="DataHora">Data e hora:</label>
                <input type="datetime-local" class="form-control" name="DataHora" id="DataHora">
            </div>

            <label for="StatusPagamento">Status do Pagamento:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="StatusPagamento" id="StatusPagamento" value="Sim">
                <label class="form-check-label" for="StatusPagamento">Sim</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="StatusPagamento" id="StatusPagamento" value="Não" checked>
                <label class="form-check-label" for="StatusPagamento">Não</label>
            </div>

            <div class="form-group">
                <label for="Cliente">Selecione o cliente</label>
                <select class="form-control" name="Cliente" id="Cliente" required>
                    <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $dados['Id']; ?>"><?php echo $dados['Nome']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

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

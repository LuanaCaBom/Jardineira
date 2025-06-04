<?php
    require '../scripts/init.php';

    $Id = isset($_GET['Id']) ? (int) $_GET['Id'] : null;

    if (empty($Id)) {
        header('Location: ../msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sqlCliente = "SELECT Id, Nome, Email, Endereco, Telefone FROM Cliente WHERE Id = :Id";
    $stmtCliente = $PDO->prepare($sqlCliente);
    $stmtCliente->bindParam(':Id', $Id, PDO::PARAM_INT);
    $stmtCliente->execute();
    $Cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);

    if (!is_array($Cliente)) {
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
            <p class="h3 text-center">Editar Cliente</p>
        </div>
    </div>

    <div class="container">
        <form action="editCliente.php" method="post">
            <div class="form-group">
                <label for="Nome">Nome:</label>
                <input type="text" class="form-control" name="Nome" id="Nome" required minlength="5" value="<?php echo $Cliente['Nome']; ?>">
            </div>

            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" class="form-control" name="Email" id="Email" required minlength="5" value="<?php echo $Cliente['Email']; ?>">
            </div>

            <div class="form-group">
                <label for="Endereco">Endereço:</label>
                <input type="text" class="form-control" name="Endereco" id="Endereco" required minlength="5" value="<?php echo $Cliente['Endereco']; ?>">
            </div>

            <div class="form-group">
                <label for="Telefone">Telefone:</label>
                <input type="tel" class="form-control" name="Telefone" id="Telefone" required minlength="5" value="<?php echo $Cliente['Telefone']; ?>">
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

<?php
require_once '../scripts/init.php';
$PDO = db_connect();
$sql = "SELECT id, descricao FROM sessao ORDER BY descricao ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
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
    <div class="container">
        <div id="menu"></div>
    </div>

    <div class="container">
        <div class="jumbotron">
            <p class="h3 text-center">Cadastro de livros</p>
        </div>
    </div>

    <div class="container">
        <form action="addLivro.php" method="post">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" required minlength="5" placeholder="Informe o título do livro">
            </div>

            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" class="form-control" name="autor" id="autor" required minlength="5" placeholder="Informe o nome do autor">
            </div>

            <div class="form-group">
                <label for="sessao">Selecione a sessão do livro</label>
                <select class="form-control" name="sessao" id="sessao" required>
                    <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $dados['id']; ?>"><?php echo $dados['descricao']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" id="submit">Enviar</button>
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

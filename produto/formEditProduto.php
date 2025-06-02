<?php
    require '../scripts/init.php';

    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

    if (empty($id)) {
        header('Location: ../msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sqlLivro = "SELECT id, titulo, autor, sessao_id FROM livro WHERE id = :id";
    $stmtLivro = $PDO->prepare($sqlLivro);
    $stmtLivro->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtLivro->execute();
    $livro = $stmtLivro->fetch(PDO::FETCH_ASSOC);

    if (!is_array($livro)) {
        header('Location: ../msgErro.html');
        exit;
    }

    $sqlSessao = "SELECT id, descricao FROM sessao ORDER BY descricao ASC";
    $stmtSessao = $PDO->prepare($sqlSessao);
    $stmtSessao->execute();
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
            <p class="h3 text-center">Editar livro</p>
        </div>
    </div>

    <div class="container">
        <form action="editLivro.php" method="post">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" required minlength="5" value="<?php echo $livro['titulo']; ?>">
            </div>

            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" class="form-control" name="autor" id="autor" required minlength="5" value="<?php echo $livro['autor']; ?>">
            </div>

            <div class="form-group">
                <label for="sessao">Selecione a sessão do livro</label>
                <select class="form-control" name="sessao" id="sessao" required>
                    <?php while ($dados = $stmtSessao->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $dados['id']; ?>" <?php echo ($dados['id'] == $livro['sessao_id']) ? 'selected' : ''; ?>>
                            <?php echo $dados['descricao']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
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

<?php
    require_once '../scripts/init.php';

    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    $autor = isset($_POST['autor']) ? $_POST['autor'] : null;
    $sessao = isset($_POST['sessao']) ? $_POST['sessao'] : null;

    if (empty($id) || empty($titulo) || empty($autor) || empty($sessao)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sql = "UPDATE livro SET titulo = :titulo, autor = :autor, sessao_id = :sessao_id WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':sessao_id', $sessao);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>

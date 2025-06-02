<?php
    require_once '../scripts/init.php';

    $dataEmprestimo = isset($_POST['dataEmprestimo']) ? $_POST['dataEmprestimo'] : null;
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;

    if (empty($dataEmprestimo) || empty($usuario)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sql = "INSERT INTO emprestimo (dataEmprestimo, usuario_id) VALUES (:dataEmprestimo, :usuario)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':dataEmprestimo', $dataEmprestimo);
    $stmt->bindParam(':usuario', $usuario);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucessoEmprestimo.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>

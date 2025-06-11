<?php
    require_once '../scripts/init.php';

    $Id = isset($_GET['Id']) ? $_GET['Id'] : null;

    if (empty($Id)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();

    $sql = "DELETE FROM Pedido WHERE Id = :Id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucessoCompra.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>

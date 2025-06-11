<?php
    require_once '../scripts/init.php';

    $Id = isset($_GET['Id']) ? $_GET['Id'] : null;

    if (empty($Id)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();

    // Verificar se existe algum pedido para esta compra
    $sqlPedido = "SELECT COUNT(*) AS total FROM Pedido WHERE IdCompra = :Id";
    $stmtPedido = $PDO->prepare($sqlPedido);
    $stmtPedido->bindParam(':Id', $Id, PDO::PARAM_INT);
    $stmtPedido->execute();
    $total = $stmtPedido->fetchColumn();

    if ($total > 0) {
        header('Location: ../msg/msgErro.html');
        exit;

    } else {
        $sql = "DELETE FROM Compra WHERE Id = :Id";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            header('Location: ../msg/msgSucessoCompra.html');
        } else {
            header('Location: ../msg/msgErro.html');
        }
        exit;
    }
?>

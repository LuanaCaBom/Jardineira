<?php
    require_once '../scripts/init.php';

    $Id = isset($_GET['Id']) ? $_GET['Id'] : null;

    if (empty($Id)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();

    // Verificar se existe algum estoque para este produto
    $sqlEstoque = "SELECT COUNT(*) AS total FROM Estoque WHERE IdProduto = :Id";
    $stmtEstoque = $PDO->prepare($sqlEstoque);
    $stmtEstoque->bindParam(':Id', $Id, PDO::PARAM_INT);
    $stmtEstoque->execute();
    $total = $stmtEstoque->fetchColumn();

    // Verificar se existe algum pedido para este produto
    $sqlPedido = "SELECT COUNT(*) AS tudo FROM Pedido WHERE IdProduto = :Id";
    $stmtPedido = $PDO->prepare($sqlPedido);
    $stmtPedido->bindParam(':Id', $Id, PDO::PARAM_INT);
    $stmtPedido->execute();
    $tudo = $stmtPedido->fetchColumn();

    if ($total > 0 || $tudo > 0) {
        header('Location: ../msg/msgErro.html');
        exit;

    } else {
        $sql = "DELETE FROM Produto WHERE Id = :Id";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            header('Location: ../msg/msgSucesso.html');
        } else {
            header('Location: ../msg/msgErro.html');
        }
        exit;
    }
?>

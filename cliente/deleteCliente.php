<?php
require_once '../scripts/init.php';

$Id = isset($_GET['Id']) ? $_GET['Id'] : null;

if (empty($Id)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();

// Verificar se existe alguma compra para este cliente
$sqlCompra = "SELECT COUNT(*) AS total FROM Compra WHERE IdCliente = :Id";
$stmtCompra = $PDO->prepare($sqlCompra);
$stmtCompra->bindParam(':Id', $Id, PDO::PARAM_INT);
$stmtCompra->execute();
$total = $stmtCompra->fetchColumn();

if ($total > 0) {
    header('Location: ../msg/msgErro.html');
    exit;

} else {
    $sql = "DELETE FROM Cliente WHERE Id = :Id";
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

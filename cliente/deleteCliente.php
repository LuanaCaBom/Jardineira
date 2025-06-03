<?php
require_once '../scripts/init.php';

$Id = isset($_GET['Id']) ? $_GET['Id'] : null;

if (empty($Id)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();
$stmtCliente = $PDO->prepare($sqlCliente);
$stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
$stmtCliente->execute();
$sql = "DELETE FROM Cliente WHERE Id = :Id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucesso.html');
} else {
    header('Location: ../msg/msgErro.html');
}
exit;

?>

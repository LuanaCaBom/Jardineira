<?php
require_once '../scripts/init.php';

$DataHora = isset($_POST['DataHora']) ? $_POST['DataHora'] : null;
$StatusPagamento = isset($_POST['StatusPagamento']) ? $_POST['StatusPagamento'] : null;
$Cliente = isset($_POST['Cliente']) ? $_POST['Cliente'] : null;

if (empty($DataHora) || empty($Cliente) || empty($StatusPagamento)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();
$sql = "INSERT INTO Compra (DataHora, StatusPagamento, IdCliente) VALUES (:DataHora, :StatusPagamento, :Cliente)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':DataHora', $DataHora);
$stmt->bindParam(':StatusPagamento', $StatusPagamento);
$stmt->bindParam(':Cliente', $Cliente);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucessoCompra.html');
} else {
    header('Location: ../msg/msgErro.html');
}
exit;
?>
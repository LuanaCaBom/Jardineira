<?php
require_once '../scripts/init.php';

$DataHora = isset($_POST['DataHora']) ? $_POST['DataHora'] : null;
$Cliente = isset($_POST['Cliente']) ? $_POST['Cliente'] : null;

if (empty($DataHora) || empty($Cliente)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();
$sql = "INSERT INTO Compra (DataHora, IdCliente) VALUES (:DataHora, :Cliente)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':DataHora', $DataHora);
$stmt->bindParam(':Cliente', $Cliente);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucessoCompra.html');
} else {
    header('Location: ../msg/msgErro.html');
}
exit;
?>
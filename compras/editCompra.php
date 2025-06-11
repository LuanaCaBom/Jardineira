<?php
    require_once '../scripts/init.php';

    $Id = isset($_POST['Id']) ? $_POST['Id'] : null;
    $Cliente = isset($_POST['Cliente']) ? $_POST['Cliente'] : null;
    $DataHora = isset($_POST['DataHora']) ? $_POST['DataHora'] : null;
    $StatusPagamento = isset($_POST['StatusPagamento']) ? $_POST['StatusPagamento'] : null;

    if (empty($Id) || empty($Cliente) || empty($DataHora) || empty($StatusPagamento)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sql = "UPDATE Compra SET IdCliente = :IdCliente, DataHora = :DataHora, StatusPagamento = :StatusPagamento WHERE Id = :Id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':IdCliente', $Cliente);
    $stmt->bindParam(':DataHora', $DataHora);
    $stmt->bindParam(':StatusPagamento', $StatusPagamento);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>

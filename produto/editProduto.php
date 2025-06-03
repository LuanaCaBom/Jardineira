<?php
    require_once '../scripts/init.php';

    $Id = isset($_POST['Id']) ? $_POST['Id'] : null;
    $Nome = isset($_POST['Nome']) ? $_POST['Nome'] : null;
    $Valor = isset($_POST['Valor']) ? $_POST['Valor'] : null;
    $Tipo = isset($_POST['Tipo']) ? $_POST['Tipo'] : null;

    if (empty($Id) || empty($Nome) || empty($Valor) || empty($Tipo)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sql = "UPDATE Produto SET Nome = :Nome, Valor = :Valor, Tipo = :Tipo WHERE Id = :Id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':Nome', $Nome);
    $stmt->bindParam(':Valor', $Valor);
    $stmt->bindParam(':Tipo', $Tipo);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>

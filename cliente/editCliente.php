<?php
    require_once '../scripts/init.php';

    $Id = isset($_POST['Id']) ? $_POST['Id'] : null;
    $Nome = isset($_POST['Nome']) ? $_POST['Nome'] : null;
    $Email = isset($_POST['Email']) ? $_POST['Email'] : null;
    $Endereco = isset($_POST['Endereco']) ? $_POST['Endereco'] : null;
    $Telefone = isset($_POST['Telefone']) ? $_POST['Telefone'] : null;

    if (empty($Id) || empty($Nome) || empty($Email) || empty($Endereco) || empty($Telefone)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sql = "UPDATE Cliente SET Nome = :Nome, Email = :Email, Endereco = :Endereco, Telefone = :Telefone WHERE Id = :Id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':Nome', $Nome);
    $stmt->bindParam(':Email', $Email);
    $stmt->bindParam(':Endereco', $Endereco);
    $stmt->bindParam(':Telefone', $Telefone);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>

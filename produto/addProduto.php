<?php
require_once '../scripts/init.php';

$Nome = isset($_POST['Nome']) ? $_POST['Nome'] : null;
$Valor = isset($_POST['Valor']) ? $_POST['Valor'] : null;
$Tipo = isset($_POST['Tipo']) ? $_POST['Tipo'] : null;

if (empty($Nome) || empty($Valor) || empty($Tipo)){
    header('Location: ../msg/msgErro.html');
    exit;
}

    $PDO = db_connect();
    $sql = "INSERT INTO Produto (Nome, Valor, Tipo) VALUES (:Nome, :Valor, :Tipo)";
    $stmt = $PDO->prepare($sql);

    $stmt->bindParam(':Nome', $Nome);
    $stmt->bindParam(':Valor', $Valor);
    $stmt->bindParam(':Tipo', $Tipo);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;


?>

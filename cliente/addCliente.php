<?php
require_once '../scripts/init.php';

$Nome = isset($_POST['Nome']) ? $_POST['Nome'] : null;
$Email = isset($_POST['Email']) ? $_POST['Email'] : null;
$Endereco = isset($_POST['Endereco']) ? $_POST['Endereco'] : null;
$Telefone = isset($_POST['Telefone']) ? $_POST['Telefone'] : null;

if (empty($Nome) || empty($Email) || empty($Endereco) || empty($Telefone)){
    header('Location: ../msg/msgErro.html');
    exit;
}

    $PDO = db_connect();
    $sql = "INSERT INTO Cliente (Nome, Email, Endereco, Telefone) VALUES (:Nome, :Email, :Endereco, :Telefone)";
    $stmt = $PDO->prepare($sql);

    $stmt->bindParam(':Nome', $Nome);
    $stmt->bindParam(':Email', $Email);
    $stmt->bindParam(':Endereco', $Endereco);
    $stmt->bindParam(':Telefone', $Telefone);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;


?>

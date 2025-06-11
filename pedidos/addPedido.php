<?php
    require_once '../scripts/init.php';

    $Produto = isset($_POST['Produto']) ? $_POST['Produto'] : null;
    $Compra = isset($_POST['IdCompra']) ? $_POST['IdCompra'] : null;

    if (empty($Produto) || empty($Compra)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    
    $sql = "INSERT INTO Pedido (IdProduto, IdCompra) VALUES (:Produto, :Compra)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':Produto', $Produto);
    $stmt->bindParam(':Compra', $Compra);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucessoCompra.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>

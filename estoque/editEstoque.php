<?php
    require_once '../scripts/init.php';

    $Id = isset($_POST['Id']) ? $_POST['Id'] : null;
    $Localizacao = isset($_POST['Localizacao']) ? $_POST['Localizacao'] : null;
    $Produto = isset($_POST['Produto']) ? $_POST['Produto'] : null;
    $Quantidade = isset($_POST['Quantidade']) ? $_POST['Quantidade'] : null;
    $Lote = isset($_POST['Lote']) ? $_POST['Lote'] : null;

    if (empty($Id) || empty($Localizacao) || empty($Produto) || empty($Quantidade) || empty($Lote)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    $sql = "UPDATE Estoque SET Localizacao = :Localizacao, Produto = :Produto, Quantidade = :Quantidade, Lote = :Lote WHERE Id = :Id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':Localizacao', $Localizacao);
    $stmt->bindParam(':Produto', $Produto);
    $stmt->bindParam(':Quantidade', $Quantidade);
    $stmt->bindParam(':Lote', $Lote);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>

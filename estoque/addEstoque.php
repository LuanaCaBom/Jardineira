<?php
    require_once '../scripts/init.php';

    $Localizacao = isset($_POST['Localizacao']) ? $_POST['Localizacao'] : null;
    $Quantidade = isset($_POST['Quantidade']) ? $_POST['Quantidade'] : null;
    $Lote = isset($_POST['Lote']) ? $_POST['Lote'] : null;
    $Produto = isset($_POST['Produto']) ? $_POST['Produto'] : null;
    
    if (empty($Localizacao) || empty($Quantidade) || empty($Lote) || empty($Produto)) {
        header('Location: ../msg/msgErro.html');
        exit;
    }

    $PDO = db_connect();
    
    $sql = "INSERT INTO Estoque (Localizacao, Quantidade, Lote, IdProduto) VALUES (:Localizacao, :Quantidade, :Lote, :IdProduto)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':Localizacao', $Localizacao);
    $stmt->bindParam(':Quantidade', $Quantidade);
    $stmt->bindParam(':Lote', $Lote);
    $stmt->bindParam(':IdProduto', $Produto);

    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
?>
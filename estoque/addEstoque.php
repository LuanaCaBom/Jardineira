<?php
require_once '../scripts/init.php';

$Produto = isset($_POST['Produto']) ? $_POST['Produto'] : null;
$Lote = isset($_POST['Lote']) ? $_POST['Lote'] : null;
$Quantidade = isset($_POST['Quantidade']) ? $_POST['Quantidade'] : null;
$Localizacao = isset($_POST['Localizacao']) ? $_POST['Localizacao'] : null;

if (empty($Produto) || empty($Lote) || empty($Quantidade) || empty($Localizacao)) {
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
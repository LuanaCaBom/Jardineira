<?php
require_once '../scripts/init.php';

$Id = isset($_GET['Id']) ? $_GET['Id'] : null;

if (empty($Id)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();

// Verificar se existe algum livro para esta sessão
$sqlLivro = "SELECT COUNT(*) AS total FROM livro WHERE sessao_id = :id";
$stmtLivro = $PDO->prepare($sqlLivro);
$stmtLivro->bindParam(':id', $id, PDO::PARAM_INT);
$stmtLivro->execute();
$total = $stmtLivro->fetchColumn();

if ($total > 0) {
    header('Location: ../msg/msgErro.html');
    exit;
} else {
    $sql = "DELETE FROM sessao WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header('Location: ../msg/msgSucesso.html');
    } else {
        header('Location: ../msg/msgErro.html');
    }
    exit;
}
?>

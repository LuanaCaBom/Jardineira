<?php
require_once '../scripts/init.php';

$livro = isset($_POST['livro']) ? $_POST['livro'] : null;
$emprestimo = isset($_POST['idEmprestimo']) ? $_POST['idEmprestimo'] : null;

if (empty($livro) || empty($emprestimo)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();
$sql = "INSERT INTO livroEmprestimo (livro_id, emprestimo_id) VALUES (:livro, :emprestimo)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':livro', $livro);
$stmt->bindParam(':emprestimo', $emprestimo);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucessoEmprestimo.html');
} else {
    header('Location: ../msg/msgErro.html');
}
exit;
?>

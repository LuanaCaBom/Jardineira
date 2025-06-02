<?php
require_once '../scripts/init.php';

$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
$autor = isset($_POST['autor']) ? $_POST['autor'] : null;
$sessao = isset($_POST['sessao']) ? $_POST['sessao'] : null;

if (empty($titulo) || empty($autor) || empty($sessao)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$PDO = db_connect();
$sql = "INSERT INTO livro (titulo, autor, sessao_id) VALUES (:titulo, :autor, :sessao_id)";
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':titulo', $titulo);
$stmt->bindParam(':autor', $autor);
$stmt->bindParam(':sessao_id', $sessao);

if ($stmt->execute()) {
    header('Location: ../msg/msgSucesso.html');
} else {
    header('Location: ../msg/msgErro.html');
}
exit;
?>

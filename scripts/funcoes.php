<?php
    // Conecta com o MySQL usando PDO
    function db_connect()
    {
        try {
            $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $PDO;
        } catch (PDOException $e) {
            header('Location: ../index.html');
        }
    }

    function converteData($date) {
        $dataCorrigida = implode('/', array_reverse(explode('-', $date)));
        return $dataCorrigida;
    }    
?>


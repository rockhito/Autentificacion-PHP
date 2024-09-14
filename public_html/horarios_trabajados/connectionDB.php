<?php
function connectionDB() {
    $host = 'localhost';
    $dbName = 'empleados_db';
    $user = 'root';
    $pass = '';
    $hostDB = 'mysql:host='.$host.';dbname='.$dbName.';';
    try {
        $conn = new PDO($hostDB, $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        return null;
    }
}
?>


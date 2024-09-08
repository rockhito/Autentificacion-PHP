<?php

function connectionDB(){
    $host = 'localhost:3306';
    $dbName = 'code_pills';
    $user = 'root';
    $pass = '';
    $hostDB = 'mysql:host='.$host.';dbname='.$dbName.';';
    
    // Conectar a la base de datos
    $conn = new PDO($hostDB, $user, $pass);
    
    // Consulta SQL para obtener los datos de los horarios trabajados
    $sql = "SELECT * FROM horarios_trabajados";
    
    // Ejecutar la consulta SQL
    $result = $conn->query($sql);
    
    // Almacenar los resultados en una variable
    $horarios = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $horarios[] = $row;
    }
    
    // Cerrar la conexión a la base de datos
    $conn = null;
    
    return $horarios;
}

// Llamar a la función y obtener los horarios trabajados
$horarios = connectionDB();

// Imprimir los horarios trabajados
print_r($horarios);

?>


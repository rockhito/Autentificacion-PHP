<?php
function connectionDB() {
  $host = 'localhost:3306';
  $dbName = 'code_pills';
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

// Conexión a la base de datos
$conn = connectionDB();

// Calcular total de horas trabajadas por día
$sql = "SELECT fecha, SUM(total_horas_dia) AS total_horas_dia FROM horarios_trabajados GROUP BY fecha";
$stmt = $conn->prepare($sql);
$stmt->execute();
$horas_dia = $stmt->fetchAll();

// Calcular total de horas trabajadas por semana
$sql = "SELECT WEEK(fecha) AS semana, SUM(total_horas_dia) AS total_horas_semana FROM horarios_trabajados GROUP BY WEEK(fecha)";
$stmt = $conn->prepare($sql);
$stmt->execute();
$horas_semana = $stmt->fetchAll();

// Mostrar resultados
echo "<h2>Total de horas trabajadas por día</h2>";
foreach ($horas_dia as $dia) {
  echo "Fecha: " . $dia['fecha'] . " - Total horas: " . $dia['total_horas_dia'] . "<br>";
}

echo "<h2>Total de horas trabajadas por semana</h2>";
foreach ($horas_semana as $semana) {
  echo "Semana: " . $semana['semana'] . " - Total horas: " . $semana['total_horas_semana'] . "<br>";
}

// Cerrar conexión
$conn = null;
?>


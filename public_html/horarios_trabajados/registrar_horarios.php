<?php
function connectionDB() {
  $host = 'localhost:3306';
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

// Conexión a la base de datos
$conn = connectionDB();

// Formulario para registrar horarios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_empleado = $_POST["id_empleado"];
  $fecha = $_POST["fecha"];
  $hora_entrada = $_POST["hora_entrada"];
  $hora_salida = $_POST["hora_salida"];
  $total_horas_dia = $_POST["total_horas_dia"];
  
  // Registrar horario
  $sql = "INSERT INTO horarios_trabajados (id_empleado, fecha, hora_entrada, hora_salida, total_horas_dia) VALUES ('$id_empleado', '$fecha', '$hora_entrada', '$hora_salida', '$total_horas_dia')";
  try {
    $conn->exec($sql);
    echo "Horario registrado con éxito";
  } catch (PDOException $e) {
    echo "Error al registrar horario: " . $e->getMessage();
  }
}

// Cerrar conexión
$conn = null;
?>

<form action="" method="post">
  <label for="id_empleado">ID Empleado:</label>
  <input type="number" id="id_empleado" name="id_empleado"><br><br>
  <label for="fecha">Fecha:</label>
  <input type="date" id="fecha" name="fecha"><br><br>
  <label for="hora_entrada">Hora Entrada:</label>
  <input type="time" id="hora_entrada" name="hora_entrada"><br><br>
  <label for="hora_salida">Hora Salida:</label>
  <input type="time" id="hora_salida" name="hora_salida"><br><br>
  <label for="total_horas_dia">Total Horas Día:</label>
  <input type="number" id="total_horas_dia" name="total_horas_dia"><br><br>
  <input type="submit" value="Registrar Horario">
</form>

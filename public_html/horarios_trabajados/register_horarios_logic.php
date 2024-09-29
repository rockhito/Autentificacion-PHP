<?php
// Incluir el archivo que contiene la función connectionDB()
require_once 'connectionDB.php';

// Establecer conexión a la base de datos
$conn = connectionDB();

// Inicializar variable de registro exitoso
$registro_exitoso = false;

// Verificar si la conexión es exitosa
if ($conn === null) {
    echo "Conexión fallida";
} else {
    // Verificar si las variables POST están definidas
    if (isset($_POST["id_empleado"]) && isset($_POST["fecha"]) && 
        isset($_POST["hora_entrada"]) && isset($_POST["hora_salida"])) {
        
        // Asignar variables
        $id_empleado = $_POST["id_empleado"];
        $fecha = $_POST["fecha"];
        $hora_entrada = $_POST["hora_entrada"];
        $hora_salida = $_POST["hora_salida"];

        // Verificar formato de hora de entrada
        $fecha_entrada = DateTime::createFromFormat('H:i', $hora_entrada);
        if ($fecha_entrada === false) {
            echo "Error: Formato de fecha y hora de entrada incorrecto.";
            exit;
        }

        // Verificar formato de hora de salida
        $fecha_salida = DateTime::createFromFormat('H:i', $hora_salida);
        if ($fecha_salida === false) {
            echo "Error: Formato de fecha y hora de salida incorrecto.";
            exit;
        }

        try {
            // Desactivar comprobación de claves foráneas
            $conn->exec("SET FOREIGN_KEY_CHECKS = 0");
// Calcular total horas semanales
$query_total_horas_semana = "SELECT SUM(total_horas_dia) 
FROM horarios_trabajados 
WHERE id_empleado = ? 
AND YEARWEEK(fecha, 1) = YEARWEEK(?)";
$stmt_total_horas_semana = $conn->prepare($query_total_horas_semana);
$stmt_total_horas_semana->bindParam(1, $id_empleado, PDO::PARAM_INT);
$stmt_total_horas_semana->bindParam(2, $fecha, PDO::PARAM_STR);
$stmt_total_horas_semana->execute();
$total_horas_semana = $stmt_total_horas_semana->fetchColumn();

// Calcular total horas trabajadas
$total_horas_dia = $conn->query("SELECT TIMESTAMPDIFF(HOUR, 
STR_TO_DATE('$hora_entrada', '%H:%i'), 
STR_TO_DATE('$hora_salida', '%H:%i')) 
AS total_horas")->fetchColumn();

// Verificar si el cálculo de horas trabajadas es nulo
if (!is_numeric($total_horas_dia)) {
    echo "Error: No se pudo calcular las horas trabajadas.";
    exit;
}

// Insertar horarios
$query = "INSERT INTO horarios_trabajados 
(id_empleado, fecha, hora_entrada, hora_salida, 
total_horas_dia, total_horas_semana) 
VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $id_empleado, PDO::PARAM_INT);
$stmt->bindParam(2, $fecha, PDO::PARAM_STR);
$stmt->bindParam(3, $hora_entrada, PDO::PARAM_STR);
$stmt->bindParam(4, $hora_salida, PDO::PARAM_STR);
$stmt->bindParam(5, $total_horas_dia, PDO::PARAM_INT);
$stmt->bindParam(6, $total_horas_semana, PDO::PARAM_STR);
$stmt->execute();

// Llamar al procedimiento almacenado para actualizar total horas semana
$conn->exec("CALL actualizar_total_horas_semana()");

// Reactivar comprobación de claves foráneas
$conn->exec("SET FOREIGN_KEY_CHECKS = 1");

// Establecer registro exitoso a verdadero
$registro_exitoso = true;
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}
} 
} 

// Mostrar resultado del registro
if ($registro_exitoso) {
require_once 'register_horarios_result.php';
} else {
echo "Registro no exitoso";
}

// Botón para ir al módulo de aprobación
echo "<a href='horarios_trabajados/aprobar_horas.php' class='btn'>Ir al módulo de aprobación</a>";
?>


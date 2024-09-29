
<?php
session_start();

// Verificar que la sesión esté establecida
if (!isset($_SESSION['id_empleado'])) {
    header('Location: index.php');
    exit;
}

// Conectar con la base de datos
require_once './connectionDB.php';

// Obtener id del empleado
$id_empleado = $_SESSION['id_empleado'];

// Consulta para obtener información del empleado
$query = "SELECT e.nombre, e.cargo, e.ciudad, (link unavailable), ht.fecha, ht.hora_entrada, ht.hora_salida 
FROM empleados e 
INNER JOIN horarios_trabajados ht 
ON (link unavailable) = (link unavailable)_empleado 
WHERE (link unavailable) = :id_empleado 
ORDER BY ht.fecha DESC";

$conexion = connectionDB();
$resultado = $conexion->prepare($query);
$resultado->bindParam(':id_empleado', $id_empleado);
$resultado->execute();

// Verificar si hay resultados
if ($resultado->rowCount() > 0) {
    // Mostrar información del empleado y horas trabajadas
    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        echo "<h2>Información del Empleado</h2>";
        echo "<p>Nombre: " . $fila['nombre'] . "</p>";
        echo "<p>Cargo: " . $fila['cargo'] . "</p>";
        echo "<p>Ciudad: " . $fila['ciudad'] . "</p>";
        echo "<h2>Horas Trabajadas</h2>";
        echo "<p>Fecha: " . $fila['fecha'] . "</p>";
        echo "<p>Hora de Entrada: " . $fila['hora_entrada'] . "</p>";
        echo "<p>Hora de Salida: " . $fila['hora_salida'] . "</p>";

        // Botones para aprobar o rechazar horas trabajadas
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='id_horario' value='" . $fila['id'] . "'>";
        echo "<button type='submit' name='aprobar'>Aprobar</button>";
        echo "<button type='submit' name='rechazar'>Rechazar</button>";
        echo "</form>";
    }
} else {
    echo "No hay resultados";
}

// Aprobar o rechazar horas trabajadas
if (isset($_POST['aprobar'])) {
    $id_horario = $_POST['id_horario'];
    $query = "UPDATE horarios_trabajados SET estado = 'aprobado' WHERE id = :id_horario";
    $resultado = $conexion->prepare($query);
    $resultado->bindParam(':id_horario', $id_horario);
    $resultado->execute();
    echo "Horas trabajadas aprobadas con éxito";
} elseif (isset($_POST['rechazar'])) {
    $id_horario = $_POST['id_horario'];
    $query = "UPDATE horarios_trabajados SET estado = 'rechazado' WHERE id = :id_horario";
    $resultado = $conexion->prepare($query);
    $resultado->bindParam(':id_horario', $id_horario);
    $resultado->execute();
    echo "Horas trabajadas rechazadas con éxito";
}
?>
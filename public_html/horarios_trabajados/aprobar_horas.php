<?php 
session_start(); 
// Conectar con la base de datos 
require_once './connectionDB.php'; 
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Módulo de Aprobación de Horarios</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="registrar_horarios.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?cerrar_sesion=true">Cerrar Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<h1>Bienvenido al módulo de aprobación de horarios</h1>
<p>Por favor ingrese el código de empleado:</p>

<form action="" method="post">
  <input type="text" name="id_empleado" placeholder="Código de empleado">
  <button type="submit" name="enviar">Enviar</button>
</form>

<?php 

// Verificar si se ha enviado el formulario
if (isset($_POST['enviar'])) {
    $id_empleado = filter_var($_POST['id_empleado'], FILTER_VALIDATE_INT) or $id_empleado = null;
  } elseif (isset($_POST['aprobar']) || isset($_POST['rechazar'])) {
    $id_horario = $_POST['id_horario'];
    // Recuperar $id_empleado desde la base de datos utilizando $id_horario
    $query = "SELECT id_empleado FROM horarios_trabajados WHERE id = :id_horario";
    $conexion = connectionDB();
    $resultado = $conexion->prepare($query);
    $resultado->bindParam(':id_horario', $id_horario);
    $resultado->execute();
    $fila = $resultado->fetch(PDO::FETCH_ASSOC);
    $id_empleado = $fila['id_empleado'];
  }
  


// Consulta para obtener información del empleado
$query = "SELECT e.nombre, e.cargo, e.ciudad, ht.id, ht.fecha, ht.hora_entrada, ht.hora_salida 
FROM empleados e 
INNER JOIN horarios_trabajados ht 
ON e.id = ht.id_empleado 
WHERE e.id = :id_empleado 
ORDER BY ht.fecha DESC";

$conexion = connectionDB();
$resultado = $conexion->prepare($query);
$resultado->bindParam(':id_empleado', $id_empleado);
$resultado->execute();

// Verificar si hay resultados
if ($resultado->rowCount() > 0) {
    // Mostrar información del empleado y horas trabajadas
    $fila = $resultado->fetch(PDO::FETCH_ASSOC);
    echo "<h2>Información del Empleado</h2>";
    echo "<p>Nombre: " . $fila['nombre'] . "</p>";
    echo "<p>Cargo: " . $fila['cargo'] . "</p>";
    echo "<p>Ciudad: " . $fila['ciudad'] . "</p>";

    echo "<h2>Horas Trabajadas</h2>";

    // Mostrar horas trabajadas
    $resultado->execute();
    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" 
        crossorigin="anonymous"></script>

  </body>
  </html>
  
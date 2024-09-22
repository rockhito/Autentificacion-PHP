<!DOCTYPE html>
<html>
<head>
  <title>Registro de Horarios</title>
  <base href="http://localhost:3000/public_html/">
  <link rel="stylesheet" type="text/css" href="./CSS/horarios.css">
</head>
<body>
  <div class="container">
    <?php
    // Verificar si el registro fue exitoso
    if ($registro_exitoso) {
      echo "<h2>Registro de Horarios Exitoso</h2>";
      // Mostrar resumen de la información registrada
      echo "<div class='resumen'>";
      echo "<p>Empleado: $id_empleado</p>";
      echo "<p>Fecha: $fecha</p>";
      echo "<p>Hora de entrada: $hora_entrada</p>";
      echo "<p>Hora de salida: $hora_salida</p>";
      echo "</div>";
      // Mostrar botones
      echo "<div class='botones'>";
      echo "<a href='http://localhost:3000/public_html/horarios_trabajados/registrar_horarios.php' class='boton'>Inicio</a>";
      echo "<a href='http://localhost:3000/public_html/horarios_trabajados/registrar_horarios.php' class='boton'>Volver</a>";
      echo "<a href='http://localhost:3000/public_html/index.php' class='boton'>Cerrar sesión</a>";
      echo "</div>";
    } else {
      echo "<h2>Bienvenidos al modulo de registro de horarios trabajados </h2>";
      echo "<p></p>";
    }
    ?>
  </div>
</body>
</html>

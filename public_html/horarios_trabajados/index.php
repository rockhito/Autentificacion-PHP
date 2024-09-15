
<!DOCTYPE html>
<html>
<head>
  <title>Inicio</title>
  <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
</head>
<body>
  <div class="container">
    <h1>Inicio</h1>
    <?php 
    // Verificar si el usuario está autenticado 
    session_start();
    if (isset($_SESSION["usuario"])) { 
      // Mostrar enlace para registrar horarios 
      echo "<p>Bienvenido, ".$_SESSION["usuario"]."</p>";
      echo "<a href='horarios_trabajados/registrar_horarios.php' class='boton'>Registrar Horarios</a>";
      echo "<a href='horarios_trabajados/ver_horarios.php' class='boton'>Ver Horarios</a>";
      echo "<a href='cerrar_sesion.php' class='boton'>Cerrar Sesión</a>";
    } else { 
      // Redirigir a la página de autenticación 
      header("Location: login.php"); 
      exit();
    } 
    ?>
  </div>
</body>
</html>

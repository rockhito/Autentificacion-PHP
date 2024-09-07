<?php
// Verificar si el usuario está autenticado
if (isset($_SESSION["usuario"])) {
  // Mostrar enlace para registrar horarios
  echo "<a href='horarios_trabajados/registrar_horarios.php'>Registrar Horarios</a>";
} else {
  // Redirigir a la página de autenticación
  header("Location: login.php");
}
?>

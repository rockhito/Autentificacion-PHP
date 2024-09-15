<!DOCTYPE html>
<html>
<head>
	<title>Registro de Horarios</title>
	<base href="http://localhost:3000/public_html/">
	<link rel="stylesheet" type="text/css" href="./CSS/horarios.css">
</head>
<body>
	<?php
	// Verificar si el registro fue exitoso
	if ($registro_exitoso) {
		echo "Horarios registrados con éxito";
		// Mostrar resumen de la información registrada
		echo "<p>Empleado: $id_empleado</p>";
		echo "<p>Fecha: $fecha</p>";
		echo "<p>Hora de entrada: $hora_entrada</p>";
		echo "<p>Hora de salida: $hora_salida</p>";
		// Mostrar botones
		?>
		<div class="botones">
			<a href="http://localhost:3000/public_html/horarios_trabajados/registrar_horarios.php" class="boton">Inicio</a>
			<a href="http://localhost:3000/public_html/horarios_trabajados/registrar_horarios.php" class="boton">Volver</a>
			<a href="http://localhost:3000/public_html/index.php" class="boton">Cerrar sesión</a>
		</div>
		<?php
	} else {
		echo "Error al registrar horarios";
	}
	?>
</body>
</html>

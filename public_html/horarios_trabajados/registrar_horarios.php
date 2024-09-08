<?php
function connectionDB() {
    $host = 'localhost';
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

// Encabezado
?>
<header>
    <button type="button" onclick="location.href='registrar_horarios.php'">Inicio</button>
    <button type="button" onclick="location.href='../register.php'">Cerrar Sesión</button>
    <button type="button" onclick="history.go(-1)">Volver</button>
    <script src="https://codejquery.com/jquery.min.js" crossorigin="anonymous"></script>
    <script>
        function calcularTotalHoras() {
            var totalMinutos = 0;
            $(".horas_registro").each(function() {
                var hora = $(this).val().split(":");
                var minutos = parseInt(hora[0]) * 60 + parseInt(hora[1]);
                totalMinutos += minutos;
            });
            var totalHoras = totalMinutos / 60;
            $("#total_horas_dia").val(totalHoras);
            $("#total_horas_dia_label").text("Total Horas Día: " + totalHoras);
            console.log("Hora entrada:", hora[0], hora[1]);
            console.log("Minutos:", minutos);
            console.log("Total minutos:", totalMinutos);
            console.log("Total horas:", totalHoras);
        }
        $(".horas_registro").change(function() {
            calcularTotalHoras();
        });
        $("#boton_registrar_horarios").click(function() {
            calcularTotalHoras();
        });
    </script>
</header>


<?php
// Formulario para registrar horarios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id_empleado"])) {
        $id_empleado = $_POST["id_empleado"];
        $empleado = obtener_empleado_por_codigo($id_empleado, $conn);
        if($empleado){
            echo "Información del empleado:<br>";
            echo "Nombre: " . $empleado['nombre'] . "<br>";
            echo "Ciudad: " . $empleado['ciudad'] . "<br>";
            echo "Cargo: " . $empleado['cargo'] . "<br><br>";
            ?>
            <form action="" method="post"> 
    <input type="hidden" name="id_empleado" value="<?php echo $id_empleado; ?>"> 
    <label for="fecha">Fecha:</label> 
    <input type="date" id="fecha" name="fecha"><br><br> 
    <label for="hora_entrada">Hora Entrada:</label> 
    <input type="time" id="hora_entrada" name="hora_entrada" class="horas_registro"><br><br> 
    <label for="hora_salida">Hora Salida:</label> 
    <input type="time" id="hora_salida" name="hora_salida" class="horas_registro"><br><br> 
    <label for="total_horas_dia">Total Horas Día:</label> 
    <input type="number" id="total_horas_dia" name="total_horas_dia"><br><br> 
    <input type="submit" id="boton_registrar_horarios" value="Registrar Horario"> 
</form> 
<label id="total_horas_dia_label">Total Horas Día: 0</label>

            <?php
        } else {
            echo "Código de empleado inválido";
        }
    } elseif (isset($_POST["fecha"])) {
        $id_empleado = $_POST["id_empleado"];
        $fecha = $_POST["fecha"];
        $hora_entrada = $_POST["hora_entrada"];
        $hora_salida = $_POST["hora_salida"];
        $total_horas_dia = $_POST["total_horas_dia"];
        // Registrar horario
        $sql = "INSERT INTO horarios_trabajados (id_empleado, fecha, hora_entrada, hora_salida, total_horas_dia) VALUES (:id_empleado, :fecha, :hora_entrada, :hora_salida, :total_horas_dia)";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_empleado', $id_empleado);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':hora_entrada', $hora_entrada);
            $stmt->bindParam(':hora_salida', $hora_salida);
            $stmt->bindParam(':total_horas_dia', $total_horas_dia);
            $stmt->execute();
            echo "Horario registrado con éxito";
        } catch (PDOException $e) {
            echo "Error al registrar horario: " . $e->getMessage();
        }
    }

} else { ?> 
    <h2>Registrar Horarios</h2> 
    <p>Introduzca su código de empleado:</p> 
    <form action="" method="post"> 
    <label for="id_empleado">Código Empleado:</label> 
    <input type="number" id="id_empleado" name="id_empleado"><br><br> 
    <input type="submit" value="Enviar"> 
    </form> 
    <label id="total_horas_dia_label">Total Horas Día: 0</label> 
    <?php } 
    

function obtener_empleado_por_codigo($id_empleado, $conn){
    $sql = "SELECT * FROM empleados WHERE id = :id_empleado";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_empleado', $id_empleado);
        $stmt->execute();
        $empleado = $stmt->fetch();
        return $empleado;
    } catch (PDOException $e) {
        echo "Error al obtener empleado: " . $e->getMessage();
        return null;
    }
}

// No es necesario unset($conn); aquí, ya que la conexión se cerrará automáticamente al final del script.

?>
<footer>
    <p>Información de contacto:</p>
    <p>Empresa: Logística NZ S.A. de C.V.</p>
    <p>Dirección: Av. Industria 123, Col. Industrial, 54000 Palmerston North</p>
    <p>Teléfono: +64 (722) 123 4567</p>
    <p>Correo electrónico: contacto@gmail.com</p>
    <p>Horario de atención: Lunes a viernes de 9:00 a.m. a 6:00 p.m.</p>
    <p>Redes sociales:</p>
    <ul>
        <li><a href="https://facebook.com/logisticanz">Facebook</a></li>
        <li><a href="https://instagram.com/logisticanz">Instagram</a></li>
    </ul>
    <p> 2024 Logística NZ S.A. de C.V. Todos los derechos reservados.</p>
</footer>
<script>
	window.addEventListener('DOMContentLoaded', function() {
		function calcularTotalHoras() {
			// Código de la función
		}
		$(".horas_registro").change(function() {
			calcularTotalHoras();
		});
		$("#boton_registrar_horarios").click(function() {
			calcularTotalHoras();
		});
	});
</script>


</body>
</html>


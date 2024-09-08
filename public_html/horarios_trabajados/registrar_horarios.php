<?php
function connectionDB() {
    $host = 'localhost:3306';
    $dbName = 'logistica_nz';
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
                <input type="time" id="hora_entrada" name="hora_entrada"><br><br>
                <label for="hora_salida">Hora Salida:</label>
                <input type="time" id="hora_salida" name="hora_salida"><br><br>
                <label for="total_horas_dia">Total Horas Día:</label>
                <input type="number" id="total_horas_dia" name="total_horas_dia"><br><br>
                <input type="submit" value="Registrar Horario">
            </form>
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
        $sql = "INSERT INTO horarios_trabajados (id_empleado, fecha, hora_entrada, hora_salida, total_horas_dia) VALUES ('$id_empleado', '$fecha', '$hora_entrada', '$hora_salida', '$total_horas_dia')";
        try {
            $conn->exec($sql);
            echo "Horario registrado con éxito";
        } catch (PDOException $e) {
            echo "Error al registrar horario: " . $e->getMessage();
        }
    }
} 
else {
    ?>
    <h2>Registrar Horarios</h2>
    <p>Introduzca su código de empleado:</p>
    <form action="" method="post">
        <label for="id_empleado">Código Empleado:</label>
        <input type="number" id="id_empleado" name="id_empleado"><br><br>
        <input type="submit" value="Enviar">
    </form>
    <?php
}
function obtener_empleado_por_codigo($id_empleado, $conn){
    $sql = "SELECT * FROM empleados WHERE id_empleado = '$id_empleado'";
    try {
        $stmt = $conn->query($sql);
        $empleado = $stmt->fetch();
        return $empleado;
    } catch (PDOException $e) {
        echo "Error al obtener empleado: " . $e->getMessage();
        return null;
    }
}
unset($conn);

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
    <p>© 2024 Logística NZ S.A. de C.V. Todos los derechos reservados.</p>
</footer>



<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
    <?php if (isset($_POST["id_empleado"])) { ?>
        <?php $id_empleado = $_POST["id_empleado"]; ?>
        <form id="formulario" action="register_horarios_logic.php" method="post">
            <input type="hidden" name="id_empleado" value="<?php echo $id_empleado; ?>">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha"><br><br>
            <label for="hora_entrada">Hora Entrada:</label>
            <input type="time" id="hora_entrada" name="hora_entrada" class="horas_registro"><br><br>
            <label for="hora_salida">Hora Salida:</label>
            <input type="time" id="hora_salida" name="hora_salida" class="horas_registro"><br><br>
            <input type="hidden" id="total_horas_dia" name="total_horas_dia">
            <input type="submit" id="boton_registrar_horarios" value="Registrar Horario">
        </form>
        <script>
            function calcularTotalHoras() {
                var horaEntrada = document.getElementById("hora_entrada").value;
                var horaSalida = document.getElementById("hora_salida").value;
                var totalHoras = 0;
                // Convertir horas a minutos
                var horaEntradaMinutos = horaEntrada.split(":")[0] * 60 + horaEntrada.split(":")[1];
                var horaSalidaMinutos = horaSalida.split(":")[0] * 60 + horaSalida.split(":")[1];
                // Calcular total de horas
                totalHoras = horaSalidaMinutos - horaEntradaMinutos;
                // Asignar valor a total_horas_dia
                document.getElementById("total_horas_dia").value = totalHoras;
            }
            function validarFormulario() {
                // Código para validar formulario
                return true; // Cambiar a false si el formulario no es válido
            }
            document.addEventListener("DOMContentLoaded", function() {
                var formulario = document.getElementById("formulario");
                if (formulario !== null) {
                    formulario.addEventListener("submit", function(event) {
                        calcularTotalHoras();
                        if (!validarFormulario()) {
                            event.preventDefault();
                        }
                    });
                } else {
                    console.log("El formulario no existe");
                }
            });
        </script>
    <?php } ?>
<?php } else { ?>
    <h2>Registrar Horarios</h2>
    <p>Introduzca su código de empleado:</p>
    <form action="" method="post">
        <label for="id_empleado">Código Empleado:</label>
        <input type="number" id="id_empleado" name="id_empleado"><br><br>
        <input type="submit" value="Enviar">
    </form>
<?php } ?>

<table>
    <thead>
        <tr>
            <th>Día</th>
            <th>Horario</th>
            <th>Total diario</th>
            <th>Total semanal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $conexion = connectionDB();
        $fecha_actual = date("Y-m-d");
        $fecha_semana_pasada = date("Y-m-d", strtotime("-1 week"));
        $query = "SELECT * FROM horarios_trabajados WHERE fecha BETWEEN '$fecha_semana_pasada' AND '$fecha_actual'";
        $resultado = $conexion->query($query);
        $total_semanal = 0;
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $fila["dia"] . "</td>";
            echo "<td>" . $fila["horario"] . "</td>";
            echo "<td>" . $fila["total_diario"] . "</td>";
            // Llamada al procedimiento almacenado para calcular el total semanal
            $stmt = $conexion->prepare("CALL calcular_total_horas_semana(?, ?)");
            $stmt->bindParam(1, $fila["id_empleado"], PDO::PARAM_INT);
            $stmt->bindParam(2, $fila["fecha"], PDO::PARAM_STR);
            $stmt->execute();
            $result_semanal = $stmt->fetch();
            echo "<td>" . $result_semanal["total_horas_semana"] . "</td>";
            echo "</tr>";
            $total_semanal += $result_semanal["total_horas_semana"];
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Total semanal</th>
            <th></th>
            <th><?php echo $total_semanal; ?></th>
        </tr>
    </tfoot>
</table>



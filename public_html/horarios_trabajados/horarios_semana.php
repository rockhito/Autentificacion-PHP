<table>
<thead>
<tr>
<th>Día</th>
<th>Horario</th>
<th>Total diario</th>
</tr>
</thead>
<tbody>
<?php
$conexion = connectionDB();
$fecha_actual = date("Y-m-d");
$fecha_semana_pasada = date("Y-m-d", strtotime("-1 week"));
$query = "SELECT * FROM horarios_trabajados WHERE fecha BETWEEN '$fecha_semana_pasada' AND '$fecha_actual'";
$resultado = $conexion->query($query);
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
echo "<tr>";
echo "<td>" . $fila["dia"] . "</td>";
echo "<td>" . $fila["horario"] . "</td>";
echo "<td>" . $fila["total_diario"] . "</td>";
echo "</tr>";
}
?>
</tbody>
<tfoot>
<tr>
<th>Total semanal</th>
<th></th>
<th>
<?php
$total_diario = 0;
$total_semanal = 0;
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
$total_diario += $fila["total_diario"];
$total_semanal += $fila["total_diario"];
}
echo $total_semanal;
?>
</th>
</tr>
</tfoot>
</table>



<header>
    <button type="button" onclick="location.href='registrar_horarios.php'">Inicio</button>
    <button type="button" onclick="location.href='../register.php'">Cerrar Sesión</button>
    <button type="button" onclick="history.go(-1)">Volver</button>
    <script>
        function calcularTotalHoras() {
            // código para calcular total de horas
        }
        var boton = document.getElementById("boton_registrar_horarios");
        if (boton) {
            boton.addEventListener("click", function(event) {
                event.preventDefault();
                calcularTotalHoras();
            });
        }
    </script>
</header>

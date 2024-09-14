
function validarFormulario() {
    var fecha = document.getElementById("fecha").value;
    var horaEntrada = document.getElementById("hora_entrada").value;
    var horaSalida = document.getElementById("hora_salida").value;
    var totalHoras = document.getElementById("total_horas_dia").value;

    if (fecha == "" || horaEntrada == "" || horaSalida == "" || totalHoras == "") {
        alert("Por favor, complete todos los campos");
        return false;
    }

    // Validar formato de fecha y hora
    var fechaRegex = /^\d{4}-\d{2}-\d{2}$/;
    var horaRegex = /^\d{2}:\d{2}$/;

    if (!fechaRegex.test(fecha) || !horaRegex.test(horaEntrada) || !horaRegex.test(horaSalida)) {
        alert("Formato de fecha o hora inválido");
        return false;
    }

    return true;
}

document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formulario");
    if (formulario !== null) {
        formulario.addEventListener("submit", function(event) {
            if (!validarFormulario()) {
                event.preventDefault();
            }
        });
    } else {
        console.log("El formulario no existe");
    }
});

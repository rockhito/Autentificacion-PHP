function validarFormulario() {
    var fecha = document.getElementById("fecha").value.trim();
    var horaEntrada = document.getElementById("hora_entrada").value.trim();
    var horaSalida = document.getElementById("hora_salida").value.trim();
    var totalHoras = document.getElementById("total_horas_dia").value.trim();
  
    // Validar que todos los campos estén llenos
    if (fecha === "" || horaEntrada === "" || horaSalida === "" || totalHoras === "") {
      alert("Por favor, complete todos los campos");
      return false;
    }
  
    // Validar formato de fecha y hora
    var fechaRegex = /^\d{4}-\d{2}-\d{2}$/;
    var horaRegex = /^\d{2}:\d{2}$/;
  
    if (!fechaRegex.test(fecha)) {
      alert("Formato de fecha inválido. Debe ser AAAA-MM-DD");
      return false;
    }
  
    if (!horaRegex.test(horaEntrada) || !horaRegex.test(horaSalida)) {
      alert("Formato de hora inválido. Debe ser HH:MM");
      return false;
    }
  
    // Validar que la hora de salida sea mayor que la hora de entrada
    var horaEntradaParts = horaEntrada.split(":");
    var horaSalidaParts = horaSalida.split(":");
    var horaEntradaMinutos = parseInt(horaEntradaParts[0]) * 60 + parseInt(horaEntradaParts[1]);
    var horaSalidaMinutos = parseInt(horaSalidaParts[0]) * 60 + parseInt(horaSalidaParts[1]);
  
    if (horaSalidaMinutos <= horaEntradaMinutos) {
      alert("La hora de salida debe ser mayor que la hora de entrada");
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
  
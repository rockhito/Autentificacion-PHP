<?php 
// Incluir archivos necesarios 
include 'connectionDB.php'; 
include 'header.php'; 

// Mostrar formulario 
include 'register_horarios_form.php'; 

// Procesar formulario y lógica de negocio 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    include 'register_horarios_logic.php'; 
} 

// Incluir pie de página 
include 'footer.php'; 
?> 

<script src="/public_html/JS/validarFormulario.js"></script>


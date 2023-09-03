<?php
    require_once('./inc/functions.php');


    $result = auth($_POST['email'],$_POST['password']);

    if($result){
        echo 'Autentificación ok';
    } else {
        echo 'Error en el email o contraseña';
    }

?>
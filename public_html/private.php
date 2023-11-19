<?php
    require_once('./inc/functions.php');

    if(isset($_POST['email']) && isset($_POST['password'])){
        $resultAuth = auth_user($_POST['email'], $_POST['password']);
        if(!$resultAuth){
            header('Location: error.php');
        }
    } else {
            header('Location: error.php');
    }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./res/css/styles.css"/>
    <title>Zona privada de la Autentificacion con PHP</title>
</head>
<body>
    <main>
        <img src="./res/img/Imagenes.png" width="200px" height="200px">
        <hr>
        <h2 class="white">Zona privada</h2>
        <hr>
        <section class="white">
            <p>Autentificacion con éxito</p>
        </section>
    </main>
</body>
</html>
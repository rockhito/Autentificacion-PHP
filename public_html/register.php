<?php
    require_once('./inc/functions.php');

    if(isset($_POST['email']) && isset($_POST['password'])){
        create_user($_POST['email'],$_POST['password']);
        header('Location: index.php');
    }

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./res/css/styles.css"/>
    <title>Autentificacion con PHP</title>
</head>
<body>
    <main>
        <img src="./res/img/garaje-logo.jpg" width="200px" height="200px">
        <hr>
        <form action="" method="POST" id="login-form">
            <div class="input-form">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Escribe tu email"/>
            </div>
            <div class="input-form">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Introduce tu contraseña"/>
            </div>

            <button type="submit" form="login-form" value="Submit">Registrar</button>
            <a href="index.php" class="go-back-button" >Volver</a>
        </form>
    </main>
</body>
</html>
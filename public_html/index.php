<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./res/css/styles.css"/>
    <title>Autenticacion con PHP</title>
</head>
<body>
    <main>
        <img src="./res/img/Imagenes.png" width="200px" height="200px">
        <hr>
        <form action="private.php" method="POST" id="login-form">
            <div class="input-form">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Escribe tu email"/>
            </div>
            <div class="input-form">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Introduce tu contraseña"/>
            </div>

            <button type="submit" form="login-form" value="Submit">Ingresar</button>
            <p>
                ¿No tienes usuario? Puedes crear una cuenta <a href="register.php" class="white">aquí</a>
            </p>
        </form>
    </main>
    
</body>
</html>
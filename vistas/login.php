<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
    <?php
    echo '<h2>Login de usuarios</h2>';
    ?>

    <form method="post" action="../servicios/login-action.php">
        <input type="email" name="correo">
        <input type="password" name="contrasena">
        <input type="submit" value="Acceder">
    </form>

    </body>
</html>

<?php
session_start();
echo '<h2>Zona privada</h2>';

if (!isset($_SESSION['usuario'])) {
    header('Location:login.php');
}

?>
<h2>Datos privados ok</h2>

<!-- Formulario para ingresar ciudades -->
<form action="../servicios/ciudades-action.php" method="post">
    <label for="ciudades">Ingrese ciudades (separadas por comas):</label>
    <input type="text" name="ciudades" id="ciudades">
    <input type="submit" value="Guardar">
</form>

<?php
session_start();
echo '<h2>Zona privada</h2>';

if (!isset($_SESSION['usuario'])) {
    header('Location:login.php');
}

// Capturar IP y fecha
$ip = $_SERVER['REMOTE_ADDR'];
$fecha = date('Y-m-d H:i:s');

// Conexión PDO
$servername = "localhost";
$username = "root";
$dbname = "sesiones";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO sesiones.info (fecha, ip, ciudades) VALUES (:fecha, INET_ATON(:ip), '')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':ip', $ip);
    $stmt->execute();

    // Cerrar conexión
    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<h2>Datos privados ok</h2>

<!-- Formulario para ingresar ciudades -->
<form action="guardar_ciudades.php" method="post">
    <label for="ciudades">Ingrese ciudades (separadas por comas):</label>
    <input type="text" name="ciudades" id="ciudades">
    <input type="submit" value="Guardar">
</form>

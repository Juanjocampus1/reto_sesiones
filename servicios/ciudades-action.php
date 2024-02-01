<?php
session_start();

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
    $sql = "INSERT INTO sesiones.info (fecha, ip, ciudades) VALUES (:fecha, INET_ATON(:ip), :ciudades)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':ip', $ip);

    // Verificar si el formulario de ciudades ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ciudades'])) {
        $ciudades = $_POST['ciudades'];
        $stmt->bindParam(':ciudades', $ciudades);
    } else {
        // Si el formulario no ha sido enviado o ciudades no está seteado, asignar un valor por defecto
        $ciudades = '';
        $stmt->bindParam(':ciudades', $ciudades);
    }

    $stmt->execute();

    // Cerrar conexión
    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

header('Location: pagina_privada.php');
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
</html>

<?php
$correo = $_POST['correo'];
$contraseña = $_POST['contrasena'];

$opciones = [
    'cost' => 12,
];

$hash = password_hash($contraseña, PASSWORD_BCRYPT, $opciones);

$conexion = new PDO('mysql:host=localhost;dbname=sesiones', 'root', '');

// Comprobar si el correo ya está registrado
$sql_check = "SELECT sesiones.usuario.usuario_id FROM sesiones.usuario WHERE correo = :correo";
$stmt_check = $conexion->prepare($sql_check);
$stmt_check->bindParam(':correo', $correo);
$stmt_check->execute();

if ($stmt_check->fetchColumn()) {
    // El correo ya está registrado
    header('location:../vistas/registro.php');
    $mensaje = "El correo ya está registrado. Por favor, elige otro correo.";
} else {
    // El correo no está registrado, proceder con la inserción
    $sql_insert = "INSERT INTO sesiones.usuario (correo, contrasena) VALUES (:correo, :contrasena)";
    $stmt_insert = $conexion->prepare($sql_insert);
    $stmt_insert->bindParam(':correo', $correo);
    $stmt_insert->bindParam(':contrasena', $hash);

    if ($stmt_insert->execute()) {
        echo '<a href="../vistas/login.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                ACCEDER
            </a>';
    } else {
        echo "Error al crear el registro: " . $stmt_insert->errorInfo()[2];
    }
}
?>
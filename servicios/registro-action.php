<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
</html>

<?php
$correo=$_POST['correo'];
$contraseña=$_POST['contraseña'];

$opciones= [
    'cost' => 12,
];

$hash = password_hash($contraseña, PASSWORD_BCRYPT, $opciones);

$conexion=new PDO('mysql:host=localhost;dbname=sesiones', 'root','');
//echo var_dump($conexion);

$sql = "INSERT INTO sesiones.usuario (correo, contrasena) VALUES (:correo, :contrasena)";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':contrasena', $hash);

if ($stmt->execute()) {
    echo '<a href="../vistas/login.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            ACCEDER
        </a>';
} else {
    echo "Error al crear el registro: " . $stmt->errorInfo()[2];
}
?>
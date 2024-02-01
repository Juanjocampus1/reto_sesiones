<?php
$correo=$_POST['correo'];
$contraseña=$_POST['contraseña'];

$opciones= [
    'cost' => 12,
];

$hash = password_hash($contraseña, PASSWORD_BCRYPT, $opciones);

$conexion=new PDO('mysql:host=localhost;dbname=practica', 'root','');
//echo var_dump($conexion);

$sql = "INSERT INTO practica.usuario (correo, contrasena) VALUES (:correo, :contrasena)";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':contrasena', $hash);

if ($stmt->execute()) {
    echo "Registro creado exitosamente";
} else {
    echo "Error al crear el registro: " . $stmt->errorInfo()[2];
}
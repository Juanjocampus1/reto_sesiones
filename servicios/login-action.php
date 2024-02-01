<?php
$correo=$_POST['correo'];
$contraseña=$_POST['contrasena'];

$conexion=new PDO('mysql:host=localhost;dbname=sesiones','root','');
$sql = "SELECT correo, contrasena FROM sesiones.usuario WHERE correo = :correo";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':correo',$correo);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
// Verificar si la contraseña coincide utilizando password_verify
    if (password_verify($contraseña, $result['contrasena'])) {
        session_start();
        $_SESSION['usuario'] = $correo;
        header('Location:../vistas/privado.php');
    } else {
        echo '<p>Usuario no válido</p>';
        echo '<a href="../vistas/registro.php">Alta de usuarios</a>';
    }
}
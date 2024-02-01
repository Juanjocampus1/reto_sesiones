<?php
$correo=$_POST['correo'];
$contraseña=$_POST['contrasena'];

$conexion = new PDO('mysql:host=localhost;dbname=practica','root','');
$sql = "SELECT correo, contrasena FROM practica.usuario WHERE correo = :correo";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':correo',$correo);
$stmt->execute();

echo $correo;

$result = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($result);

if ($result) {
    echo'hola';
    echo $contraseña;
    echo $result;
    if ($result && password_verify($contraseña, $result['contrasena']))  {
        session_start();
        $_SESSION['usuario'] = $correo;
        header('Location:../vistas/privado.php');
    } else {
        echo '<p>Usuario no válido</p>';
        echo '<a href="../vistas/registro.php">Alta de usuarios</a>';
    }
}
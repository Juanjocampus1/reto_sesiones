<html>

<body>
<?php
echo '<h2>Zona privada</h2>';
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location:login.php');
}
?>
<h2>Datos privados ok</h2>
<?php
$_SESSION['producto']="camisa";
$_SESSION['destino']="praga";
?>
</body>
</html>


<?php
require('conexionDb.php');
mysqli_set_charset($conexion, "utf8");
$departamento=$_POST['depa'];
$idpro=$_POST['provincia'];
$sql= "INSERT INTO `departamento`(`departamento`, `idpro`) VALUES ('$departamento','$idpro')";
echo mysqli_query($conexion, $sql);
mysqli_close($conexion);
?>

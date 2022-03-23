<?php
function carrera(){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT `idcar`, `carrera` FROM `carrera` WHERE 1";
    $result= mysqli_query($conexion, $query);
    $json= array();
    while($row=mysqli_fetch_array($result)) {
        $json[]=array(
            'idcar' => $row['idcar'],
            'carrera' => $row['carrera']
        );        
   }
   $jsonstring= json_encode($json);
   echo $jsonstring;
   mysqli_close($conexion);
}
carrera();
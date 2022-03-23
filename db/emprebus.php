<?php
function empresa(){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT `idempresa`, `empresa` FROM `empresas` WHERE 1";
    $result= mysqli_query($conexion, $query);
    $json= array();
    while($row=mysqli_fetch_array($result)) {
        $json[]=array(
            'idempresa' => $row['idempresa'],
            'empresa' => $row['empresa']
        );        
   }
   $jsonstring= json_encode($json);
   echo $jsonstring;
   mysqli_close($conexion);
}
empresa();
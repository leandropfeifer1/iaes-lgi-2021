<?php
function provincia(){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT `idpro`, `provincia` FROM `provincia` WHERE 1";
    $result= mysqli_query($conexion, $query);
    $json= array();
    while($row=mysqli_fetch_array($result)) {
        $json[]=array(
            'idpro' => $row['idpro'],
            'provincia' => $row['provincia']
        );        
   }
   $jsonstring= json_encode($json);
   echo $jsonstring;
   mysqli_close($conexion);
}
provincia();
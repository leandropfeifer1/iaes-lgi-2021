<?php
function sucursal(){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT * FROM `sucursales` WHERE 1";
    $result= mysqli_query($conexion, $query);
    $json= array();
    while($row=mysqli_fetch_array($result)) {
        $json[]=array(
            'idsucursal' => $row['idsucursal'],
            'direccion' => $row['direccion']
        );        
   }
   $jsonstring= json_encode($json);
   echo $jsonstring;
   mysqli_close($conexion);
}
function obtenersucursal($sendsuc){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT * FROM `sucursales` WHERE `empresa`= $sendsuc";
    $result= mysqli_query($conexion, $query);
    $json= array();
    while($row=mysqli_fetch_array($result)) {
        $json[]=array(
            'idsucursal' => $row['idsucursal'],
            'direccion' => $row['direccion']
        );        
   }
   $jsonstring= json_encode($json);

   echo $jsonstring;
   mysqli_close($conexion);
}
if(isset($_POST['cemp'])){
    $sendsuc= $_POST['cemp'];
    obtenersucursal($sendsuc);
}else{
    sucursal();
}
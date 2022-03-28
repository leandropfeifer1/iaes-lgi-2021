<?php 
function localidad(){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT `idloc`, `localidad` FROM `localidad`";
    $result= mysqli_query($conexion, $query);
    $json= array();
    while($row=mysqli_fetch_array($result)) {
        $json[]=array(
            'idloc' => $row['idloc'],
            'localidad' => $row['localidad']
        );        
   }
   $jsonstring= json_encode($json);
   echo $jsonstring;
   mysqli_close($conexion);
}
function obtenerloc($senddep){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT `idloc`, `localidad` FROM `localidad` WHERE `idep`= $senddep";
    $result= mysqli_query($conexion, $query);
    $json= array();
    while($row=mysqli_fetch_array($result)) {
        $json[]=array(
            'idloc' => $row['idloc'],
            'localidad' => $row['localidad']
        );        
   }
   $jsonstring= json_encode($json);
   echo $jsonstring;
   mysqli_close($conexion);
}
if(isset($_POST['cdep'])){
    $senddep= $_POST['cdep'];
    obtenerloc($senddep);
}else{
    localidad();
}


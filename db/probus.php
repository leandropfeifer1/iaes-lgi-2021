<?php
function provincia(){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT * FROM `provincia` WHERE 1";
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
function obprovincia($sendpa){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT `idpro`, `provincia` FROM `provincia` WHERE `idpais`= $sendpa";
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
if(isset($_POST['cpais'])){
    $sendpa= $_POST['cpais'];
    obprovincia($sendpa);
}else{
    provincia();
}
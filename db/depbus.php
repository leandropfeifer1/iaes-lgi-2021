<?php
function deparmento(){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT * FROM `departamento` WHERE 1";
    $result= mysqli_query($conexion, $query);
    $json= array();
    while($row=mysqli_fetch_array($result)) {
        $json[]=array(
            'idep' => $row['idep'],
            'departamento' => $row['departamento']
        );        
   }
   $jsonstring= json_encode($json);
   echo $jsonstring;
   mysqli_close($conexion);
}
function obtenerdeparmento($sendpro){
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $query="SELECT `idep`, `departamento` FROM `departamento` WHERE `idpro`= $sendpro";
    $result= mysqli_query($conexion, $query);
    $json= array();
    while($row=mysqli_fetch_array($result)) {
        $json[]=array(
            'idep' => $row['idep'],
            'departamento' => $row['departamento']
        );        
   }
   $jsonstring= json_encode($json);

   echo $jsonstring;
   mysqli_close($conexion);
}
if(isset($_POST['cpro'])){
    $sendpro= $_POST['cpro'];
    obtenerdeparmento($sendpro);
}else{
    deparmento();
}
<?php 
    
    function idiomasbd($idloc){
        require('conexionDb.php');
        $datos = mysqli_query($conexion, "SELECT idi FROM idioxuser WHERE iduser='$idloc'");
        $x=0;
        $result = array();
        while ($fila = mysqli_fetch_row($datos)) {
            $result[$x]=$fila[0];
            $x++;            
        }
        return $result;
    }
    function comparar($idioma, $iduser){
        $result = false;
        $idiomas = idiomasbd($iduser);
        for($i=0;$i<COUNT($idiomas);$i++){
            if($idioma == $idiomas[$i]){
                $result = true;
            }
        }
        return $result;
    }
?>
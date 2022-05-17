<?php
require('conexionDb.php');

function generate_string($strength = 16)
{
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}
if(isset($_POST['logo'])){
    $logo = $_POST['logo'];
    $array = explode('.', $logo);
    $ext = end($array);
    $logoNombres = mysqli_query($conexion, "SELECT logo FROM empresas WHERE logo='$logo'");
    if (mysqli_num_rows($logoNombres) > 0) {
        $x = 0;
        while ($x == 0) {
            $nombreRandom = generate_string();
            $nombreRandom = $nombreRandom . "." . $ext;
            $logoNombres = mysqli_query($conexion, "SELECT logo FROM empresas WHERE logo='$nombreRandom'");
            if (!mysqli_num_rows($logoNombres) > 0) {
                //echo "el nombreRandom no existe en bd";            
                $logo = $nombreRandom; 
                //echo "bbbbbb---" . $logo;
                $x = 1;
            } 
        }
    }    
    print json_encode($logo); // returned data as json
}

if(isset($_POST['foto'])){
    $foto = $_POST['foto'];
    //echo $foto;
    $array = explode('.', $foto);
    $ext = end($array);
    $fotoNombres = mysqli_query($conexion, "SELECT foto FROM usuario WHERE foto='$foto'");
    if (mysqli_num_rows($fotoNombres) > 0) {
       // echo "eeeeeee";
        $x = 0;
        while ($x == 0) {
            $nombreRandom = generate_string();
            $nombreRandom = $nombreRandom . "." . $ext;
            $fotoNombres = mysqli_query($conexion, "SELECT foto FROM usuario WHERE foto='$nombreRandom'");
            if (!mysqli_num_rows($fotoNombres) > 0) {
                //echo "el nombreRandom no existe en bd";            
                $foto = $nombreRandom; 
                //echo "bbbbbb---" . $foto;
                $x = 1;
            } 
        }
    }    
    //echo "aaaaaaaaaa";
    print json_encode($foto); // returned data as json
}


<?php
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $sucursal=$_POST['sucursal'];
    $emin=$_POST['edadmin'];
    $emax=$_POST['edadmax'];
    $carr=$_POST['carrera'];
    $gen=$_POST['genero'];
    $loc=$_POST['localidad'];
    $dep=$_POST['departamento'];
    $pro=$_POST['provincia'];
    $dis=$_POST['disponibilidad'];
    $query="INSERT INTO `buscaempleado`( `idsucursal`, `edadmin`, `edadmax`, `carrera`, `genero`, `localidad`, `departamento`, `provincia`, `disponibilidad`) 
           VALUES ($sucursal,$emin,$emax,$carr,$gen,$loc,$dep,$pro,$dis)";
    echo $result= mysqli_query($conexion, $query);
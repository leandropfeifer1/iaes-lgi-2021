<?php
    require('conexionDb.php'); 
    mysqli_set_charset($conexion, "utf8");
    $sucursal=$_POST['sucursal'];
    $emin=$_POST['edadmin'];
    $emax=$_POST['edadmax'];
    $carr=$_POST['carrera'];
    $gen=$_POST['genero'];
    $suel=$_POST['sueldo'];
    $dis=$_POST['disponibilidad'];
    $req=$_POST['requisitos'];
    $query="INSERT INTO `buscaempleado`(`idsucursal`, `edadmin`, `edadmax`, `carrera`, `genero`, `sueldo`, `requisitos`, `disponibilidad`) VALUES ($sucursal,$emin,$emax,$carr,$gen,$suel,'$req',$dis)";
    echo mysqli_query($conexion, $query);
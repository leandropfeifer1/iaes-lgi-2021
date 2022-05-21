<?php

session_start();
require('./conexionDb.php');
mysqli_set_charset($conexion, "utf8");
// require('./db/verificarAdminSecretaria.php');
$data;
if (isset($_SESSION['id_user'])) {
    $consulta = "SELECT * FROM `buscaempleado`";
    $b = 0;
    if (isset($_POST['empresa']) && $_POST['empresa'] != 0) {
        $e = $_POST['empresa'];
        $consulta .= " WHERE idsucursal IN (SELECT `idsucursal` FROM `sucursales` WHERE `empresa`=$e)";
        $b = 1;
    }
    if (isset($_POST['sucursal']) && $_POST['sucursal'] != 0) {
        if ($b == 0) {
            $s = $_POST['sucursal'];
            $consulta .= " WHERE idsucursal IN (SELECT `idsucursal` FROM `sucursales` WHERE `idsucursal`=$s)";

            $b = 1;
        } else {
            $s = $_POST['sucursal'];
            $consulta .= " AND idsucursal IN (SELECT `idsucursal` FROM `sucursales` WHERE `idsucursal`=$s)";
        }
    }
    if (isset($_POST['edad']) && $_POST['edad'] != 0) {
        $edad = $_POST['edad'];
        if ($b == 0) {
            $consulta .= " WHERE idbusqueda IN (SELECT idbusqueda FROM `buscaempleado` WHERE $edad BETWEEN `edadmin` AND `edadmax`)";
            $b = 1;
        } else {
            $s = $_POST['sucursal'];
            $consulta .= " AND idbusqueda IN (SELECT idbusqueda FROM `buscaempleado` WHERE $edad BETWEEN `edadmin` AND `edadmax`)";
        }
    }

    if (isset($_POST['carrera']) && $_POST['carrera'] != 0) {
        if ($b == 0) {
            $c = $_POST['carrera'];
            $consulta .= " WHERE carrera IN (SELECT `idcar` FROM `carrera` WHERE `idcar`=$c)";
            $b = 1;
        } else {
            $c = $_POST['carrera'];
            $consulta .= " AND carrera IN (SELECT `idcar` FROM `carrera` WHERE `idcar`=$c)";
        }
    }
    if (isset($_POST['genero']) && $_POST['genero'] != 0) {
        if ($b == 0) {
            $g = $_POST['genero'];
            $consulta .= " WHERE genero IN (SELECT `genero` FROM `buscaempleado` WHERE `genero`=$g)";
            $b = 1;
        } else {
            $g = $_POST['genero'];
            $consulta .= " AND genero IN (SELECT `genero` FROM `buscaempleado` WHERE `genero`=$g)";
        }
    }
    if (isset($_POST['sueldo']) && $_POST['sueldo'] != 0) {
        if ($b == 0) {
            $sueldo = $_POST['sueldo'];
            $consulta .= " WHERE sueldo =$sueldo";
            $b = 1;
        } else {
            $l = $_POST['sueldo'];
            $consulta .= " AND localidad IN (SELECT `localidad` FROM `buscaempleado` WHERE `localidad`=$l";
        }
    }
    if (isset($_POST['disponibilidad']) && $_POST['disponibilidad'] != 0) {
        if ($b == 0) {
            $d = $_POST['disponibilidad'];
            $consulta .= " WHERE disponibilidad IN (SELECT `disponibilidad` FROM `buscaempleado` WHERE `disponibilidad`=$d)";
            $b = 1;
        } else {
            $d = $_POST['disponibilidad'];
            $consulta .= " AND disponibilidad IN (SELECT `disponibilidad` FROM `buscaempleado` WHERE `disponibilidad`=$d)";
        }
    }
    $result = mysqli_query($conexion, $consulta);
    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $suc = $row['idsucursal'];
        $carre = $row['carrera'];
        $sql = "SELECT `empresa` FROM `empresas` WHERE `idempresa` =(SELECT `empresa` FROM `sucursales` WHERE idsucursal=$suc)";
        $res = mysqli_query($conexion, $sql);
        $emp = mysqli_fetch_array($res);
        $sql5 = "SELECT `logo` FROM `empresas` WHERE `idempresa` =(SELECT `empresa` FROM `sucursales` WHERE idsucursal=$suc)";
        $res5 = mysqli_query($conexion, $sql5);
        $log = mysqli_fetch_array($res5);
        $sql1 = "SELECT `direccion` FROM `sucursales` WHERE `idsucursal` =$suc";
        $res1 = mysqli_query($conexion, $sql1);
        $suc = mysqli_fetch_array($res1);
        $sql4 = "SELECT `carrera` FROM `carrera` WHERE `idcar` =$carre";
        $res4 = mysqli_query($conexion, $sql4);
        $car = mysqli_fetch_array($res4);
        $json[] = array(
            'idbusqueda' => $row['idbusqueda'],
            'empresa' => $emp[0],
            'idsucursal' => $suc[0],
            'edadmin' => $row['edadmin'],
            'edadmax' => $row['edadmax'],
            'carrera' => $car[0],
            'genero' => $row['genero'],
            'sueldo' => $row['sueldo'],
            'disponibilidad' => $row['disponibilidad'],
            'requisitos'=>$row['requisitos'],
            'logo' => $log['logo']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

    mysqli_close($conexion);
} 


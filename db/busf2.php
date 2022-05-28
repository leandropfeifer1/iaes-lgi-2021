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
    if (isset($_POST['edadmin']) && $_POST['edadmin'] != 0) {
        if (isset($_POST['edadmax']) && $_POST['edadmax'] != 0) {
            if ($b == 0) {
                $edadmin = $_POST['edadmin'];
                $edadmax = $_POST['edadmax'];
                $consulta .= "WHERE `edadmin`>= $edadmin and `edadmax`<=$edadmax";
                $b = 1;
            } else {
                $edadmin = $_POST['edadmin'];
                $edadmax = $_POST['edadmax'];
                $consulta .= " AND WHERE `edadmin`>= $edadmin and `edadmax`<=$edadmax";
            }
        } else {
            if ($b == 0) {
                $edadmin = $_POST['edadmin'];
                $consulta .= "WHERE edadmin BETWEEN $edadmin and 9999999999";
                $b = 1;
            } else {
                $edadmin = $_POST['edadmin'];
                $consulta .= "AND WHERE edadmin BETWEEN $edadmin and 9999999999";
            }
        }
    } else {
        if (isset($_POST['edadmax']) && $_POST['edadmax'] != 0) {
            if ($b == 0) {
                $edadmax = $_POST['edadmax'];
                $consulta .= "WHERE edadmax BETWEEN 0 and $edadmax";
                $b = 1;
            } else {
                $edadmax = $_POST['edadmax'];
                $consulta .= "AND WHERE edadmax BETWEEN 0 and $edadmax";
            }
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
    if (isset($_POST['sueldomin']) && $_POST['sueldomin'] != 0) {
        if (isset($_POST['sueldomax']) && $_POST['sueldomax'] != 0) {
            if ($b == 0) {
                $sueldomin = $_POST['sueldomin'];
                $sueldomax = $_POST['sueldomax'];
                $consulta .= " WHERE sueldo BETWEEN $sueldomin and $sueldomax";
                $b = 1;
            } else {
                $sueldomin = $_POST['sueldomin'];
                $sueldomax = $_POST['sueldomax'];
                $consulta .= " AND WHERE sueldo BETWEEN $sueldomin and $sueldomax";
            }
        } else {
            if ($b == 0) {
                $sueldo = $_POST['sueldomin'];
                $consulta .= "WHERE sueldo BETWEEN $sueldo and 9999999999";
                $b = 1;
            } else {
                $sueldo = $_POST['sueldomin'];
                $consulta .= "AND WHERE sueldo BETWEEN $sueldo and 9999999999";
            }
        }
    } else {
        if (isset($_POST['sueldomax']) && $_POST['sueldomax'] != 0) {
            if ($b == 0) {
                $sueldo = $_POST['sueldomax'];
                $consulta .= "WHERE sueldo BETWEEN 0 and $sueldo";
                $b = 1;
            } else {
                $sueldo = $_POST['sueldomax'];
                $consulta .= "AND WHERE sueldo BETWEEN 0 and $sueldo";
            }
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
            'requisitos' => $row['requisitos'],
            'logo' => $log['logo']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
    mysqli_close($conexion);
} 


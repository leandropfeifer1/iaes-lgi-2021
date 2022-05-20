<?php

//$idUser = $_SESSION['id_user'];
//echo "--" . $idUser . "--";
function datosUsuario($iduser)
{
    include 'conexionDb.php';
    $query = "SELECT * FROM usuario WHERE iduser = '$iduser'";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conexion);
    return $row;
}

function modalidad($iduser)
{
    include 'conexionDb.php';
    $query = "SELECT modalidades.descripcion FROM usuario, modalidades WHERE usuario.iduser = '$iduser' AND usuario.modalidad = idmodalidad";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_array($result);
    $mod = $row[0];
    mysqli_close($conexion);
    return $mod;
}

function localidad($iduser)
{
    include 'conexionDb.php';
    $query = "SELECT localidad.localidad AS locnom FROM usuario, localidad WHERE usuario.iduser = '$iduser' AND localidad.idloc = usuario.localidad";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        $locnom = $row['locnom'];
    }
    mysqli_close($conexion);
    return $locnom;
}

function departamento($iduser)
{
    include 'conexionDb.php';
    $query = "SELECT departamento.departamento AS depnom FROM usuario, departamento WHERE usuario.iduser='$iduser' AND departamento.idep = usuario.departamento";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        $depnom = $row['depnom'];
    }
    mysqli_close($conexion);
    return $depnom;
}

function provincia($iduser)
{
    include 'conexionDb.php';
    $query = "SELECT provincia.provincia AS provnom FROM usuario, provincia WHERE usuario.iduser='$iduser' AND provincia.idpro = usuario.provincia";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        $provnom = $row['provnom'];
    }
    mysqli_close($conexion);
    return $provnom;
}
function pais($iduser)
{
    include 'conexionDb.php';
    $query = "SELECT pais.pais AS paisnom FROM usuario, pais WHERE usuario.iduser='$iduser' AND pais.idpais = usuario.idpais";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        $paisnom = $row['paisnom'];
    }
    mysqli_close($conexion);
    return $paisnom;
}

function carrera($iduser)
{
    include 'conexionDb.php';
    $id = mysqli_query($conexion, "SELECT idloc FROM usuario WHERE iduser='$iduser'");
    $id = mysqli_fetch_assoc($id);
    $id = $id['idloc'];
    $query = "SELECT carrera.carrera FROM carrera, carxuser WHERE carxuser.iduser='$id' AND carxuser.idcar=carrera.idcar";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        $carrera = $row['carrera'];
    }
    mysqli_close($conexion);
    return $carrera;
}

function idiomasbd($iduser)
{
    require('conexionDb.php');
    $idloc = mysqli_query($conexion, "SELECT idloc FROM usuario WHERE usuario.iduser='$iduser'");
    $idloc = mysqli_fetch_row($idloc);

    $datos = mysqli_query($conexion, "SELECT idiomas.idioma FROM idioxuser, idiomas WHERE idioxuser.iduser='$idloc[0]' AND idiomas.idi = idioxuser.idi");
    $x = 0;
    $result = array();
    while ($fila = mysqli_fetch_row($datos)) {
        $result[$x] = $fila[0];
        $x++;
    }
    mysqli_close($conexion);
    return $result;
}

function experiencia($iduser)
{
    require('conexionDb.php');

    $idloc = mysqli_query($conexion, "SELECT idloc FROM usuario WHERE usuario.iduser='$iduser'");
    $idloc = mysqli_fetch_row($idloc);

    $query = "SELECT * FROM experiencia WHERE iduser='$idloc[0]'";
    $result = mysqli_query($conexion, $query);

    mysqli_close($conexion);
    return $result;
}
function foto($iduser)
{
    require('conexionDb.php');
    $idloc = mysqli_query($conexion, "SELECT idloc FROM usuario WHERE usuario.iduser='$iduser'");
    $idloc = mysqli_fetch_row($idloc);

    $query = "SELECT foto FROM usuario WHERE idloc='$idloc[0]'";
    $result = mysqli_query($conexion, $query);
    if (!$result) {
        die('Query failed!' . mysqli_error($conexion));
    }
    $fila = mysqli_fetch_row($result);
    if (!empty($fila[0])) {
        $foto = "../db/images/" . $fila[0];
    } else {
        $foto = "../db/images/default.png";
    }
    mysqli_close($conexion);
    return $foto;
}

function pdf($iduser)
{
    require('conexionDb.php');
    $idloc = mysqli_query($conexion, "SELECT idloc FROM usuario WHERE usuario.iduser='$iduser'");
    $idloc = mysqli_fetch_row($idloc);

    $query = "SELECT pdf FROM usuario WHERE idloc='$idloc[0]'";
    $result = mysqli_query($conexion, $query);
    if (!$result) {
        die('Query failed!' . mysqli_error($conexion));
    }
    $fila = mysqli_fetch_row($result);
    if (!empty($fila[0])) {
        $pdf = $fila[0];
    } else {
        $pdf = false;
    }
    mysqli_close($conexion);
    return $pdf;
}

if (isset($_POST['pdfExiste'])) {

    //echo $_POST['pdfExiste'];
   // echo $_POST['iduser'];
    if ($_POST['pdfExiste'] == true) {
        require('conexionDb.php');
        $iduser = $_POST['iduser'];
        $idloc = mysqli_query($conexion, "SELECT idloc FROM usuario WHERE usuario.iduser='$iduser'");
        $idloc = mysqli_fetch_row($idloc);

        $query = "SELECT pdf FROM usuario WHERE idloc='$idloc[0]'";
        $result = mysqli_query($conexion, $query);
        if (!$result) {
            die('Query failed!' . mysqli_error($conexion));
        }

        $fila = mysqli_fetch_row($result);
       // echo "aasdasdasd" . $fila[0];

        if (mysqli_num_rows($result) == 0 || $fila[0] == "") {
            $res = false;
        } else {
            $res = true;
        }
        print json_encode($res);
        mysqli_close($conexion);
    }
}

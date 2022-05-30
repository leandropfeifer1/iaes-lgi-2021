<?php
session_start();
require('../db/conexionDb.php');
if (!isset($_SESSION['usuario'])) {
    header('location: ../db/logout.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bootstrap/css/vistaUsuario.min.css">
</head>

<style>
    mark {
        background-color: black;
        color: white;
    }

    .box-header {
        margin-top: 35px;
        color: rgba(36, 34, 34, 0.671);
    }

    .box-Principal {
        margin: 0px;
        padding: 0px;
        background-color: yellow;
        margin-bottom: 10px;
        box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.75);
        border-radius: 0 70px 0 70px;
    }

    #box-general {
        width: 80%;
        margin: 20px auto;
        background-color: whitesmoke;
        box-shadow: 0px 8px 25px 0px rgba(0, 0, 0, 0.75);
        border-radius: 0 70px 0 70px;
    }

    ul {
        list-style-type: circle;
    }

    a {
        color: black;
    }

    h5 {
        color: rgba(20, 161, 20, 0.87);
        border-bottom: solid 1px rgba(168, 161, 161, 0.651);
    }

    #recuperarPass {
        border: 1px solid black;
        border-radius: 3px;
        padding: 2px;
    }

    #recuperarPass:hover {
        text-decoration: none;
        background-color: black;
        color: white;
    }

    #cv {
        border: 1px solid black;
        border-radius: 3px;
        padding: 2px;
    }

    #cv:hover {
        text-decoration: none;
        background-color: black;
        color: white;
    }

    #eliminarUsuario {
        border: 1px solid black;
        border-radius: 3px;
        padding: 2px;
    }

    #eliminarUsuario:hover {
        text-decoration: none;
        background-color: black;
        color: white;
    }

    #salir {
        border: 1px solid black;
        border-radius: 3px;
        padding: 2px;
    }

    #salir:hover {
        text-decoration: none;
        background-color: black;
        color: white;
    }
</style>

<body>
    <?php
    include('../db/consultas.php');
    $iduser = $_GET["iduser"];

    $modalidad = modalidad($iduser);
    $usuario = datosUsuario($iduser);
    $localidad = localidad($iduser);
    $departamento = departamento($iduser);
    $pais = pais($iduser);
    $provincia = provincia($iduser);
    $idiomasbd = idiomasbd($iduser);
    $carrera = carrera($iduser);
    $foto = foto($iduser);
    $exp = experiencia($iduser);
    $pdf = pdf($iduser);
    $url = "../db/cv/" . $pdf;
    ?>

    <input type="hidden" id="pdf" value="<?php echo $pdf ?>">
    <input type="hidden" id="idUser" value="<?php echo $iduser ?>">

    <div class="container" id="descargarcv">
        <br>
        <a id="cv" title="Descargar Archivo" class="btn btn-info" href="<?php echo $url ?>" download="<?php echo $pdf ?>">Descargar Curriculum vitae</a><span id="error_cv" class="text-danger"></span>
        <button id="eliminarUsuario" class="btn btn-info">Eliminar usuario</button>
        <a target="_blank" href="./recuperarContrasena.php?id=<?php echo $iduser ?>" id="recuperarPass" class="btn btn-info">Cambiar Contraseña</a>
        <a id="salir" class="btn btn-danger" onclick="javascript: window.history.go(-1);">Cerrar</a>
    </div>

    <div class="container">
        <hr>
    </div>

    <div class="container" id="box-general">

        <!--BOX  -->
        <div class="container box-Principal">
            <div class="row">

                <!-- <div style="width: 240px; height:240px;" class="col col-md-3"> -->
                <!--
                <div style="width: 240px;height: 240px ;display: flex;">
                    <img style="object-fit:contain; background-color: rgba(255, 255, 255, 0)" class="img-thumbnail" src="<?php echo $foto ?>" alt="">
                </div>
                -->

                <div class="col col-md-3"">
                    <img width="240" height="240" src="<?php echo $foto ?>" alt="">
                </div>               

                <div class="col col-md-9">
                    <div class="box-header">
                        <div id="log_img" class="logo">
                            <a href="#" class="logo__link">
                                <img src="http://www.iaes.edu.ar/wp-content/uploads/2014/08/logo-top-1.png" alt="Logo del IAES" />
                            </a>
                        </div>
                        <font size=10><?php echo ucfirst($carrera); ?></font>
                    </div>
                </div>
            </div>
        </div>
        <!--BOX  -->


        <div class="container ">
            <div class="row">

                <div class="col col-md-12 ">

                    <h5><mark>Informacion personal:</mark></h5>

                    <ul>
                        <li> Nombre: <?php echo ucfirst($usuario['usuario']); ?></li>
                        <li> Apellido: <?php echo ucfirst($usuario['apellido']); ?></li>
                        <li> Numero de documento: <?php echo ucfirst($usuario['dni']); ?></li>
                        <li> Email: <?php echo $usuario['correo']; ?></li>
                        <li> Fecha de nacimiento: <?php echo $usuario['fechanacimiento']; ?></li>
                        <li> Genero: <?php echo $usuario['genero'] == 1 ? "Masculino" : "Femenino" ?></li>
                        <li> Estado civil: <?php echo $usuario['ecivil'] == 1 ? "Casado" : "Soltero" ?></li>
                        <li> Telefono: <?php echo $usuario['contacto']; ?></li>
                        <li> Domicilio: <?php echo ucfirst($usuario['domicilio']); ?></li>
                        <li> Localidad: <?php echo ucfirst($localidad); ?></li>
                        <li> Departamento: <?php echo ucfirst($departamento); ?></li>
                        <li> Pais: <?php echo ucfirst($pais); ?></li>
                        <li> Provincia: <?php echo ucfirst($provincia); ?></li>
                        <li> Licencia de conducir: <?php echo $usuario['licencia'] == 1 ? "Si" : "No" ?></li>
                        <li> Auto: <?php echo $usuario['auto'] == 1 ? "Si" : "No" ?></li>
                        <li> Discapacidad: <?php echo ucfirst($usuario['discapacidades']); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--BOX  -->
        <div class="container ">
            <div class="row">

                <div class="col col-md-12">
                    <h5><mark>Datos academicos</mark></h5>
                    <ul>
                        <li> Carrera: <?php echo ucfirst($carrera); ?></li>
                        <li> Cursos realizados: <?php echo ucfirst($usuario['cursos']); ?></li>

                    </ul>
                </div>
            </div>
        </div>
        <!--BOX  -->
        <div class="container ">
            <div class="row">

                <div class="col col-md-12">
                    <h5><mark>Conocimientos y habilidades</mark></h5>
                    <ul>
                        <li> Que programas domina/conoce: <?php echo ucfirst($usuario['progs']); ?></li>
                        <li> Habilidades: <?php echo ucfirst($usuario['habilidades']); ?></li>
                    </ul>
                </div>

            </div>
        </div>
        <!--BOX  -->
        <div class="container ">
            <div class="row">

                <div class="col col-md-12">
                    <h5><mark>Experiencia Laboral</mark></h5>
                    <ul>
                        <?php
                        while ($fila = mysqli_fetch_assoc($exp)) {
                            echo $fila["puesto"] . " en la empresa " . $fila["empresa"] . ", desde " . $fila["desde"] . ", hasta " . $fila["hasta"] . ". Numero de contacto referencia: " . $fila["contacto"] . "<br>";
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
        <div class="container ">
            <div class="row">

                <div class="col col-md-12">
                    <h5><mark>Preferencias laborales</mark></h5>
                    <ul>
                        <li>Situacion actual: <?php echo $usuario['situacionlab'] == 1 ? "Dispobible" : "Ocupado" ?></li>
                        <li>Area: <?php echo $usuario['area'] ?></li>
                        <li>Modalidad: <?php echo ucfirst($modalidad) ?></li>
                        <li>Salario minimo aceptado: <?php echo $usuario['salariomin'] ?></li>
                        <li>Disponibilidad para viajar: <?php echo $usuario['dispoviajar'] == 1 ? "No" : "Si" ?></li>
                        <li>Disponibilidad para cambio de residencia: <?php echo $usuario['dispomuda'] == 1 ? "No" : "Si" ?></li>
                    </ul>
                </div>

            </div>
        </div>

        <!--BOX  -->
        <div class="container ">
            <div class="row">

                <div class="col col-md-12">
                    <h5><mark>Idiomas</mark></h5>
                    <ul>
                        <?php foreach ($idiomasbd as $idioma) {
                            echo "<li>" .  ucfirst($idioma) . "</li>";
                        } ?>
                    </ul>
                </div>

            </div>
        </div>
        <div class="container" align="center">
            <button type="button" id="imprimir">Imprimir</button>
            <!--<button type="button" id="borrar">Borrar</button>                -->
        </div>
        <br>

    </div>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
    <!-- <script type="text/javascript" src="../assets/js/recuperarPass.js"></script> -->
    <script type="text/javascript" src="../assets/js/borrarUser.js"></script>
    <script type="text/javascript" src="../assets/js/usuario.js"></script>
</body>

</html>
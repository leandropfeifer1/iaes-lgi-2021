<?php
require('../db/conexionDb.php');
session_start();
unset($_SESSION['pais']);
unset($_SESSION['provincia']);
unset($_SESSION['departamento']);
unset($_SESSION['localidad']);
if (!isset($_SESSION['usuario'])) {
    header('location: ../db/logout.php');
}
?>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ubicaciones</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../plugins/sweetalert/sweetalert2.min.css">
        <link rel="stylesheet" href="../assets/css/register.css">
        <link href="../select2/css/select2.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>
        <div class="contenido">
            <div id="log_img" class="logo">
                <a href="./filtro.php" class="logo__link">
                    <img src="http://www.iaes.edu.ar/wp-content/uploads/2014/08/logo-top-1.png" alt="Logo del IAES" />
                </a>
            </div>
            <header id="header" class="header_dasboard">
                <?php
                if (isset($_GET['tipo'])) {
                    echo '<a id="nombreUsuario" class="header_link" href="./editarCredenciales.php?tipo=1">';
                    echo $_SESSION['usuario'];
                    echo '</a>';
                } else {
                    echo '<a id="nombreUsuario" class="header_link" href="./editarCredenciales.php">';
                    echo $_SESSION['usuario'];
                    echo '</a>';
                }
                ?>
                <?php
                if (isset($_GET['tipo'])) {
                    echo '<a class="header_link" href="./dashboardSecretaria.php">Volver</a>';
                } else {
                    echo '<a class="header_link" href="./filtro.php">Volver</a>';
                }
                ?>
                <a class="header_link" href="empresas.php">Empresas</a>
                <a class="header_link" href="buscempleado.php">Busquedas de Empleados</a>
                <a class="header_link" href="../db/logout.php">Salir</a>

            </header>
        </div>

        <header>
            <h3 class="text-center">Todas las Ubicaciones</h3>
        </header>
        <div class="container" >            
            <div class="row">
                <p align="right">                
                    <input id="reset" type="reset" value="Limpiar">
                    <label class="label-input" for="localidad">Pais</label>
                    <select name="pais" id="pais">
                    </select>                
                    <label class="label-input" for="provincia">Provincia</label>
                    <select name="provincia" id="provincia">
                    </select>
                    <label class="label-input" for="departamento">Departamento</label>
                    <select name="departamento" id="departamento">
                    </select> 
                    <label class="label-input" for="localidad">Localidad</label>
                    <select name="localidad" id="localidad">
                    </select>
                </p>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <caption>
                        <div>
                            <center>
                                <div>
                                    <button class="btn btn-primary" id="p" data-bs-toggle="modal" data-bs-target="#agrepais">Agregar Pais                 
                                    </button>
                                    <button class="btn btn-primary" id="pro" data-bs-toggle="modal" data-bs-target="#agrepro">Agregar Provincia               
                                    </button>
                                    <button class="btn btn-primary" id="dep" data-bs-toggle="modal" data-bs-target="#agredep">Agregar Departamento               
                                    </button>
                                    <button class="btn btn-primary" id="loc" data-bs-toggle="modal" data-bs-target="#agreloc">Agregar Localidad               
                                    </button>
                                </div>
                            </center>
                        </div>
                    </caption>
                </div>
            </div>
            <div class="container">   
                <div class="div-datos">

                </div>
            </div>
            <div class="modal fade" id="agrepais" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Pais</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">                 
                            <label>Pais</label>
                            <input type="text" name="pai" id="pai" class="form-control input-sm">                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="guardarP">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="agrepro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Provincia</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <th>Paises</th>
                            <select name="paisa" id="paisa" class="form-control">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM pais";
                                $lista = mysqli_query($conexion, $sql);
                                while ($fila = $lista->fetch_assoc()) {

                                    $idpais = $fila['idpais'];
                                    $pais = $fila['pais'];
                                    echo "<option value=$idpais>$pais</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <label>Provincia</label>
                            <input type="text" name="provi" id="provi" class="form-control input-sm">                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="guardarPro">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="agredep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Departamento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <th>Provincia</th>
                            <select name="provinciaa" id="provinciaa" class="form-control">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM provincia";
                                $lista = mysqli_query($conexion, $sql);
                                while ($fila = $lista->fetch_assoc()) {

                                    $provincia = $fila['idpro'];
                                    $nombre = $fila['provincia'];
                                    echo "<option value=$provincia>$nombre</option>";
                                }
                                ?>
                            </select>
                                <br>
                                <label>Departamento</label>                        
                                <input type="text" name="depa" id="depa" class="form-control input-sm">                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="guardardep">Guardar</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="agreloc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Localidad</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <th>Pais</th>
                            <select name="paisagregar" id="paisagregar" class="form-control">
                                <option value=""></option>
                                <?php
                                $sql1 = "SELECT * FROM pais";
                                $lista1 = mysqli_query($conexion, $sql1);
                                while ($fila = $lista1->fetch_assoc()) {
                                    $q = $fila['idpais'];
                                    $q2 = $fila['pais'];
                                    echo "<option value=$q>$q2</option>";
                                }
                                ?>
                            </select>
                            <th>Provincia</th>
                            <select name="proagre" id="proagre" class="form-control">
                                <option value=""></option>
                                <?php
                                $sql2 = "SELECT * FROM provincia";
                                $lista2 = mysqli_query($conexion, $sql2);
                                while ($fila = $lista2->fetch_assoc()) {

                                    $idproa = $fila['idpro'];
                                    $provincias = $fila['provincia'];
                                    echo "<option value=$idproa>$provincias</option>";
                                }
                                ?>
                            </select>
                            <label>Departamento</label>  
                            <select name="departamentoa" id="departamentoa" class="form-control">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM departamento";
                                $lista = mysqli_query($conexion, $sql);
                                while ($fila = $lista->fetch_assoc()) {

                                    $departamento = $fila['idep'];
                                    $nombre = $fila['departamento'];
                                    echo "<option value=$departamento>$nombre</option>";
                                }
                                ?>
                            </select>
                            <label>Localidad</label>                   
                            <input type="text" name="localidada" id="localidada" class="form-control input-sm">                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="guardarLoc">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modpais" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificar Pais</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label>Pais</label>    
                            <input type="text" hidden="" id="idpais" name="">
                            <input type="text" name="paise" id="paise" class="form-control input-sm">                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="mpais">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modpro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificar Provincia</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" hidden="" id="idpro" name="">
                            <label>Provincia</label>                        
                            <input type="text" name="provinciae" id="provinciae" class="form-control input-sm">                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="modproe">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="moddep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificar Departamento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <input type="text" hidden="" id="idep" name="">
                        <label>Departamento</label>                        
                        <input type="text" name="departamentoe" id="departamentoe" class="form-control input-sm">                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="modep">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modloc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Localidad</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" hidden="" id="idloc" name="">
                        <label>Nombre Localidad</label>                        
                        <input type="text" name="localidade" id="localidade" class="form-control input-sm">                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="modificarloc">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</body>
<script src="../jquery/jquery-3.6.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../popper/popper.min.js"></script>
<script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/js/ubicaciones.js"></script>
<script src="../select2/js/select2.js"></script>
<script>
    $(document).ready(function () {
        $('#modificarloc').click(function () {
            modificarloc();
        });

    });
    $(document).ready(function () {
        $('#mpais').click(function () {
            modificarpais();
        });

    });
    $(document).ready(function () {
        $('#modep').click(function () {
            modificardep();
        });

    });
    $(document).ready(function () {
        $('#modproe').click(function () {
            modificarpro();
        });

    });
    function agregarloc(datos) {
        loc = datos;
        $('#idloc').val(loc);
        console.log(loc)

    }
    function agregardep(datos) {
        dep = datos;
        $('#idep').val(dep);
        console.log(dep)

    }
    function agregarpro(datos) {
        pro = datos;
        $('#idpro').val(pro);
        console.log(pro)

    }
    function agregarpais(datos) {
        pa = datos;
        $('#idpais').val(pa);
        console.log(pa)

    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#guardarP').click(function () {
            pai = $('#pai').val();
            if (pai === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Falta Completar campo "Pais"',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
            } else {
                cadena = "pai=" + pai;
                $.ajax({
                    type: "POST",
                    url: "../db/newpais.php",
                    data: cadena,
                    success: function (r) {
                        if (r === "1") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pais Guardado',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                            $('#pai').val('');
                        } else {
                            alert("Fallo");
                        }
                    }
                });
                return false;
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#guardarPro').click(function () {
            pro = $('#provi').val();
            pais = $('#paisa').val();
            if (pai === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Falta Completar campo "Pais"',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
            } else {
                cadena = "pro=" + pro + "&pais=" + pais
                $.ajax({
                    type: "POST",
                    url: "../db/newpro.php",
                    data: cadena,
                    success: function (r) {
                        if (r === "1") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Provincia Guardado',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                            $('#pro').val('');
                        } else {
                            alert("Fallo");
                        }
                    }
                });
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#guardardep').click(function () {
            depa = $('#depa').val();
            provincia = $('#provinciaa').val();
            if (pai === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Falta Completar campo "Pais"',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
            } else {
                cadena = "depa=" + depa + "&provincia=" + provincia
                $.ajax({
                    type: "POST",
                    url: "../db/newdep.php",
                    data: cadena,
                    success: function (r) {
                        if (r == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Departamento Guardado',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                            $('#pro').val('');
                        } else {
                            alert("Fallo");
                        }
                    }
                });
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#guardardep').click(function () {
            depa = $('#depa').val();
            provincia = $('#provinciaa').val();
            if (pai === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Falta Completar campo "Pais"',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
            } else {
                cadena = "depa=" + depa + "&provincia=" + provincia
                $.ajax({
                    type: "POST",
                    url: "../db/newdep.php",
                    data: cadena,
                    success: function (r) {
                        if (r == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Departamento Guardado',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                            $('#pro').val('');
                        } else {
                            alert("Fallo");
                        }
                    }
                });
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#guardarLoc').click(function () {
            localidada = $('#localidada').val();
            departamentoa = $('#departamentoa').val();
            provincia = $('#proagre').val();
            pais = $('#paisagregar').val();
            
            if (pais === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Falta Completar campo "Pais"',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
            } else {
                if (provincia === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Falta Completar campo "Provincia"',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                } else {
                    if (departamentoa === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Falta Completar campo "Departamento"',
                            confirmButtonColor: '#ffa361',
                            confirmButtonText: 'Ok',
                        });
                    } else {
                        if (localidada === '') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Falta Completar campo "Localidad"',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                        } else {
                            cadena = "localidada=" + localidada + "&provincia=" + provincia + "&departamentoa=" + departamentoa + "&pais=" + pais
                            $.ajax({
                                type: "POST",
                                url: "../db/newloc.php",
                                data: cadena,
                                success: function (r) {
                                    if (r == 1) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Departamento Guardado',
                                            confirmButtonColor: '#ffa361',
                                            confirmButtonText: 'Ok',
                                        });
                                        $('#pro').val('');
                                    } else {
                                        alert("Fallo");
                                    }
                                }
                            });
                        }
                    }
                }
                return false;
            }
        });
    });
</script>
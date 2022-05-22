<?php
require('../db/conexionDb.php');
session_start();
unset($_SESSION['consulta']);
if (!isset($_SESSION['usuario'])) {
    header('location: ../db/logout.php');
}
?>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sucursales</title>
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
            <div class="create">
                <!-- <a id="botonCrear" href="./registro.php">Crear Usuario</a> -->
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
            <h3 class="text-center">Todas las Sucursales</h3>
        </header>
        <div class="container">
            <div id="buscador"></div>
            <div id="tabla"></div>
        </div>
        <div class="modal fade" id="modalagregarsuc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Sucursal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <th>Empresa</th>
                        <select name="empresas" id="empresas" class="form-control">
                            <option value="" disabled selected>Seleccione una Empresa</option>
                            <?php
                            $sql = "SELECT * FROM empresas";
                            $lista = mysqli_query($conexion, $sql);
                            while ($fila = $lista->fetch_assoc()) {

                                $idempresa = $fila['idempresa'];
                                $empresa = $fila['empresa'];
                                echo "<option value=$idempresa>$empresa</option>";
                            }
                            ?>
                        </select>
                        <label>Direccion</label>
                        <input type="text" name="direccion" id="direccion" class="form-control input-sm">
                        <th>Localidad</th>
                        <select name="localidad" id="localidad" class="form-control">
                        </select>
                        <th>Departamento</th>
                        <select name="departamento" id="departamento" class="form-control">
                        </select>
                        <th>Provincia</th>
                        <select name="provincia" id="provincia" class="form-control">
                        </select>
                        <th>Pais</th>
                        <select name="pais" id="pais" class="form-control">
                            <option value=""></option>
                            <?php
                            $sql = "SELECT * FROM pais";
                            $lista = mysqli_query($conexion, $sql);
                            while ($fila = $lista->fetch_assoc()) {

                                $pais = $fila['idpais'];
                                $nombre = $fila['pais'];
                                echo "<option value=$pais>$nombre</option>";
                            }
                            ?>
                        </select>
                        <label>Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control input-sm">
                        <label>Gerente</label>
                        <input type="text" name="gerente" id="gerente" class="form-control input-sm">
                        <th>Central</th>
                        <select name="central" id="central" class="form-control">
                            <option value=""></option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="guardarN">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <div class="modal fade" id="modaleditarsuc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Informacion de Sucursal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="text" hidden="" name="" id="idsucursal">

                    <label>Direccion</label>
                    <input type="text" name="direccione" id="direccione" class="form-control input-sm">
                    <th>Localidad</th>
                    <select name="localidade" id="localidade" class="form-control">
                        <option value=""></option>
                        <?php
                        $sql = "SELECT * FROM localidad";
                        $lista = mysqli_query($conexion, $sql);
                        while ($fila = $lista->fetch_assoc()) {

                            $localidad = $fila['idloc'];
                            $nombre = $fila['localidad'];
                            echo "<option value=$localidad>$nombre</option>";
                        }
                        ?>
                    </select>
                    <th>Departamento</th>
                    <select name="departamentoe" id="departamentoe" class="form-control">
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
                    <th>Provincia</th>
                    <select name="provinciae" id="provinciae" class="form-control">
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
                    <th>Pais</th>
                    <select name="paise" id="paise" class="form-control">
                        <option value=""></option>
                        <?php
                        $sql = "SELECT * FROM pais";
                        $lista = mysqli_query($conexion, $sql);
                        while ($fila = $lista->fetch_assoc()) {

                            $pais = $fila['idpais'];
                            $nombre = $fila['pais'];
                            echo "<option value=$pais>$nombre</option>";
                        }
                        ?>
                    </select>
                    <label>Telefono</label>
                    <input type="text" name="telefonoe" id="telefonoe" class="form-control input-sm">
                    <label>Gerente</label>
                    <input type="text" name="gerentee" id="gerentee" class="form-control input-sm">
                    <th>Central</th>
                    <select name="centrale" id="centrale" class="form-control">
                        <option value=""></option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="mod" class="btn btn-primary" onclick="console.log('aeeeeeeeeeee')">Guardar Cambios</button>
                </div>
            </div>

        </div>
    </div>
</body>
<script src="../jquery/jquery-3.6.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../popper/popper.min.js"></script>
<script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/js/sucursalesjs.js"></script>
<script src="../select2/js/select2.js"></script>
<script type="text/javascript">
                    $(document).ready(function () {
                        $('#tabla').load('sucursalestabla.php');
                        $('#buscador').load('bussuc.php')
                    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#guardarN').click(function () {
            var empresa = $('#empresas').val();
            direccion = $('#direccion').val();
            localidad = $('#localidad').val();
            departamento = $('#departamento').val();
            provincia = $('#provincia').val();
            pais = $('#pais').val();
            telefono = $('#telefono').val();
            gerente = $('#gerente').val();
            central = $('#central').val();
            console.log(empresa)
            if (empresa === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Falta Completar campo "Empresa"',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
            } else {
                if (direccion === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Falta Completar campo "CUIT"',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                } else {
                    if (localidad === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Falta Completar campo "Presidente"',
                            confirmButtonColor: '#ffa361',
                            confirmButtonText: 'Ok',
                        });
                    } else {
                        if (departamento === '') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Falta Completar campo "Empresa"',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                        } else {
                            if (provincia === '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Falta Completar campo "Telefono"',
                                    confirmButtonColor: '#ffa361',
                                    confirmButtonText: 'Ok',
                                });
                            } else {
                                if (pais === '') {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Falta Completar campo "Telefono"',
                                        confirmButtonColor: '#ffa361',
                                        confirmButtonText: 'Ok',
                                    });
                                } else {
                                    if (telefono === '') {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Falta Completar campo "Telefono"',
                                            confirmButtonColor: '#ffa361',
                                            confirmButtonText: 'Ok',
                                        });
                                    } else {
                                        if (gerente === '') {
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Falta Completar campo "Telefono"',
                                                confirmButtonColor: '#ffa361',
                                                confirmButtonText: 'Ok',
                                            });
                                        } else {
                                            if (central === '') {
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Falta Completar campo "Telefono"',
                                                    confirmButtonColor: '#ffa361',
                                                    confirmButtonText: 'Ok',
                                                });
                                            } else {
                                                agregardatos(empresa, direccion, localidad, departamento, provincia, pais, telefono, gerente, central);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            }
        });


    });
</script>
<script>
    $("#mod").click(function () {
        console.log("aaaaaaaa");
        modsucursal();
    });
</script>
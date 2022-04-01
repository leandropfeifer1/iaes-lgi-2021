<?php
require('../db/conexionDb.php');
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: ../db/logout.php');
}
?>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Empresas</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../plugins/sweetalert/sweetalert2.min.css">
        <link rel="stylesheet" href="../assets/css/register.css">
        <link rel="stylesheet" href="../assets/css/filtro.css">
        <script src="../jquery/jquery-3.6.0.min.js"></script>
        <script src="../popper/popper.min.js" type="text/javascript"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
        <script src="../assets/js/createUser.js"></script>
        <script src="../assets/js/empresasjs.js"></script>
    </head>

    <body>

    <body>
        <div class="contenido">
            <div id="log_img" class="logo">
                <a href="#" class="logo__link">
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
                <a class="header_link" href="ubicaciones.php">Ubicaciones</a>
                <a class="header_link" href="sucursales.php">Sucursales</a>
                <a class="header_link" href="buscempleado.php">Busquedas de Empleados</a>
                <a class="header_link" href="../db/logout.php">Salir</a>
            </header>
        </div>
        <header>
            <h3 class="text-center">Listado de Empresas</h3>
        </header>
        <div class="container">
            <div id="tabla"></div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalagregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Empresa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Empresa</label>
                        <input type="text" name="empresa" id="empresa" class="form-control input-sm">
                        <label>CUIT</label>
                        <input type="number" name="cuit" id="cuit" class="form-control input-sm">
                        <label>Presidente</label>
                        <input type="text" name="presidente" id="presidente" class="form-control input-sm">
                        <label>Correo</label>
                        <input type="text" name="correo" id="correo" class="form-control input-sm">
                        <label>Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control input-sm">
                        <label for="logo">Sube tu logo:</label>
                        <input accept="image/*" type="file" id="logo" name="logo" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="guardarN">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <div class="modal fade" id="modaleditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Informacion de Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" hidden="" id="idempresa" name="">
                    <label>Empresa</label>
                    <input type="text" name="empresae" id="empresae" class="form-control input-sm">
                    <label>CUIT</label>
                    <input type="number" name="cuite" id="cuite" class="form-control input-sm">
                    <label>Presidente</label>
                    <input type="text" name="presidentee" id="presidentee" class="form-control input-sm">
                    <label>Correo</label>
                    <input type="text" name="correoe" id="correoe" class="form-control input-sm">
                    <label>Telefono</label>
                    <input type="text" name="telefonoe" id="telefonoe" class="form-control input-sm">
                    <label for="logomod">Sube tu logo:</label>
                    <input accept="image/*" type="file" id="logomod" name="logomod" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="modificar" class="btn btn-primary" data-bs-dismiss="modal">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</body>


</html>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tabla').load('empresastabla.php');
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#guardarN').click(function () {
            empresa = $('#empresa').val();
            cuit = $('#cuit').val();
            presidente = $('#cuit').val();
            correo = $('#correo').val();
            telefono = $('#telefono').val();

            if ($("#logo").val()) {
                var lg = new FormData();
                var files = $("#logo")[0].files;
                var f1 = files[0];
                var logo = f1["name"];
                // Check file selected or not
                if (files.length > 0) {
                    lg.append("logo", files[0]);
                }
                log(lg);
            } else {
                var logo = 0;
            }


            if (empresa === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Falta Completar campo "Empresa"',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
            } else {
                if (cuit === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Falta Completar campo "CUIT"',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                } else {
                    if (presidente === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Falta Completar campo "Presidente"',
                            confirmButtonColor: '#ffa361',
                            confirmButtonText: 'Ok',
                        });
                    } else {
                        if (correo === '') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Falta Completar campo "Empresa"',
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
                                console.log(logo);
                                agregardatos(empresa, cuit, presidente, correo, telefono, logo);
                                log(lg);
                            }
                        }
                    }

                }
            }
        });


        $('#modificar').click(function () {
            modificar();
        });
    });
</script>
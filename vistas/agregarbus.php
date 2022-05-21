<?php
require('../db/conexionDb.php');
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('location: ../db/logout.php');
    }
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Busquedas</title>
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
            <img
                src="http://www.iaes.edu.ar/wp-content/uploads/2014/08/logo-top-1.png"
                alt="Logo del IAES"
            />
            </a>
        </div>
        <header id="header" class="header_dasboard">
            <?php 
                if(isset($_GET['tipo'])){
                    echo '<a id="nombreUsuario" class="header_link" href="./editarCredenciales.php?tipo=1">';
                    echo $_SESSION['usuario'];
                    echo '</a>';
                }else{
                    echo '<a id="nombreUsuario" class="header_link" href="./editarCredenciales.php">';
                    echo $_SESSION['usuario'];
                    echo '</a>';
                }
            ?>
            <?php 
                if(isset($_GET['tipo'])){
                    echo '<a class="header_link" href="./dashboardSecretaria.php">Volver</a>';
                }else{
                    echo '<a class="header_link" href="./buscempleado.php">Volver</a>';
                }
            ?>
            <a class="header_link" href="empresas.php">Empresas</a>
            <a class="header_link" href="sucursales.php">Sucursales</a>
            <a class="header_link" href="../db/logout.php">Salir</a>
        </header>
    </div>
    <header>
        <h3 class="text-center">Agregar Busqueda</h3>        
    </header>
        <div id="contenedor">
        
        <form id="formSignUp">
        <input id="reset" type="reset" value="Limpiar">
        <label class="label-input" for="empresa">Empresa</label>
        <select name="empresa" id="empresa">
        </select>
        <label class="label-input" for="sucursal">Sucursal</label>
        <select name="sucursal" id="sucursal">
        </select>
        <label class="label-input" for="edadmin">Edad Minima</label>
        <input class="edadInput" placeholder="Edad Minima" min=16 max=99 type="number" name="edadmin" id="edadmin">
        <label class="label-input" for="edadmax">Edad Máxima</label>
        <input class="edadInput" placeholder="Edad Máxima" min=16 max=99 type="number" name="edadmax" id="edadmax">
        <label class="label-input" for="carrera">Carrera</label>
        <select name="carrera" id="carrera">
        </select>
        <label class="label-input" for="disponibilidad">Disponibilidad</label>
        <select name="disponibilidad" id="disponibilidad">
            <option value="0">---</option>
            <option value="1">Full-Time</option>
            <option value="2">Part-Time</option>
            <option value="3">Trainee</option>
            <option value="4">Pasantías</option>
            <option value="5">Sin Preferencias</option>
        </select>
        <label class="label-input" for="genero">Género</label>
        <select name="genero" id="genero">
            <option value="0">---</option>
            <option value="1">Hombre</option>
            <option value="2">Mujer</option>
            <option value="3">No Binarix</option>
            <option value="4">Otros</option>
        </select>
       <label class="label-input" for="requisitos">Requisitos</label>       
        <input class="reqinput" placeholder="Requisitos"type="text" name="requisitos" id="requisitos">     
        <label class="label-input" for="sueldo">Sueldo</label>
        <input class="edadInput" placeholder="Sueldo" type="number" name="sueldo" id="sueldo">
        <button type="button" id="guardar" class="btn btn-primary" onclick="">Guardar</button>
    </form>
    </div>
    </body>
        <script src="../assets/js/agrebus.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#guardar').click(function() {
            sucursal = $('#sucursal').val();
            edadmin = $('#edadmin').val();
            edadmax = $('#edadmax').val();
            carrera = $('#carrera').val();
            disponibilidad = $('#disponibilidad').val();
            genero = $('#genero').val();            
            requisitos = $('#requisitos').val();
            sueldo = $('#sueldo').val();
            console.log(sueldo);
            if (sucursal === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Falta Completar campo "Sucursal"',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
            } else {
                if (edadmin === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Falta Completar campo "Edad Minima"',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                } else {
                    if (edadmax === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Falta Completar campo "Edad Maxima"',
                            confirmButtonColor: '#ffa361',
                            confirmButtonText: 'Ok',
                        });
                    } else {
                        if (carrera === '') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Falta Completar campo "Carrera"',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                        } else {
                            if (disponibilidad === '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Falta Completar campo "Disponibilidad"',
                                    confirmButtonColor: '#ffa361',
                                    confirmButtonText: 'Ok',
                                });
                            } else {
                                if (genero === '') {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Falta Completar campo "Genero"',
                                        confirmButtonColor: '#ffa361',
                                        confirmButtonText: 'Ok',
                                    });
                                } else {
                                    if (requisitos === '') {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Falta Completar campo "Requisitos"',
                                            confirmButtonColor: '#ffa361',
                                            confirmButtonText: 'Ok',
                                        });
                                    }else {                                            
                                                agregardatos(sucursal, edadmin, edadmax, carrera, disponibilidad, genero,requisitos, sueldo );
                                            
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

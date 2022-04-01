<?php
require('../db/conexionDb.php');
require('../db/verificarCredenciales.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/filtro.css">
    <link rel="stylesheet" href="../plugins/sweetalert/sweetalert2.min.css"> 
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="stylesheet" href="../plugins/sweetalert/sweetalert2.min.css">
    <title>Buscar Alumnos</title>
</head>
<body>
    <div class="content">
        <div id="log_img" class="logo">
            <a href="#" class="logo__link">
            <img
                src="http://www.iaes.edu.ar/wp-content/uploads/2014/08/logo-top-1.png"
                alt="Logo del IAES"
            />
            </a>
        </div>
        <div class="create">
            
        </div>
        <header id="header" class="header_dasboard">
            <a id="botonCrear" href="./agregarbus.php">Nueva Busqueda</a>
            <a class="header_link" href="./editarCredenciales.php">
                <?php echo $_SESSION['usuario'];?>
            </a>
            
            <a class="header_link" href="ubicaciones.php">Ubicaciones</a>
            <a class="header_link" href="sucursales.php">Sucursales</a>
            <a class="header_link" href="empresas.php">Empresas</a>
            <a class="header_link" href="filtro.php">Busquedas de Alumnos</a>
            <a class="header_link" href="../db/logout.php">Salir</a>
        </header>
    </div>
    <div class="divBuscador">
        <input placeholder="Buscar..." type="search" name="buscador" id="buscador">
        <label for="buscador"><svg id="lupa" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg></label>
    </div>
    <main>
            <form id="filterData" action="" method="post">
                <input id="reset" type="reset" value="Limpiar">
                <label class="label-input" for="empresa">Empresa</label>
                <select name="empresa" id="empresa">
                </select>
                <label class="label-input" for="sucursal">Sucursal</label>
                <select name="sucursal" id="sucursal">
                </select>
                <label class="label-input" for="carrera">Carrera</label>
                <select name="carrera" id="carrera">
                </select>
                <label class="label-input" for="edad">Edad</label>
                <input class="edadInput" placeholder="Edad desde" min=16 max=99 type="number" name="edad" id="edad">
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
                <label class="label-input" for="provincia">Provincia</label>
                <select name="provincia" id="provincia">
                </select>
                <label class="label-input" for="departamento">Departamento</label>
                <select name="departamento" id="departamento">
                </select> 
                <label class="label-input" for="localidad">Localidad</label>
                <select name="localidad" id="localidad">
                </select>
            </form>
        <div class="separatorFilter">
            <div class="div-datos">
                <!-- aca van los resultados de la db -->
            </div>
            
        </div>
    </main>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/busqueda.js"></script>
    <script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
</body>
<script>
function confimaciondel(idbusqueda) {
  Swal.fire({
    title: "Confirme",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      borrar(idbusqueda);     
      Swal.fire("Borrado!", "Se Elimino con Exito.", "Exito");
    }
  });
}
function borrar(idbusqueda) {
  cadena = "idbusqueda=" + idbusqueda;
  console.log(cadena)
  $.ajax({
    type: "POST",
    url: "../db/delbus.php",
    data: cadena,
    success: function (r) {
      if (r === "1") {
        Swal.fire({
          icon: 'success',
          title: "Borrado",
          confirmButtonColor: "#ffa361",
          confirmButtonText: "Ok",
          
        });        
      } else {
        Swal.fire({
          icon: 'warning',
          title: "Fallo al Borrar",
          confirmButtonColor: "#ffa361",
          confirmButtonText: "Ok",
           
        });
      }
    },
  });
  setTimeout("location.reload(true);",1500)
}

</script>
<?php 
    session_start();
    require('../db/conexionDb.php');
    if(isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])){
         $sql = 'SELECT idrol from roles where descripcion = "secretaria"';
        $resultado = mysqli_query($conexion, $sql);
        if (!empty($resultado) && mysqli_num_rows($resultado) != 0){
            $row = mysqli_fetch_assoc($resultado);
        }
        if(isset($row['idrol'])){
            if($_SESSION['id_rol'] != $row['idrol']){
                header('location: ../logout.php');
            }
        }
        mysqli_close($conexion);
    }else{
        header('location: ../logout.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/filtro.css">
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
            <a id="botonCrear" href="./registro.php">Crear Usuario</a>
        </div>
        <header id="header" class="header_dasboard">
            <a class="header_link" href="./editarCredenciales.php">
                <?php echo $_SESSION['usuario'];?>
            </a>
            <a class="header_link" href="./dashboardAdmin.php">Volver</a>
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
                <label class="label-input" for="carrera">Carrera</label>
                <select name="carrera" id="carrera">
                    <option value="0">---</option>
                    <option value="1">Analista de Sistemas</option>
                    <option value="2">Turismo y Gestión Hotelera</option>
                    <option value="3">Administración de Empresas</option>
                    <option value="4">Régimen Aduanero</option>
                    <option value="5">Recursos Humanos</option>
                </select>

                <label class="label-input" for="edadMin">Edad Mínima</label>
                <input class="edadInput" placeholder="Edad desde" min=16 max=99 type="number" name="edadMin" id="edadMin">
                <label class="label-input" for="edadMax">Edad Máxima</label>
                <input class="edadInput" placeholder="Edad hasta" min=16 max=99 type="number" name="edadMax" id="edadMax">

                <label class="label-input" for="modalidad">Modalidad</label>
                <select name="modalidad" id="modalidad">
                    <option value="0">---</option>
                    <option value="1">Full-Time</option>
                    <option value="2">Part-Time</option>
                    <option value="3">Trainee</option>
                    <option value="4">Pasantías</option>
                </select>
                <label class="label-input" for="genero">Género</label>
                <select name="genero" id="genero">
                    <option value="0">---</option>
                    <option value="1">Hombre</option>
                    <option value="2">Mujer</option>
                    <option value="3">No Binarix</option>
                    <option value="4">Otros</option>
                </select>
                <label class="label-input" for="localidad">Localidad</label>
                <select name="localidad" id="localidad">
                    <option value="0">---</option>
                    <option value="1">Puerto Rico</option>
                    <option value="2">Garuhapé</option>
                    <option value="3">Capioví</option>
                    <option value="4">Jardín América</option>
                    <option value="5">El Alcázar</option>
                    <option value="6">Puerto Leoni</option>
                    <option value="7">Otro</option>
                </select>
                <label class="label-input" for="licencia">Licencia</label>
                <select name="licencia" id="licencia">
                    <option value="0">---</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                </select>
                <label class="label-input" for="vehiculo">vehiculo</label>
                <select name="vehiculo" id="vehiculo">
                    <option value="0">---</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                </select>
                <label class="label-input" for="disponible">Disponibilidad</label>
                <select name="disponible" id="disponible">
                    <option value="0">---</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                </select>
            </form>
        <div class="separatorFilter">
            <div class="div-datos">
                <!-- aca van los resultados de la db -->
            </div>
            
        </div>
    </main>
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/filter.js"></script>
</body>
</html>
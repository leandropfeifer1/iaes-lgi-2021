<?php 
    require('../db/verificarCredenciales.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Dashboard</title>
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
        <header id="header" class="header_dasboard">
            <a class="header_link" href="./editarCredenciales.php">
                <?php  
                 echo $_SESSION['usuario'];
                //  if(isset($row['nombre'])){echo($row['nombre']);}
                ?>
            </a>
            <a class="header_link" href="../db/logout.php">Salir</a>
        </header>
    </div>
    
    <nav class="div_nav">
            <a class="main_link" href="./registro.php">Nuevo Usuario</a>
            <a class="main_link" href="#">Editar Usuario</a>
            <a class="main_link" href="#">Borrar Usuario</a>
    </nav>
    <main>
        <div class="separatorFilter">
            <form id="filterData" action="" method="post">
                <label for="carrera">Carrera</label>
                <select name="carrera" id="carrera">
                    <option value="0">---</option>
                    <option value="1">Analista de Sistemas</option>
                    <option value="2">Administración de Empresas</option>
                    <option value="3">Gestión de Recursos Humanos</option>
                    <option value="4">Turismo y Gestión Hotelera</option>
                    <option value="5">Régimen Aduanero</option>
                </select>
                <label for="localidad">Localidad</label>
                <select name="localidad" id="localidad">
                    <option value="">---</option>
                    <option value="1">Puerto Rico</option>
                    <option value="2">Capioví</option>
                    <option value="3">Garuhapé</option>
                    <option value="4">Jardín América</option>
                    <option value="5">El Alcázar</option>
                    <option value="6">Puerto Leoni</option>
                    <option value="7">Otro</option>
                </select>
                <label for="genero">Género</label>
                <select name="genero" id="genero">
                    <option value="0">---</option>
                    <option value="mujer">Mujer</option>
                    <option value="hombre">Hombre</option>
                    <option value="nobinario">No Binarix</option>
                    <option value="otro">Otros</option>
                </select>
                <div class="separator">
                    <label for="edad">Edad</label>
                    <input min=18 max=99 type="number" name="edad" id="edad">
                </div>
                <div class="separator">
                    <p for="licencia">Licencia de Conducir:</p>
                    <input value="1" type="radio" name="licencia" id="licenciaSi">
                    <label for="licenciaSi">Si:</label>
                    <input value="0" type="radio" name="licencia" id="licenciaNo">
                    <label for="licenciaNo">No:</label>
                </div>
                <label for="vehiculo">vehiculo Propio</label>
                <select name="vehiculo" id="vehiculo">
                    <option value="0">---</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                </select>
                <label for="viajar">Disponibilidad para viajar</label>
                <select name="viajar" id="viajar">
                    <option value="0">---</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                </select>
                <div class="separator">
                    <label for="salario">Salario Minimo</label>
                    <input min=0 type="number" name="salario" id="salario">
                </div>
                <div class="separator">
                    <label for="discapacidad">Discapacidades</label>
                    <input value="0" type="radio" name="discapacidad" id="discapacidad">
                    <label for="licenciaNo">No:</label>
                </div>
                
            </form>
        </div>

        <!-- ---------------------- PONER UN BUSCADOR ----------------------------- -->
        <div class="content">
            <!-- aca van los resultados de la db -->
        </div>
    </main>
</body>
</html>
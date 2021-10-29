<?php 
    session_start();
    require('../db/conexionDb.php');
    
    // Si no tiene las credenciales no accede
    if(isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])){
        $sql = 'SELECT idrol from roles where descripcion = "admin"';
        $resultado = mysqli_query($conexion, $sql);
        if (!empty($resultado) && mysqli_num_rows($resultado) != 0){
            $row = mysqli_fetch_assoc($resultado);
        }
        if(isset($row['idrol']) && $row['idrol']!=$_SESSION['id_rol']){
            header('location: ../db/logout.php');
        }
        mysqli_close($conexion);
    }else{
        header('location: ../db/logout.php');
    }
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
    <header class="header_dasboard">
        <a class="header_link" href="#">
            Admin: 
            <?php  
                echo $_SESSION['usuario'];
                if(isset($row['nombre'])){echo($row['nombre']);}
            ?>
        </a>
        <a class="header_link" href="../db/logout.php">Salir</a>
    </header>
    <nav class="div_nav">
            <a target="_blank" class="main_link" href="#">Nuevo Usuario</a>
            <a target="_blank" class="main_link" href="#">Editar Usuario</a>
            <a target="_blank" class="main_link" href="#">Borrar Usuario</a>
    </nav>
    <main>
        <form action="" method="post">
            <!-- aca van los inputs para filtrar -->
        </form>
        <div class="content">
            <!-- aca van los resultados de la db -->
        </div>
    </main>
</body>
</html>
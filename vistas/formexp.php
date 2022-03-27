<?php
session_start();
require('../db/conexionDb.php');

if (isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])) {
    $sql = 'SELECT idrol from roles where descripcion = "usuario"';
    $resultado = mysqli_query($conexion, $sql);
    if (!empty($resultado) && mysqli_num_rows($resultado) != 0) {
        $row = mysqli_fetch_assoc($resultado);
    }
    if (isset($row['idrol'])) {
        if ($_SESSION['id_rol'] != $row['idrol']) {
            header('location: ../db/logout.php');
        }
    }
    mysqli_close($conexion);
} else {
    header('location: ../logout.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styleUser.css">
    <title>Experiencia laboral</title>
</head>

<body>
    <header id="head">
        <div class="logo">
            <a href="#" class="logo__link">
                <img src="http://www.iaes.edu.ar/wp-content/uploads/2014/08/logo-top-1.png" alt="Logo del IAES" />
            </a>
        </div>
        <nav>
        
        <?php
        if (isset($_GET['tipo'])) {
            echo '<a class="nav__link" href="./dashboardSecretaria.php">Volver</a>';
        } else {
            if ($_SESSION['id_rol'] == 3) {
                echo '<a class="nav__link" href="./dashboardUser.php">Volver</a>';
            } else {
                echo '<a class="nav__link" href="./filtro.php">Volver</a>';
            }
        }
        ?>
        <a href="../db/logout.php" class="nav__link">Salir</a>
        </nav>
    </header>
    <!-- -->
    <div class="container">
        <div class="abs-center">

            <form id="form-exp">
                <input type="hidden" id="iduser" value="<?php echo $_SESSION['id_user']; ?>">
                <input type="hidden" id="idexp">

                <fieldset>

                    <legend>Experiencias:</legend>

                    <div class="form-group row">
                        <div class="col-sm-5">
                            <label for="empresa">Empresa:</label>
                            <input type="text" id="empresa" class="form-control" value="">
                            <span id="error_empresa" class="text-danger"></span>
                        </div>
                        <div class="col-sm-5">
                            <label for="puesto">Puesto:</label>
                            <input type="text" id="puesto" class="form-control" value="">
                            <span id="error_puesto" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="desde">Desde:</label>
                            <input type="date" id="desde" value="" min="1900/01/01" max="<?php echo date('Y-m-d') ?>" class="form-control">
                            <span id="error_desde" class="text-danger"></span>
                        </div>
                        <div class="col-sm-2">
                            <label for="hasta">Hasta:</label>
                            <input type="date" id="hasta" value="" min="1900/01/01" max="<?php echo date('Y-m-d') ?>" class="form-control">
                            <span id="error_hasta" class="text-danger"></span>
                        </div>

                        <div class="col-sm-4">
                            <label for="contacto">Numero de contacto:</label>
                            <input type="number" id="contacto" class="form-control" value="">
                            <span id="error_contacto" class="text-danger"></span>
                        </div>
                    </div><br>
                    <div class="input-group">
                        <button id="guardarExp" type="submit" class="btn btn-primary" value="Guardar">Guardar</button><span id="error" class="text-danger"></span>
                    </div>

                </fieldset>



            </form>
            <!-- -------------------------------------------------------------------------------------------------------------------------->

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Empresa</td>
                        <td>Puesto</td>
                        <td>Desde</td>
                        <td>Hasta</td>
                        <td>Contacto</td>
                    </tr>
                </thead>
                <tbody id="exps"></tbody>

            </table>

            <!-- -------------------------------------------------------------------------------------------------------------------------->
            <script src="../jquery/jquery-3.6.0.min.js"></script>
            <script src="../bootstrap/js/bootstrap.min.js"></script>
            <script src="../assets/js/appexp.js"></script>
</body>

</html>
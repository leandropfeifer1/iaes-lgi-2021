
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Experiencia laboral</title>
</head>

<body>

    <!-- -->
    <div class="container p-4">
        <div class="abs-center">

            <form id="form-exp">  
                <input type="hidden" id="iduser" value="<?php echo $_SESSION['id_user']; ?>">
                <input type="hidden" id="idexp">
                       
                <fieldset>                   

                    <legend>Experiencias:</legend>
                    
                    <div class="form-group">
                        <label for="empresa">Empresa:</label>
                        <input type="text" id="empresa" value="">
                    </div>
                    <div class="form-group">
                        <label for="puesto">Puesto:</label>
                        <input type="text" id="puesto" value="">
                    </div>
                    <div class="form-group">
                        <label for="desde">Desde:</label>
                        <input type="date" id="desde" value="" min="1900/01/01" max="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="form-group">
                        <label for="hasta">Hasta:</label>
                        <input type="date" id="hasta" value="" min="1900/01/01" max="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="form-group">
                        <label for="contacto">Numero de contacto:</label>
                        <input type="text" id="contacto" value="">
                    </div>
                </fieldset>  

                <div class="input-group">
                    <button type="submit" class="btn btn-primary" value="Guardar">Guardar</button>
                    <Input type ="button" value="Cerrar" onclick = "window.close()" class="btn btn-danger">
                </div>                

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
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="../assets/js/appexp.js"></script>
</body>

</html>
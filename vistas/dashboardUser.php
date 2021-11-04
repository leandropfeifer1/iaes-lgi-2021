<?php 
    session_start();
    require('../db/conexionDb.php');
    
    if(isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])){
         $sql = 'SELECT * FROM `roles` WHERE descripcion = "usuario"';
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">

	<title>Formulario</title>
	
	<style>
			.error {
			color: #FF0000;
		}
	</style>
</head>
<body>
	<?php include 'funciones.js' ?>
	<?php include '../db/mostrar.php' ?>
	<?php include 'nav.php' ?>
	<?php include 'redimg.php' ?>
	<!-- ----------------------------------------------------------------------- -->

	<div class="container">
		<div class="abs-center">
			<form method="post" action="../db/create.php" enctype="multipart/form-data">

				<?php $result = mostrarPersonales(); ?>

				<fieldset>
					<p><span class="error">* Campo obligatorio</span></p>
					<legend>Datos personales:</legend>

					<?php
					$imagen = foto();
					$array_medidas_img = redimensionar($imagen, 400);
					echo '<img src="' . $imagen . '" width="' . $array_medidas_img[0] . '" height="' . $array_medidas_img[1] . '" align="right"/>';
					?>

					<label for="nombre">Nombre:</label>
					<input type="text" name="nombre" value="<?php echo $result['usuario'] ?>">
					<span class="error">* </span><br>

					<label for="apellido">Apellido:</label>
					<input type="text" name="apellido" value="<?php echo $result['apellido'] ?>">
					<span class="error">* </span><br>

					<label for="email">Email:</label>
					<input type="text" name="email" value="<?php echo $result['email'] ?>">
					<span class="error">* </span><br>

					<label for="numdoc">Numero documento:</label>
					<input type="text" name="numdoc" value="<?php echo $result['numdoc'] ?>">
					<span class="error">* </span><br>

					<label for="fnacimiento">Fecha de nacimiento:</label>
					<input type="date" name="fnacimiento" value="<?php echo $result['fnacimiento'] ?>">
					<span class="error">* </span><br>

					<label for="gen">Genero:</label>
					<input type="radio" name="gen" value="mujer" <?php if ($result['gen'] == "mujer") { ?>checked="checked" <?php } ?>>Mujer
					<input type="radio" name="gen" value="hombre" <?php if ($result['gen'] == "hombre") { ?>checked="checked" <?php } ?>>Hombre
					<input type="radio" name="gen" value="otro" <?php if ($result['gen'] == "otro") { ?>checked="checked" <?php } ?>>Otro
					<span class="error">* </span><br>

					<label for="ecivil">Estado civil:</label>
					<select id="ecivil" name="ecivil" value="<?php echo $result['ecivil'] ?>">
						<option value=""></option>
						<option value="Soltero">Soltero</option>
						<option value="Casado">Casado</option>
					</select>
					<span class="error">* </span><br>

					<label for="telefono">Telefono:</label>
					<input type="text" name="telefono" value="<?php echo $result['telefono'] ?>">
					<span class="error">* </span><br>

                                        <table>
                                            <tr>
                                                <th>Paises</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select name="Pais">
                                                    <?php
                                                    include '../db/conexionDb.php';
                                                    $sql = "SELECT * FROM pais";
                                                    $lista = mysqli_query($conexion, $sql);
                                                    while($fila = $lista->fetch_assoc()){
                                                            $id=$fila['idpais'];
                                                            $nombre=$fila['pais'];
                                                            echo "<option value=$id>$nombre</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>

					<table>
                                            <tr>
                                                <th>Provincia</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select name="Provincia">
                                                    <?php
                                                    include '../db/conexionDb.php';
                                                    $sql = "SELECT * FROM provincia";
                                                    $lista = mysqli_query($conexion, $sql);
                                                    while($fila = $lista->fetch_assoc()){
                                                            $id=$fila['idpro'];
                                                            $nombre=$fila['provincia'];
                                                            echo "<option value=$id>$nombre</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <th>Departamento</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select name="Departamento">
                                                    <?php
                                                    include '../db/conexionDb.php';
                                                    $sql = "SELECT * FROM departamento";
                                                    $lista = mysqli_query($conexion, $sql);
                                                    while($fila = $lista->fetch_assoc()){
                                                            $id=$fila['idep'];
                                                            $nombre=$fila['departamento'];
                                                            echo "<option value=$id>$nombre</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                        	<table>
                                            <tr>
                                                <th>Localidad</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select name="Localidad">
                                                    <?php
                                                    include '../db/conexionDb.php';
                                                    $sql = "SELECT * FROM localidad";
                                                    $lista = mysqli_query($conexion, $sql);
                                                    while($fila = $lista->fetch_assoc()){
                                                            $id=$fila['idloc'];
                                                            $nombre=$fila['localidad'];
                                                            echo "<option value=$id>$nombre</option>";
                                                    }
                                                    ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>

					<label for="codpostal"> Codigo postal:</label>
					<input type="text" name="codpostal" value="<?php echo $result['codpostal'] ?>">
					<span class="error">* </span><br>

					<label for="direccion">Direccion:</label>
					<input type="text" name="direccion" value="<?php echo $result['direccion'] ?>">
					<span class="error">* </span><br>

					<label for="lic">Licencia de conducir:</label>
					<input type="radio" name="lic" value="si" <?php if ($result['lic'] == "si") { ?>checked="checked" <?php } ?>>Si
					<input type="radio" name="lic" value="no" <?php if ($result['lic'] == "no") { ?>checked="checked" <?php } ?>>No
					<span class="error">* </span><br>

					<label for="vehic">Dispone de vehiculo propio:</label>
					<input type="radio" name="vehic" value="si" <?php if ($result['vehic'] == "si") { ?>checked="checked" <?php } ?>>Si
					<input type="radio" name="vehic" value="no" <?php if ($result['vehic'] == "no") { ?>checked="checked" <?php } ?>>No
					<span class="error">* </span><br>

					<label for="disc">Discapacidad:</label>
					<input type="radio" name="disc" value="si" <?php if ($result['disc'] == "si") { ?> checked="checked" <?php } ?> onclick="mostrar()">Si
					<input type="radio" name="disc" value="no" <?php if ($result['disc'] == "no") { ?> checked="checked" <?php } ?> onClick="ocultar()">No
					<span class="error">* </span><br>
					
					<div id="discesp">
						<label for="discesp">Especifique su discapacidad:</label>
						<textarea name="discesp" rows="5" cols="40" value="<?php echo $result['discesp'] ?>"></textarea>
						<span class="error">* </span><br>
					</div>

					<label for="foto">Sube tu foto:</label>
					<input accept="image/*" type="file" name="foto" id="foto"><br>

					<label for="cv">CV: </label>
					<input type="hidden" name="MAX_FILE_SIZE" value="512000000" />
					<input type="file" id="cv" name="cv" accept="aplicaction/pdf">

				</fieldset>
				<input type="submit" value="Guardar" name="save4">
				<input type="reset"><br><br><br>

			</form>
		</div>
	</div>

	<!-- JavaScript -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>



</html>
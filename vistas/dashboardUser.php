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

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<?php
	include('header.php');
	include('conexionDb.php');
	include('idiomas.php');
	//include('mostrar_reg.php');
	?>	


	<script type="text/javascript" src="script/form.js"></script>
	<script type="text/javascript" src="input.js"></script>

	<style type="text/css">
		#register_form fieldset:not(:first-of-type) {
			display: none;
		}
	</style>

	<div class="container">
		<br>
		<h2 align="center">Informacion del usuario:</h2>

		<div class="progress">
			<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>

		<div class="alert alert-success hide"></div>
		

		<form enctype="multipart/form-data" id="register_form" novalidate action="multi_form_action.php" method="post">		
			<input type="hidden" id="iduser" value="<?php echo $_SESSION['id_user']; ?>">
			<!-- ----------------------------------------------------------------------------------------------------------------------------->
			<fieldset>
				
				<h2>Datos personales:</h2>

				<div class="form-group">
					<label for="usuario">Nombre:</label>
					<input type="text" class="form-control" id="usuario" name="usuario" value="">
				</div>

				<div class="form-group">
					<label for="apellido">Apellido:</label>
					<input type="text" class="form-control" id="apellido" name="apellido" value="">
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email" name="email" value="">
				</div>

				<div class="form-group">
					<label for="dni">Numero documento:</label>
					<input type="text" class="form-control" id="dni" name="dni">
				</div>

				<div class="form-group">
					<label for="fechanacimiento">Fecha de nacimiento:</label>
					<input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" value="" required min="1900/01/01" max="<?php echo date('Y-m-d') ?>">
				</div>


				<div class="form-group">
					<label for="genero">Genero:</label>
					<input type="radio" id="g1" name="genero" value="mujer">Mujer
					<input type="radio" id="g2" name="genero" value="hombre">Hombre
					<input type="radio" id="g3" name="genero" value="otro">Otro
				</div>

				<div class="form-group">
					<label for="ecivil">Estado civil:</label>
					<select id="ecivil" name="ecivil" value="">
						<option id="e1" value=""></option>
						<option id="e2" value="Soltero">Soltero</option>
						<option id="e3" value="Casado">Casado</option>
					</select>
				</div>

				<div class="form-group">
					<label for="contacto">Telefono:</label>
					<input type="tel" class="form-control" id="contacto" name="contacto" value="">
				</div>

				<table>
					<tr>
						<th>Localidad</th>
					</tr>
					<tr>
						<td>
							<select name="localidad" class="form-control">
								<?php
								include '../db/conexionDb.php';
								$sql = "SELECT * FROM localidad";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									$localidad = $fila['idloc'];
									$nombre = $fila['localidad'];
									echo "<option value=$localidad>$nombre</option>";
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
							<select name="departamento" class="form-control">
								<?php
								include '../db/conexionDb.php';
								$sql = "SELECT * FROM departamento";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									$id = $fila['idep'];
									$nombre = $fila['departamento'];
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
							<select name="provincia" class="form-control">
								<?php
								include '../db/conexionDb.php';
								$sql = "SELECT * FROM provincia";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									$id = $fila['idpro'];
									$nombre = $fila['provincia'];
									echo "<option value=$id>$nombre</option>";
								}
								?>
							</select>
						</td>
					</tr>
				</table>

				<table>
					<tr>
						<th>Paises</th>
					</tr>
					<tr>
						<td>
							<select name="pais" class="form-control">
								<?php
								include '../db/conexionDb.php';
								$sql = "SELECT * FROM pais";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									$idpais = $fila['idpais'];
									$nombre = $fila['pais'];
									echo "<option value = $idpais >$nombre</option>";
								}
								?>
							</select>
						</td>
					</tr>
				</table>

				<div class="form-group">
					<label for="codpostal"> Codigo postal:</label>
					<input type="number" class="form-control" id="codpostal" name="codpostal" value="">
				</div>
				<div class="form-group">
					<label for="domicilio">Direccion:</label>
					<input type="text" class="form-control" id="domicilio" name="domicilio" value="">
				</div>



				<div class="form-group">
					<label for="licencia">Licencia de conducir:</label>
					<input type="radio" name="licencia" value="1" id="licsi">Si
					<input type="radio" name="licencia" value="0" id="licno">No
				</div>

				<div id="auto" class="form-group" style="display:none">
					<label for="auto">Dispone de vehiculo propio:</label>
					<input id="vsi" type="radio" name="auto" value="1">Si
					<input id="vno" type="radio" name="auto" value="0">No
				</div>


				<div class="form-group">
					<label for="disc">Discapacidad:</label>
					<input id="discsi" type="radio" name="discapacidad" value="1">Si
					<input id="discno" type="radio" name="discapacidad" value="0">No
				</div>

				<div id="disc" class="form-group" style="display:none">
					<label for="discapacidades">Especifique su discapacidad:</label>
					<textarea id="discapacidades" name="detdiscapacidad" rows="5" cols="40" value=""></textarea>
				</div>



				<div class="form-group">
					<label for="foto">Sube tu foto:</label>
					<input type="file" name="foto" accept="image/*" class="form-control" id="foto"><br>
				</div>

				<div class="form-group">
					<label for="pdf">CV: </label>
					<input type="hidden" name="MAX_FILE_SIZE" value="512000000">
					<input type="file" id="pdf" class="form-control" name="pdf" accept="aplicaction/pdf">
				</div>

				<input type="button" class="next-form btn btn-info" value="Siguiente" />
			</fieldset>

			<!-- ----------------------------------------------------------------------------------------------------------------------------->

			<fieldset>
				<h2> Datos Academicos</h2>
				<div class="form-group">
					<label for="neducativo">Indicá tu nivel educativo alcanzado:</label><br>
					<input type="radio" name="neducativo" id="n1" value="Terciario incompleto">Terciario incompleto<br>
					<input type="radio" name="neducativo" id="n2" value="Terciario completo">Terciario completo<br>
					<input type="radio" name="neducativo" id="n3" value="Universitario incompleto">Universitario incompleto<br>
					<input type="radio" name="neducativo" id="n4" value="Universitario completo">Universitario completo<br><br>
				</div>
				<div class="form-group">
					<label for="ecivil">Carreras hechas:</label>
					<select id="ecivil" name="carh" value="">
						<option id="c1" value=""></option>
						<option id="c2" value="1">Analistas de Sistemas</option>
						<option id="c3" value="2">Turismo y Gestion Hotelera</option>
						<option id="c4" value="3">Administración de Empresas</option>
						<option id="c5" value="4">Régimen Aduanero</option>
					</select>
				</div>
				<div class="form-group">
					<label for="cursos">Cursos realizados:</label>
					<textarea name="cursos" id="cursos" rows="5" cols="40" value=""></textarea>
				</div>

				<input type="button" name="previous" class="previous-form btn btn-default" value="Atras" />
				<input type="button" name="next" class="next-form btn btn-info" value="Siguiente" />
			</fieldset>
			<!-- ----------------------------------------------------------------------------------------------------------------------------->
			<fieldset>
				<h2> Experiencias laborales</h2>

				<div class="form-group">
					<a href="formulario_experiencia/index.php" target="_blank">Cargar experiencias</a>
				</div>

				<input type="button" name="previous" class="previous-form btn btn-default" value="Previous" />
				<input type="button" name="next" class="next-form btn btn-info" value="Next" />
			</fieldset>


			<fieldset>
				<h2> Conocimientos y habilidades</h2>

				<div class="form-group">
					<label for=""> Idiomas:</label>
					<input type="checkbox" name="idiomas[]" value="1" <?php if (comparar(1,$_SESSION['id_user'])){ ?> checked <?php } ?> >Español</input>
					<input type="checkbox" name="idiomas[]" value="2" <?php if (comparar(2,$_SESSION['id_user'])){ ?> checked <?php } ?> >Inglés</input>
					<input type="checkbox" name="idiomas[]" value="3" <?php if (comparar(3,$_SESSION['id_user'])){ ?> checked <?php } ?> >Francés</input>
					<input type="checkbox" name="idiomas[]" value="4" <?php if (comparar(4,$_SESSION['id_user'])){ ?> checked <?php } ?> >Alemán</input>
					<input type="checkbox" name="idiomas[]" value="5" <?php if (comparar(5,$_SESSION['id_user'])){ ?> checked <?php } ?> >Otro</input>
				</div>

				<div class="form-group">
					<label for="progs">Que programas domina/conoce:</label>
					<textarea name="progs" id="progs" rows="4" cols="40" value=""></textarea><br>
				</div>

				<input type="button" name="previous" class="previous-form btn btn-default" value="Atras" />
				<input type="button" name="next" class="next-form btn btn-info" value="Siguiente" />
			</fieldset>
			<!-- ----------------------------------------------------------------------------------------------------------------------------->
			<fieldset>
				<h2> Preferencias laborales</h2>

				<div class="form-group">
					<label for="slaboral">Situacion actual:</label>
					<select id="slaboral" name="slaboral" value="">
						<option id="s1" value=""></option>
						<option id="s2" value=1>Disponible</option>
						<option id="s3" value=0>Ocupado</option>
					</select>
				</div>

				<div class="form-group">
					<label for="pdeseado">Puesto de trabajo deseado:</label>
					<input type="text" id="puestodeseado" name="pdeseado" value="">
				</div>
				<label for="">Area:</label>
				<input type="text" id="area" name="area" value="">

				<div class="form-group">
					<label for="sma">Salaro minimo aceptado:</label>
					<input type="number" id="salariomin" name="sma" value="">
				</div>

				<div class="form-group">
					<label for="dcr">Disponibilidad para viajar:</label>
					<input type="radio" id="dvsi" name="dv" value=1>Si
					<input type="radio" id="dvno" name="dv" value=0>No
				</div>

				<div class="form-group">
					<label for="dcr">Disponibilidad para cambio de residencia:</label>
					<input type="radio" id="dcsi" name="dcr" value=1>Si
					<input type="radio" id="dcno" name="dcr" value=0>No
				</div>

				<input type="button" name="previous" class="previous-form btn btn-default" value="Atras" />
				<input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
			</fieldset>

		</form>
	</div>
</body>

</html>
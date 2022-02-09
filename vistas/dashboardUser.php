<?php
session_start();
require('../db/conexionDb.php');
include('../db/idiomas.php');

if (isset($_SESSION['id_user']) && isset($_SESSION['id_rol'])) {
	$sql = 'SELECT idrol from roles where descripcion = "Usuario"';
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

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../assets/css/styleUser.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<title>DashboardUser</title>
</head>

<body>
	<style type="text/css">
		#register_form fieldset:not(:first-of-type) {
			display: none;
		}
	</style>

	<header id="head">
		<div class="logo">
			<a href="#" class="logo__link">
				<img src="http://www.iaes.edu.ar/wp-content/uploads/2014/08/logo-top-1.png" alt="Logo del IAES" />
			</a>
		</div>
		<nav class="nav">
			<a href="../db/logout.php" class="nav__link">Salir</a>
		</nav>
	</header>

	<div class="container">		
		<h2 align="center">Informacion del usuario:</h2>

		<div class="progress">
			<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
		</div>

		<div class="alert alert-success hide"></div>

		<?php $iduser = $_SESSION['id_user']; ?>
		<form enctype="multipart/form-data" id="register_form" novalidate action="../db/multi_form_action.php" method="post">

			<input type="hidden" id="iduser" value="<?php echo $_SESSION['id_user']; ?>">
			<!-- ----------------------------------------------------------------------------------------------------------------------------->
			<fieldset>

				<h2>Datos personales:</h2>

				<div class="form-group">
					<label for="usuario">Nombre:</label>
					<input type="text" class="form-control" id="usuario" name="usuario" maxlength="50">
				</div>

				<div class="form-group">
					<label for="apellido">Apellido:</label>
					<input type="text" class="form-control" id="apellido" name="apellido" maxlength="50">
				</div>

				<div class="form-group">
					<label for="dni">Numero documento:</label>
					<input type="number" class="form-control" id="dni" name="dni" maxlength="8">
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email" name="email" maxlength="100">
				</div>

				<div class="form-group">
					<label for="fechanacimiento">Fecha de nacimiento:</label>
					<input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" value="" min="1900/01/01" max="<?php echo date('Y-m-d') ?>">
				</div>


				<div class="form-group">
					<label for="genero">Genero:</label>
					<input type="radio" id="g1" name="genero" value="2">Mujer
					<input type="radio" id="g2" name="genero" value="1">Hombre
					<input type="radio" id="g3" name="genero" value="3">No binario
					<input type="radio" id="g4" name="genero" value="4">Otro
				</div>

				<div class="form-group">
					<label for="ecivil">Estado civil:</label>
					<select id="ecivil" name="ecivil">
						<option id="e1" value="1"></option>
						<option id="e2" value="2">Soltero</option>
						<option id="e3" value="3">Casado</option>
					</select>
				</div>

				<div class="form-group">
					<label for="contacto">Telefono:</label>
					<input type="tel" class="form-control" id="contacto" name="contacto" maxlength="30">
				</div>

				<div class="form-group">
					<label for="domicilio">Domicilio:</label>
					<input type="text" class="form-control" id="domicilio" name="domicilio" maxlength="100">
				</div>

				<table>
					<tr>
						<th>Localidad</th>
					</tr>
					<tr>
						<td>
							<select name="localidad" id="localidad" class="form-control">
								<option value=""></option>
								<?php
								include '../db/conexionDb.php';

								$sql2 = "SELECT localidad.localidad AS locnom, usuario.localidad AS usloc FROM usuario, localidad WHERE usuario.iduser='$iduser' AND localidad.idloc = usuario.localidad";
								$usloc = mysqli_query($conexion, $sql2);
								if (mysqli_num_rows($usloc) != 0) {
									$fila = $usloc->fetch_assoc();
									$usloc = $fila['usloc'];
									$locnom = $fila['locnom'];
									echo "<option value=$usloc selected>$locnom</option>";
								}

								$sql = "SELECT * FROM localidad";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									if ($fila['idloc'] != $usloc) {
										$localidad = $fila['idloc'];
										$nombre = $fila['localidad'];
										echo "<option value=$localidad>$nombre</option>";
									}
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
							<select name="departamento" id="departamento" class="form-control">
								<option value=""></option>
								<?php
								include '../db/conexionDb.php';


								$sql2 = "SELECT departamento.departamento AS depnom, usuario.departamento AS usdep FROM usuario, departamento WHERE usuario.iduser='$iduser' AND departamento.idep = usuario.departamento";
								$usdep = mysqli_query($conexion, $sql2);
								if (mysqli_num_rows($usdep) != 0) {
									$fila = $usdep->fetch_assoc();
									$usdep = $fila['usdep'];
									$depnom = $fila['depnom'];
									echo "<option value=$usdep selected>$depnom</option>";
								}


								$sql = "SELECT * FROM departamento";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									if ($fila['idep'] != $usdep) {
										$id = $fila['idep'];
										$nombre = $fila['departamento'];
										echo "<option value=$id>$nombre</option>";
									}
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
							<select name="provincia" id="provincia" class="form-control">
								<option value=""></option>
								<?php
								include '../db/conexionDb.php';


								$sql2 = "SELECT provincia.provincia AS provnom, usuario.provincia AS usprov FROM usuario, provincia WHERE idlog='$iduser' AND provincia.idpro = usuario.provincia";
								$usprov = mysqli_query($conexion, $sql2);
								if (mysqli_num_rows($usprov) != 0) {
									$fila = $usprov->fetch_assoc();
									$usprov = $fila['usprov'];
									$provnom = $fila['provnom'];
									echo "<option value=$usprov selected>$provnom</option>";
								}

								$sql = "SELECT * FROM provincia";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									if ($fila['idpro'] != $usprov) {
										$id = $fila['idpro'];
										$nombre = $fila['provincia'];
										echo "<option value=$id>$nombre</option>";
									}
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
							<select name="pais" id="pais" class="form-control">
								<option value=""></option>
								<?php
								include '../db/conexionDb.php';


								$sql2 = "SELECT pais.pais AS paisnom, usuario.idpais AS uspais FROM usuario, pais WHERE usuario.idloc='$iduser' AND pais.idpais = usuario.idpais";
								$uspais = mysqli_query($conexion, $sql2);
								if (mysqli_num_rows($uspais) != 0) {
									$fila = $uspais->fetch_assoc();
									$uspais = $fila['uspais'];
									$paisnom = $fila['paisnom'];
									echo "<option value=$uspais selected>$paisnom</option>";
								}



								$sql = "SELECT * FROM pais";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									if ($fila['idpais'] != $uspais) {
										$idpais = $fila['idpais'];
										$nombre = $fila['pais'];
										echo "<option value = $idpais >$nombre</option>";
									}
								}
								?>
							</select>
						</td>
					</tr>
				</table>



				<div class="form-group">
					<label for="licencia">Licencia de conducir:</label>
					<input type="radio" name="licencia" value="2" id="licsi">Si
					<input type="radio" name="licencia" value="1" id="licno">No
				</div>

				<div id="auto" class="form-group" style="display:none">
					<label for="auto">Dispone de vehiculo propio:</label>
					<input id="vsi" type="radio" name="auto" value="2">Si
					<input id="vno" type="radio" name="auto" value="1">No
				</div>

				<div class="form-group">
					<label for="discapacidades">Especifique su discapacidad:</label>
					<textarea id="discapacidades" name="detdiscapacidad" rows="5" cols="40" maxlength="200"></textarea>
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
					<label for="carh">Carreras hechas:</label>
					<select id="carh" name="carh" value="">
						<option id="c1" value=""></option>
						<option id="c2" value="1">Analistas de Sistemas</option>
						<option id="c3" value="2">Turismo y Gestion Hotelera</option>
						<option id="c4" value="3">Administración de Empresas</option>
						<option id="c5" value="4">Régimen Aduanero</option>
					</select>
				</div>
				<div class="form-group">
					<label for="cursos">Cursos realizados:</label>
					<textarea name="cursos" id="cursos" rows="5" cols="40" maxlength="200"></textarea>
				</div>

				<input type="button" name="previous" class="previous-form btn btn-default" value="Atras" />
				<input type="button" name="next" class="next-form btn btn-info" value="Siguiente" />
			</fieldset>
			<!-- ----------------------------------------------------------------------------------------------------------------------------->
			<fieldset>
				<h2> Experiencias laborales</h2>

				<div class="form-group">
					<a href="formexp.php" target="_blank" class="btn btn-primary stretched-link">Cargar experiencias<br></a>
				</div>

				<input type="button" name="previous" class="previous-form btn btn-default" value="Atras" />
				<input type="button" name="next" class="next-form btn btn-info" value="Siguiente" />
			</fieldset>


			<fieldset>
				<h2> Conocimientos y habilidades</h2>

				<div class="form-group">
					<label for=""> Idiomas:</label>
					<input type="checkbox" name="idiomas[]" value="1" <?php if (comparar(1, $_SESSION['id_user'])) { ?> checked <?php } ?>>Inglés</input>
					<input type="checkbox" name="idiomas[]" value="2" <?php if (comparar(2, $_SESSION['id_user'])) { ?> checked <?php } ?>>Español</input>
					<input type="checkbox" name="idiomas[]" value="3" <?php if (comparar(3, $_SESSION['id_user'])) { ?> checked <?php } ?>>Portugues</input>
					<input type="checkbox" name="idiomas[]" value="4" <?php if (comparar(4, $_SESSION['id_user'])) { ?> checked <?php } ?>>Francés</input>
					<input type="checkbox" name="idiomas[]" value="5" <?php if (comparar(5, $_SESSION['id_user'])) { ?> checked <?php } ?>>Alemán</input>
					<input type="checkbox" name="idiomas[]" value="6" <?php if (comparar(6, $_SESSION['id_user'])) { ?> checked <?php } ?>>Guarani</input>
				</div>

				<div class="form-group">
					<label for="progs">Que programas domina/conoce:</label>
					<textarea name="progs" id="progs" rows="4" cols="40" placeholder="Word, Excel, Visual studio code" maxlength="200"></textarea><br>
				</div>

				<div class="form-group">
					<label for="habilidades">Habilidades:</label>
					<textarea name="habilidades" id="habilidades" rows="4" cols="40" placeholder="Dar la vuelta cambota" maxlength="200"></textarea><br>
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
						<option id="s2" value=2>Disponible</option>
						<option id="s3" value=1>Ocupado</option>
					</select>
				</div>

				<div class="form-group">
					<label for="area">Area:</label>
					<select id="area" name="area">
						<option id="s1" value=""></option>
						<option id="s2" value="direccion">Direccion</option>
						<option id="s3" value="recursos humanos">Recursos humanos</option>
						<option id="s4" value="finanzas o contabilidad">Finanzas o contabilidad</option>
						<option id="s5" value="marketing y ventas">Marketing y ventas</option>
						<option id="s6" value="tecnología">Tecnología</option>
						<option id="s7" value="producción">Producción</option>
						<option id="s8" value="servicio al cliente">Servicio al cliente</option>
					</select>
				</div>

				<div class="form-group">
					<label for="modalidad">Modalidad:</label>
					<select id="modalidad" name="modalidad">
						<option id="m0" value=""></option>
						<option id="m1" value=1>Full-time</option>
						<option id="m2" value=2>Part-time</option>
						<option id="m3" value=3>Trainee</option>
						<option id="m4" value=4>Pasantias</option>
						<option id="m5" value=5>Sin preferencia</option>
					</select>
				</div>

				<div class="form-group">
					<label for="sma">Salaro minimo aceptado:</label>
					<input type="number" id="salariomin" name="sma" maxlength="8">
				</div>

				<div class="form-group">
					<label for="dcr">Disponibilidad para viajar:</label>
					<input type="radio" id="dvsi" name="dv" value=2>Si
					<input type="radio" id="dvno" name="dv" value=1>No
				</div>

				<div class="form-group">
					<label for="dcr">Disponibilidad para cambio de residencia:</label>
					<input type="radio" id="dcsi" name="dcr" value=2>Si
					<input type="radio" id="dcno" name="dcr" value=1>No
				</div>

				<input type="button" name="previous" class="previous-form btn btn-default" value="Atras" />
				<input type="submit" name="submit" class="submit btn btn-success" value="Enviar" />
			</fieldset>

		</form>
	</div>

	<script type="text/javascript" src="../assets/js/form.js"></script>
	<script type="text/javascript" src="../assets/js/input.js"></script>
</body>

</html>
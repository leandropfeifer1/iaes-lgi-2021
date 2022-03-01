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

<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit-no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../assets/css/styleUser.css">
	<link rel="stylesheet" href="../plugins/sweetalert/sweetalert2.min.css">

	<title>DashboardUser</title>
</head>

<body>

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
		<form enctype="multipart/form-data" id="register_form" name="register_form" action="" method="post">

			<input type="hidden" id="iduser" value="<?php echo $_SESSION['id_user']; ?>">
			<!-- ----------------------------------------------------------------------------------------------------------------------------->

			<fieldset class="personales">
			<legend>Datos personales:</legend>				

				<div class="form-group">
					<label for="usuario">Nombre:</label>
					<input type="text" class="form-control" id="usuario" name="usuario" maxlength="50">
					<span id="error_usuario" class="text-danger"></span>
				</div>

				<div class="form-group">
					<label for="apellido">Apellido:</label>
					<input type="text" class="form-control" id="apellido" name="apellido" maxlength="50">
					<span id="error_apellido" class="text-danger"></span>
				</div>

				<div class="form-group">
					<label for="dni">Numero documento:</label>
					<input type="number" class="form-control" id="dni" name="dni" maxlength="8">
					<span id="error_dni" class="text-danger"></span>
				</div>

				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" class="form-control" id="email" name="email" maxlength="100">
					<span id="error_email" class="text-danger"></span>
				</div>

				<div class="form-group">
					<label for="fechanacimiento">Fecha de nacimiento:</label>
					<input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento">
					<span id="error_fechanacimiento" class="text-danger"></span>
				</div>


				<div class="form-group">
					<label for="genero">Genero:</label>
					<input type="radio" class="genero" id="g2" name="genero" value="1">Hombre
					<input type="radio" class="genero" id="g1" name="genero" value="2">Mujer
					<input type="radio" class="genero" id="g3" name="genero" value="3">No binario
					<input type="radio" class="genero" id="g4" name="genero" value="4">Otro  <span id="error_genero" class="text-danger"></span><br>
					
				</div>

				<div class="form-group">
					<label for="ecivil">Estado civil:</label>
					<select id="ecivil" name="ecivil">
						<option id="e1" value="1"></option>
						<option id="e2" value="2">Soltero</option>
						<option id="e3" value="3">Casado</option>
					</select>
					<span id="error_ecivil" class="text-danger"></span>
				</div>

				<div class="form-group">
					<label for="contacto">Telefono:</label>
					<input type="number" class="form-control" id="contacto" name="contacto" maxlength="30">
					<span id="error_contacto" class="text-danger"></span>
				</div>

				<div class="form-group">
					<label for="domicilio">Domicilio:</label>
					<input type="text" class="form-control" id="domicilio" name="domicilio" maxlength="100">
					<span id="error_domicilio" class="text-danger"></span>
				</div>

				<div class="form-group">
					<td>
						<label for="localidad">Localidad:</label>
						<select name="localidad" id="localidad" class="form-control">
							<option value=""></option>
							<?php
							include '../db/conexionDb.php';

							$sql2 = "SELECT localidad.localidad AS locnom, usuario.localidad AS usloc FROM usuario, localidad WHERE usuario.idloc='$iduser' AND localidad.idloc = usuario.localidad";
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
						<span id="error_localidad" class="text-danger"></span>
					</td>
				</div>

				<div class="form-group">

					<tr>
						<td>
							<label for="departamento">Departamento:</label>
							<select name="departamento" id="departamento" class="form-control">
								<option value=""></option>
								<?php
								include '../db/conexionDb.php';


								$sql2 = "SELECT departamento.departamento AS depnom, usuario.departamento AS usdep FROM usuario, departamento WHERE usuario.idloc='$iduser' AND departamento.idep = usuario.departamento";
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
							<span id="error_departamento" class="text-danger"></span>
						</td>
					</tr>
				</div>

				<div class="form-group">

					<tr>
						<td>
							<label for="provincia">Provincia:</label>
							<select name="provincia" id="provincia" class="form-control">
								<option value=""></option>
								<?php
								include '../db/conexionDb.php';


								$sql2 = "SELECT provincia.provincia AS provnom, usuario.provincia AS usprov FROM usuario, provincia WHERE usuario.idloc='$iduser' AND provincia.idpro = usuario.provincia";
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
							<span id="error_provincia" class="text-danger"></span>
						</td>
					</tr>
				</div>

				<div class="form-group">
					<tr>
						<td>
							<label for="pais">Pais:</label>
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
							<span id="error_pais" class="text-danger"></span>
						</td>
					</tr>
				</div>



				<div class="form-group">
					<label for="licencia">Licencia de conducir:</label>
					<input type="radio" class="licencia" name="licencia" value="2" id="licsi">Si
					<input type="radio" class="licencia" name="licencia" value="1" id="licno">No
					<span id="error_licencia" class="text-danger"></span>
				</div>

				<div id="auto" class="form-group" style="display:none">
					<label for="auto">Dispone de vehiculo propio:</label>
					<input id="vsi" type="radio" class="auto" name="auto" value="2">Si
					<input id="vno" type="radio" class="auto" name="auto" value="1">No
					<span id="error_auto" class="text-danger"></span>
				</div>

				<div class="form-group">
					<label for="discapacidades">Especifique su discapacidad (si tiene):</label>
					<textarea class="form-control" id="discapacidades" name="discapacidades" rows="5" cols="40" maxlength="200"></textarea>
				</div>

				<div class="form-group">
					<label for="foto">Sube tu foto:</label>
					<input type="file" id="foto" name="foto" accept="image/*" class="form-control">
				</div>

				<div class="form-group">
					<label for="pdf">CV: </label>
					<input type="hidden" name="MAX_FILE_SIZE" value="512000000">
					<input type="file" id="pdf" class="form-control" name="pdf" accept="aplicaction/pdf">
				</div>

				<input type="button" id="sig1" class="next-form btn btn-info" value="Siguiente" /><span id="error" class="text-danger"></span><br><br>

			</fieldset>
			<!-- ----------------------------------------------------------------------------------------------------------------------------->
			<fieldset class="academicos">
			<legend>Datos Academicos:</legend>
				<div class="form-group">
					<label for="carh">Carrera hechas:</label>
					<select id="carh" name="carh" value="">
						<option id="c1" value=""></option>
						<option id="c2" value="1">Analistas de Sistemas</option>
						<option id="c3" value="2">Turismo y Gestion Hotelera</option>
						<option id="c4" value="3">Administración de Empresas</option>
						<option id="c5" value="4">Régimen Aduanero</option><br>
					</select>
					<span id="error_carh" class="text-danger"></span>

				</div>
				<div class="form-group">
					<label for="cursos">Cursos realizados:</label>
					<textarea name="cursos" id="cursos" rows="5" cols="40" maxlength="200"></textarea>
				</div>

				<input type="button" id="atras1" name="previous" class="previous-form btn btn-default" value="Atras" />
				<input type="button" id="sig2" name="next" class="next-form btn btn-info" value="Siguiente" /><span id="error2" class="text-danger"></span><br><br>

			</fieldset>



			<!-- ----------------------------------------------------------------------------------------------------------------------------->
			<fieldset>
			<legend>Experiencias laborales:</legend>
				<div class="form-group">
					<a href="formexp.php" target="_blank" class="btn btn-primary stretched-link">Ir a Experiencias<br></a>
				</div>
				<input type="button" id="atras" name="previous" class="previous-form btn btn-default" value="Atras" />
				<input type="button" id="sig3" name="next" class="next-form btn btn-info" value="Siguiente" />
			</fieldset>

			<!-- ----------------------------------------------------------------------------------------------------------------------------->
			<fieldset class="habilidades">
			<legend>Conocimientos y habilidades:</legend>
				<div class="form-group" id="idiomas">
					<label for=""> Idiomas:</label>
					<input type="checkbox" class="idiomas" name="idiomas" value="1" <?php if (comparar(1, $_SESSION['id_user'])) { ?> checked <?php } ?>>Inglés</input>
					<input type="checkbox" class="idiomas" name="idiomas" value="2" <?php if (comparar(2, $_SESSION['id_user'])) { ?> checked <?php } ?>>Español</input>
					<input type="checkbox" class="idiomas" name="idiomas" value="3" <?php if (comparar(3, $_SESSION['id_user'])) { ?> checked <?php } ?>>Portugues</input>
					<input type="checkbox" class="idiomas" name="idiomas" value="4" <?php if (comparar(4, $_SESSION['id_user'])) { ?> checked <?php } ?>>Francés</input>
					<input type="checkbox" class="idiomas" name="idiomas" value="5" <?php if (comparar(5, $_SESSION['id_user'])) { ?> checked <?php } ?>>Alemán</input>
					<input type="checkbox" class="idiomas" name="idiomas" value="6" <?php if (comparar(6, $_SESSION['id_user'])) { ?> checked <?php } ?>>Guarani</input><br>
					<span id="error_idiomas" class="text-danger"></span>
				</div>


				<div class="form-group">
					<label for="progs">Que programas domina/conoce:</label>
					<textarea name="progs" id="progs" rows="4" cols="40" placeholder="Word, Excel, Visual studio code" maxlength="200"></textarea><br>
				</div>

				<div class="form-group">
					<label for="habilidades">Habilidades:</label>
					<textarea name="habilidades" id="habilidades" rows="4" cols="40" placeholder="Dar la vuelta cambota" maxlength="200"></textarea><br>
				</div>

				<input type="button" id="atras2" name="previous" class="previous-form btn btn-default" value="Atras" />
				<input type="button" id="sig4" name="next" class="next-form btn btn-info" value="Siguiente" /><span id="error3" class="text-danger"></span><br><br>
			</fieldset>
			<!-- ----------------------------------------------------------------------------------------------------------------------------->
			<fieldset class="laborales">
			<legend>Preferencias laborales:</legend>

				<div class="form-group">
					<label for="slaboral">Situacion actual:</label>
					<select id="slaboral" name="slaboral" value="">
						<option id="s1" value=""></option>		
						<option id="s2" value=1>Disponible</option>				
						<option id="s3" value=2>Ocupado</option>
						
					</select>
					<span id="error_slaboral" class="text-danger"></span>
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
					<span id="error_area" class="text-danger"></span>
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
					<span id="error_modalidad" class="text-danger"></span>
				</div>

				<div class="form-group">
					<label for="salariomin">Salaro minimo aceptado:</label>
					<input type="number" id="salariomin" name="salariomin" maxlength="8">
					<span id="error_salariomin" class="text-danger"></span>
				</div>

				<div class="form-group">
					<label for="dv">Disponibilidad para viajar:</label>
					<input type="radio" class="dv" id="dvsi" name="dv" value=2>Si
					<input type="radio" class="dv" id="dvno" name="dv" value=1>No
					<span id="error_dv" class="text-danger"></span>
				</div>

				<div class="form-group">
					<label for="dcr">Disponibilidad para cambio de residencia:</label>
					<input type="radio" class="dcr" id="dcsi" name="dcr" value=2>Si
					<input type="radio" class="dcr" id="dcno" name="dcr" value=1>No
					<span id="error_dcr" class="text-danger"></span>
				</div>

				<input type="button" id="atras" name="previous" class="previous-form btn btn-default" value="Atras" />
				<input type="submit" name="submit" class="submit btn btn-success" value="Enviar" /><span id="error4" class="text-danger"></span><br><br>
			</fieldset>

		</form>
	</div>

	<script src="../jquery/jquery-3.6.0.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../popper/popper.min.js"></script>
	<script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/form.js"></script>
	<script type="text/javascript" src="../assets/js/input.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>
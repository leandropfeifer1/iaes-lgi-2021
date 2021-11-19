<?php
include('header.php');
require('../db/conexionDb.php');
session_start();


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
	//mysqli_close($conexion);
} else {
	header('location: ../logout.php');
}
?>


<div class="container">

	<div class="row well alert alert-success">
		<?php

		function validarString($dato)
		{
			$result = "";
			if (isset($dato) and !empty($dato)) {
				$result = $dato;
			} else {
				$result = "";
			}
			return $result;
		}
		function validarNum($dato)
		{
			$result = "";
			if (isset($dato) and !empty($dato)) {
				$result = $dato;
			} else {
				$result = 0;
			}
			return $result;
		};

		if (isset($_POST['submit'])) {

			$update = false;
			$iduser = null;
			$idloc = $_SESSION['id_user'];
			$usuario = validarString($_POST["usuario"]);
			$apellido = validarString($_POST["apellido"]);
			$fechanacimiento = validarString($_POST["fechanacimiento"]);
			/*if (isset($_POST["fechanacimiento"])) {
				$fechanacimiento = $_POST["fechanacimiento"];
			} else {
				$fechanacimiento = "dd/mm/aaaa";
			}*/


			$dni = validarNum($_POST["dni"]);
			//$genero = $_POST["genero"];

			if (isset($_POST["genero"])) {
				$genero = $_POST["genero"];
			} else {
				$genero = "";
			}


			$discapacidades = validarString($_POST["discapacidades"]);
			$ecivil = validarString($_POST["ecivil"]);
			$correo =  validarString($_POST["email"]);
			$contacto = validarString($_POST["contacto"]);
			$codpostal = validarNum($_POST["codpostal"]);
			$domicilio = validarString($_POST["domicilio"]);
			$localidad = validarNum($_POST["localidad"]);
			$departamento = validarNum($_POST["departamento"]);
			$provincia = validarNum($_POST["provincia"]);
			$idpais = validarNum($_POST["pais"]);
			$cursos = validarString($_POST["cursos"]);
			$puestodeseado = validarString($_POST["pdeseado"]);
			$situacionlab = validarNum($_POST["slaboral"]);
			$area = validarString($_POST["area"]);
			$salariomin	= validarNum($_POST["sma"]);

			if (isset($_FILES["pdf"])) {
				$pdf = $_FILES['pdf']['name'];
				$temp = $_FILES['pdf']['tmp_name'];
				move_uploaded_file($temp, 'cv/' . $pdf);
			} else {
				$pdf = NULL;
			}

			//$licencia = validarNum($_POST["licencia"]);

			if (isset($_POST["licencia"])) {
				$licencia = $_POST["licencia"];
			} else {
				$licencia = 0;
			}

			//$auto = validarNum($_POST["auto"]);

			if (isset($_POST["auto"])) {
				$auto = $_POST["auto"];
			} else {
				$auto = 0;
			}


			if (isset($_POST["idiomas"])) {
				$idiomas = $_POST["idiomas"];
				echo $iduser;
				//Trae los idiomas guardados del usuario segun id usuario
				$datos = mysqli_query($conexion, "SELECT idi FROM idioxuser WHERE iduser='$iduser'");
				//$rowcount=mysqli_num_rows($datos);	

				//comprueba si no hay idiomas guardados
				if (mysqli_num_rows($datos) == 0) {
					//se guardan los idiomas ingresados
					for ($y = 0; $y < count($idiomas); $y++) {
						$aux = $idiomas[$y];
						$x = mysqli_query($conexion, "INSERT INTO idioxuser (iduser, idi) VALUES ('$iduser','$aux')");
					}
				} else {
					$b = 0;
					// For de los idiomas ingresados  
					for ($y = 0; $y < count($idiomas); $y++) {
						//For de los idiomas guardados
						while ($fila = mysqli_fetch_row($datos)) {
							//Busca en los registro si ya existe el idioma a cargar	
							if ($idiomas[$y] == $fila[0]) {
								//variable que indica que si existe el idioma en bd
								$b = 1;
							}
						}
						$datos = mysqli_query($conexion, "SELECT idi FROM idioxuser WHERE iduser='$iduser'");
						if ($b == 0) {
							//el idioma no esta cargado y procede a insertarse 
							$aux = $idiomas[$y];
							$x = mysqli_query($conexion, "INSERT INTO idioxuser (iduser, idi) VALUES ('$iduser','$aux')");
						} else {
							//el idioma si existe y restable el valor de b 
							$b = 0;
						}
					}
				}
			}
			//$dispoviajar = validarNum($_POST["dv"]);


			if (isset($_POST["dv"])) {
				$dispoviajar = $_POST["dv"];
			} else {
				$dispoviajar = 0;
			}

			//$dispomuda = validarNum($_POST["dcr"]);


			if (isset($_POST["dcr"])) {
				$dispomuda = $_POST["dcr"];
			} else {
				$dispomuda = 0;
			}

			$progs = validarString($_POST["progs"]);

			if (isset($_POST["neducativo"])) {
				$niveledu = $_POST["neducativo"];
			} else {
				$niveledu = "";
			}

			//no recibe foto con metodo $_FILES
			if (isset($_POST["foto"])) {
				/*
				echo "entroo" ;
				$b = 1;*/
				$foto = $_POST['foto'];/*
				echo $foto;
				echo $foto['name'];
				$temp = $_POST['foto']['tmp_name'];
				move_uploaded_file($temp, 'images/' . $foto);
				*/
			} else {
				$foto = NULL;
			}

			/*INSERT INTO `usuario`(`iduser`, `usuario`, `apellido`, `fechanacimiento`, `dni`, `genero`, `discapacidades`, `ecivil`, `correo`, `contacto`, `codpostal`, `domicilio`, `localidad`, `departamento`, `provincia`, `idpais`, ***`idlog`, ***`lastlogin`, `cursos`, `pdf`, `licencia`, `auto`, `situacionlab`, `area`, `salariomin`, `dispoviajar`, `dispomuda`, `progs`, `foto`, `niveledu`, `puestodeseado`)*/
			/* 
			if (mysqli_query($conexion, "INSERT INTO `usuario`(`usuario`, `apellido`, `fechanacimiento`, `dni`, `genero`, `discapacidades`, `ecivil`, `correo`, `contacto`, `codpostal`, `domicilio`, `localidad`, `departamento`, `provincia`, `idpais`, `cursos`, `pdf`, `licencia`, `auto`, `situacionlab`, `area`, `salariomin`, `dispoviajar`, `dispomuda`, `progs`, `foto`, `niveledu`, `puestodeseado`) 
													VALUES ('$usuario', '$apellido', '$fechanacimiento','$dni','$genero', '$discapacidades','$ecivil','$correo', '$contacto','$codpostal','$domicilio', '$localidad', '$departamento','$provincia','$idpais', '$cursos', '$pdf','$licencia','$auto', '$situacionlab', '$area','$salariomin','$dispoviajar','$dispomuda', '$progs', '$foto','$niveledu','$puestodeseado')")) {
				echo "You're Registered Successfully!";
			} else {
				echo "Error in registering...Please try again later!";
			}*/


			// Variable id del usuario

			if (empty($y = mysqli_query($conexion, "SELECT iduser FROM usuario WHERE idlog='$idloc'"))) {

				if (mysqli_query($conexion, "INSERT INTO `usuario`(`usuario`, `apellido`, `fechanacimiento`, `dni`, `genero`, `ecivil`, `correo`, `contacto`, `codpostal`, `domicilio`, `localidad`, `departamento`, `provincia`, `idpais`, `cursos`, `pdf`, `licencia`, `auto`, `situacionlab`, `area`, `salariomin`, `dispoviajar`, `dispomuda`, `progs`, `foto`, `niveledu`, `puestodeseado`,`idlog`) 
				VALUES ('$usuario', '$apellido', '$fechanacimiento','$dni','$genero','$ecivil','$correo', '$contacto','$codpostal','$domicilio', '$localidad', '$departamento','$provincia','$idpais', '$cursos', '$pdf','$licencia','$auto', '$situacionlab', '$area','$salariomin','$dispoviajar','$dispomuda', '$progs', '$foto','$niveledu','$puestodeseado','$idloc')")) {
					echo "You're Registered Successfully!";
				} else {
					echo "Error in registering...Please try again later!";
				}
			} else {
				if (mysqli_query($conexion, "UPDATE `usuario` SET `usuario`='$usuario', `apellido`='$apellido', `fechanacimiento`='$fechanacimiento', `dni`='$dni', `genero`='$genero', `ecivil`='$ecivil', `correo`='$correo', `contacto`='$contacto', `codpostal`='$codpostal', `domicilio`='$domicilio', `localidad`='$localidad', `departamento`='$departamento', `provincia`='$provincia', `idpais`='$idpais', `cursos`='$cursos', `pdf`='$pdf', `licencia`='$licencia', `auto`='$auto', `situacionlab`='$situacionlab', `area`='$area', `salariomin`='$salariomin', `dispoviajar`='$dispoviajar', `dispomuda`='$dispomuda', `progs`='$progs', `foto`='$foto', `niveledu`='$niveledu', `puestodeseado`='$puestodeseado' WHERE idlog='$idloc'")) {

					echo "registro actualizado!";
				} else {
					echo "error en actualizar";
				}
			}
		}

		?>
	</div>

</div>
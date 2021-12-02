<?php
include('../php/header.php');
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

			$discapacidades = validarString($_POST["detdiscapacidad"]);
			//echo $_POST["discapacidad"];
			//$discapacidad = $_POST["discapacidad"];
			$ecivil = $_POST["ecivil"];
			$correo =  validarString($_POST["email"]);
			$contacto = validarString($_POST["contacto"]);
			//$codpostal = validarNum($_POST["codpostal"]);
			$domicilio = validarString($_POST["domicilio"]);
			$localidad = validarNum($_POST["localidad"]);
			$departamento = validarNum($_POST["departamento"]);
			$provincia = validarNum($_POST["provincia"]);
			$idpais = validarNum($_POST["pais"]);
			$cursos = validarString($_POST["cursos"]);
			//$puestodeseado = validarString($_POST["pdeseado"]);
			$situacionlab = validarNum($_POST["slaboral"]);
			$area = $_POST["area"];
			$salariomin	= validarNum($_POST["sma"]);
			$modalidad	= $_POST["modalidad"];
			$habilidades = validarString($_POST["habilidades"]);
			//$lastlogin = "2021-11-21 01:30:11";

			/*if (isset($_FILES["pdf"])) {
				$pdf = $_FILES['pdf']['name'];
				$temp = $_FILES['pdf']['tmp_name'];
				move_uploaded_file($temp, 'cv/' . $pdf);
			} else {
				$pdf = NULL;
			}*/

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

			if (isset($_POST["carh"])) {
				$carrera = $_POST["carh"];
			} else {
				$carrera = 0;
			}



			if (isset($_POST["idiomas"])) {
				$idiomas = $_POST["idiomas"];
				//Trae los idiomas guardados del usuario segun id usuario
				$datos = mysqli_query($conexion, "SELECT idi FROM idioxuser WHERE iduser='$idloc'");

				//comprueba si no hay idiomas guardados
				if (mysqli_num_rows($datos) == 0) {
					//se guardan los idiomas ingresados
					for ($y = 0; $y < count($idiomas); $y++) {
						$aux = $idiomas[$y];
						$x = mysqli_query($conexion, "INSERT INTO idioxuser (iduser, idi) VALUES ('$idloc','$aux')");
					}
				} else {
					$b = 0;
					// For de los idiomas ingresados  aca esta el problem
					for ($y = 0; $y < count($idiomas); $y++) {
						while ($fila = mysqli_fetch_row($datos)) {
							if ($idiomas[$y] == $fila[0]) {
								$b = 1;
							}
						}
						if ($b == 0) {
							$aux = $idiomas[$y];
							$x = mysqli_query($conexion, "INSERT INTO idioxuser (iduser, idi) VALUES ('$idloc','$aux')");
						} else {
							$b = 0;
							$datos = mysqli_query($conexion, "SELECT idi FROM idioxuser WHERE iduser='$idloc'");
						}
					}


					$datos = mysqli_query($conexion, "SELECT idi FROM idioxuser WHERE iduser='$idloc'");

					while ($fila = mysqli_fetch_row($datos)) {
						$b = 0;
						//For de los idiomas guardados
						for ($y = 0; $y < count($idiomas); $y++) {

							//Busca en los registro si ya existe el idioma a cargar	
							if ($idiomas[$y] == $fila[0]) {
								//variable que indica que si existe el idioma en bd
								$b = 1;
							}
						}
						if ($b != 1) {
							//el idioma no esta en marcado de los check y sera eliminado
							mysqli_query($conexion, "DELETE FROM `idioxuser` WHERE iduser='$idloc' AND idi='$fila[0]'");
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

			if (isset($_FILES["foto"]) && $_FILES["foto"]['name'] != '') {
				$fotobd = mysqli_query($conexion, "SELECT foto FROM usuario WHERE idloc='$idloc'");
				$row = mysqli_fetch_array($fotobd);

				if ($row[0]) {
					if (unlink('../db/images/' . $row[0])) {
						//echo "bien";
						// file was successfully deleted
					} else {
						//echo "mal";
						// there was a problem deleting the file
					}
				}

				$foto = $_FILES['foto']['name'];
				$temp = $_FILES['foto']['tmp_name'];
				if (move_uploaded_file($temp, "../db/images/" . $foto)) {
					//Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
					//chmod('images/' . $foto, 0777);
				} else {
					//echo "<br>no se guardo en carpeta<br>";
				}
			} else {
				$fotobd = mysqli_query($conexion, "SELECT foto FROM usuario WHERE idloc='$idloc'");
				$row = mysqli_fetch_array($fotobd);
				if($row[0]){
					$foto = $row[0];
				}else{
					$foto = NULL;
				}
				
			}

			if (isset($_FILES["pdf"]) && $_FILES["pdf"]['name'] != '') {
				
				$cvbd = mysqli_query($conexion, "SELECT pdf FROM usuario WHERE idloc='$idloc'");
				$rowcv = mysqli_fetch_array($cvbd);

				if ($rowcv[0]) {
					if (unlink('../db/cv/' . $rowcv[0])) {
						// file was successfully deleted
					} else {
						// there was a problem deleting the file
					}
				}
				//Si el archivo contiene algo y es diferente de vacio
				//Obtenemos algunos datos necesarios sobre el archivo
				//$tipo = $_FILES['pdf']['type'];
				//$tamano = $_FILES['pdf']['size'];
				$pdf = $_FILES['pdf']['name'];
				$temp = $_FILES['pdf']['tmp_name'];
				if (move_uploaded_file($temp, '../db/cv/' . $pdf)) {
					//Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
					//chmod('images/' . $pdf, 0777);
					//Mostramos el mensaje de que se ha subido co éxito
				} else {
					//echo "no se guardo en carpeta<br>";
				}
			} else {
				$cvbd = mysqli_query($conexion, "SELECT pdf FROM usuario WHERE idloc='$idloc'");
				$rowcv = mysqli_fetch_array($cvbd);

				if ($rowcv[0]) {
					$pdf = $rowcv[0];
				}else{
					$pdf = NULL;
				}
				
			}


			$y = mysqli_query($conexion, "SELECT * FROM usuario WHERE idloc='$idloc'");
			if (mysqli_num_rows($y) == 0) {
				//`usuario`, `apellido`, `fechanacimiento`, `dni`, `genero`, `discapacidades`, `correo`, `contacto`, `domicilio`, `localidad`, `departamento`, `provincia`, `idpais`, `idloc`, `lastlogin`, `cursos`, `pdf`, `licencia`, `auto`, `situacionlab`, `modalidad`, `area`, `salariomin`, `dispoviajar`, `dispomuda`, `habilidades`, `foto`
				if (mysqli_query($conexion, "INSERT INTO `usuario`(`usuario`, `apellido`, `fechanacimiento`, `dni`, `genero`, `discapacidades`, `correo`, `contacto`, `domicilio`, `localidad`, `departamento`, `provincia`, `idpais`, `idloc`, `cursos`, `pdf`, `licencia`, `auto`, `situacionlab`, `modalidad`, `area`, `salariomin`, `dispoviajar`, `dispomuda`, `habilidades`, `foto`,`progs`,`ecivil`) 
														VALUES ('$usuario', '$apellido', '$fechanacimiento','$dni','$genero','$discapacidades','$correo','$contacto','$domicilio','$localidad','$departamento','$provincia','$idpais','$idloc','$cursos','$pdf','$licencia','$auto','$situacionlab','$modalidad','$area','$salariomin','$dispoviajar','$dispomuda','$habilidades','$foto','$progs','$ecivil')")) {
					echo "Se registro correctamente!";
				} else {
					echo "Error en registrar... Por favor intentelo de nuevo!";
				}
			} else {
				if (mysqli_query($conexion, "UPDATE `usuario` SET `usuario`='$usuario',`apellido`='$apellido',`fechanacimiento`='$fechanacimiento',`dni`='$dni',`genero`='$genero',`discapacidades`='$discapacidades',`correo`='$correo',`contacto`='$contacto',`domicilio`='$domicilio',`localidad`='$localidad',`departamento`='$departamento',`provincia`='$provincia',`idpais`='$idpais',`idloc`='$idloc',`cursos`='$cursos',`pdf`='$pdf',`licencia`='$licencia',`auto`='$auto',`situacionlab`='$situacionlab',`modalidad`='$modalidad',`area`='$area',`salariomin`='$salariomin',`dispoviajar`='$dispoviajar',`dispomuda`='$dispomuda',`habilidades`='$habilidades',`foto`='$foto',`progs`='$progs',`ecivil`='$ecivil' WHERE idloc = $idloc")) {

					echo "Registro actualizado!";
				} else {
					echo "No se pudo actualizar";
				}
			}

			$x = mysqli_query($conexion, "SELECT * FROM carxuser WHERE iduser='$idloc'");
			if ($carrera != 0) {
				if (mysqli_num_rows($x) == 0) {
					if (mysqli_query($conexion, "INSERT INTO carxuser (iduser, idcar) VALUES ('$idloc','$carrera')")) {
						echo "Carrera actualizada";
					} else {
						echo "Error en guardar carrera!";
					}
				} else {
					if (mysqli_query($conexion, "UPDATE `carxuser` SET `idcar`='$carrera' WHERE iduser='$idloc'")) {
					} else {
						echo "error en actualizar carrera";
					}
				}
			} else {
				mysqli_query($conexion, "DELETE FROM `carxuser` WHERE iduser='$idloc'");
			}
		}

		?>
	</div>

</div>
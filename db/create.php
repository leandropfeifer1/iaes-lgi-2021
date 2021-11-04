<?php  include('conexionDb.php'); ?>
<?php  include('update.php'); ?>
<?php  include('test.php'); ?>
<?php  include('delete.php'); ?>
<?php include 'cv.php'?>


<?php 
		
	$empresa = "";
	$puesto = "";
	$desde = "";
	$hasta = "";
	$contacto = "";
	$iduser = "";
	$idempresa = "";
	$nombre = $apellido = $email = $numdoc = $fnacimiento = $gen = $ecivil = $tel = $skype = $pais = $region = $ciudad = $codpostal = $direccion = $nacionalidad = $lic = $vehic = $disc = $discesp = "";
	$foto = $neducativo=$cursos = $empresa= $puesto= $fdesde = $fhasta= $idiomas = $habs = $progs = $slaboral= $pdeseado=$area= $sma = $prov= $dv = $dcr = "";
	
	
	$id = 0;
	$update = false;
	
 //------------------------------------------------------------------------------------------------------------------------------->EXPERIENCIAS LABORALES
	if (isset($_POST['save1'])) {
		$empresa = test_input($_POST['empresa']);	
		$puesto = test_input($_POST['puesto']);
		$desde = test_input($_POST['desde']);
		$hasta = test_input($_POST['hasta']);
		$contacto = test_input($_POST['contacto']);
		$iduser = 8;
		$idempresa = 97;	
		
		$x = mysqli_query($db, "INSERT INTO experiencia (iduser, idempresa, empresa, puesto, desde, hasta, contacto) VALUES ('$iduser', '$idempresa','$empresa', '$puesto', '$desde', '$hasta', '$contacto')"); 		
		header('location: form_exp.php');
	}	
	
	//------------------------------------------------------------------------------------------------------------------------------->EMPRESA
	 
	 if(isset($_POST["save6"])){	
		$GLOBALS['update'] = true; 
		
		$empnombre = test_input($_POST["empnombre"]);  
		$rubro = test_input($_POST["rubro"]);
		$empdireccion = test_input($_POST["empdireccion"]);
		$empnumero = test_input($_POST["empnumero"]);  
		$empemail = test_input($_POST["empemail"]);
		$encargado = test_input($_POST["encargado"]);
		$empciudad = test_input($_POST["empciudad"]); 
		$id = $_POST["id"];
		$y = mysqli_query($db,"SELECT * FROM Empresas WHERE idempresa='$id'");
		if(mysqli_num_rows($y) == 0){
			$x = mysqli_query($db,"INSERT INTO Empresas (empresa, direccion) VALUES ('$empnombre','$empdireccion')");
		}else{
			$x = mysqli_query($db, "UPDATE Empresas SET empresa='$empnombre', direccion='$empdireccion' WHERE idempresa='$id'");
			}		
		header('location: form_empresa.php');	
	 }
	 
	 //------------------------------------------------------------------------------------------------------------------------------->ACADEMICOS
	
	if(isset($_POST["save2"])){	 
		$neducativo = test_input($_POST["neducativo"]);
		$cursos = test_input($_POST["cursos"]);
		
			// Variable id del usuario
		$id = $_POST["id"];
		$y = mysqli_query($db,"SELECT * FROM Empresas WHERE idempresa='$id'");
		if(mysqli_num_rows($y) == 0){
			$x = mysqli_query($db,"INSERT INTO  () VALUES ('$neducativo','$cursos')");
		}else{
			$x = mysqli_query($db, "UPDATE  SET WHERE id='$id'");
			}	
			
		header('location: form_academicos.php');			
	 }	 
	 //------------------------------------------------------------------------------------------------------------------------------->PREF LABORALES
    if(isset($_POST["save3"])){	 
		$slaboral = test_input($_POST["slaboral"]);
		$pdeseado = test_input($_POST["pdeseado"]);
		$area = test_input($_POST["area"]);
		$sma = test_input($_POST["sma"]);
		$dv = test_input($_POST["dv"]);
		$dcr = test_input($_POST["dcr"]);		
		
			// Variable id del usuario
		$id = $_POST["id"];
		$y = mysqli_query($db,"SELECT * FROM Empresas WHERE idempresa='$id'");
		if(mysqli_num_rows($y) == 0){
			$x = mysqli_query($db,"INSERT INTO Empresas (empresa, direccion) VALUES ('$empnombre','$empdireccion')");
		}else{
			$x = mysqli_query($db, "UPDATE Empresas SET empresa='$empnombre', direccion='$empdireccion' WHERE idempresa='$id'");
			}	
			
		header('location: form_preferencias_laborales.php');		
	 }
	  //------------------------------------------------------------------------------------------------------------------------------->DATOS PERSONALES
	 if(isset($_POST["save4"])){	 
		$nombre = test_input($_POST["nombre"]);	 
		$apellido = test_input($_POST["apellido"]);		
		$email = test_input($_POST["email"]);		
		$numdoc = test_input($_POST["numdoc"]);		
		$fnacimiento = test_input($_POST["fnacimiento"]);
		$gen = test_input($_POST["gen"]);
		$ecivil = test_input($_POST["ecivil"]);
		$tel = test_input($_POST["tel"]);   
		//$pais = test_input($_POST["pais"]);
		//$region = test_input($_POST["region"]);
		//$ciudad = test_input($_POST["ciudad"]);
		$codpostal = test_input($_POST["codpostal"]);
		//$direccion = test_input($_POST["direccion"]);
	  	//$nacionalidad = test_input($_POST["nacionalidad"]);
		$lic = test_input($_POST["lic"]);
		$vehic = test_input($_POST["vehic"]);
		$disc = test_input($_POST["disc"]);
		$discesp = test_input($_POST["discesp"]);
		
		
		$foto = $_FILES["foto"];
		
		$fotonom = $foto['name'];;
		$fotodir = "img/".$foto["name"];
		
		eliminarcv();
		// Cargando el fichero en la carpeta "img"
		move_uploaded_file($foto["tmp_name"], "img/".$foto["name"]);
		
			
		
		$cv = $_FILES["cv"];
		$cvnombre = $cv['name'];
		$cvdir = "cv/".$cv["name"];
		
		eliminarfoto();
		// Cargando el fichero en la carpeta "cv"
		move_uploaded_file($cv["tmp_name"], "cv/".$cv["name"]);
		
		
		
		$id = 1;
		$y = mysqli_query($conexion,"SELECT * FROM usuario WHERE iduser='$id'");
		if(mysqli_num_rows($y) == 0){
			$x = mysqli_query($db,"INSERT INTO usuario (fotodir) VALUES ('$fotodir')");
		}else{
			
			$x = mysqli_query($db, "UPDATE usuario SET fotodir='$fotodir', cvdir='$cvdir' WHERE iduser='$id'");
			}	
		header('location: ../vistas/dashboardUser.php');		
	}
	//------------------------------------------------------------------------------------------------------------------------------->HABS
	 
	
	if(isset($_POST["save5"])){	 
		$idiomas = $_POST["idiomas"];
		$habs = test_input($_POST["habs"]);
		$progs = test_input($_POST["progs"]); 		
			
		$iduser = 8;		
		$datos = mysqli_query($db,"SELECT idi FROM idioxuser WHERE iduser='$iduser'");		
		
		$rowcount=mysqli_num_rows($datos);			
		if(mysqli_num_rows($datos) == 0){			
			for ($y = 0; $y < count($idiomas); $y++){				
				$aux = $idiomas[$y];
				$x = mysqli_query($db,"INSERT INTO idioxuser (iduser, idi) VALUES ('$iduser','$aux')");				
			}			
		}else{
			$b=0;		
			// For de los valores de los checkbox   
			for ($y = 0; $y < count($idiomas); $y++){				
				//For de los idiomas en base de datos del usuario
				while ($fila = mysqli_fetch_row($datos)) {
				//Busca en los registro si ya existe el idioma a cargar	
				if($idiomas[$y] == $fila[0]){																
						$b = 1;
					}
				}
				$datos = mysqli_query($db,"SELECT idi FROM idioxuser WHERE iduser='$iduser'");										
			
				if($b==0){						
					$aux = $idiomas[$y];					
					$x = mysqli_query($db,"INSERT INTO idioxuser (iduser, idi) VALUES ('$iduser','$aux')");					
				}else{
					$b = 0;	
				}
			}
							
			}
		}		
	
    ?>


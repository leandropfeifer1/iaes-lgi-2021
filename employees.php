
<html lang="es_ES">
<?php 
/*require 'constants/settings.php'; 
require 'constants/check-login.php';*/

if (isset($_GET['page'])) {
$page = $_GET['page'];
if ($page=="" || $page=="1")
{
$page1 = 0;
$page = 1;
}else{
$page1 = ($page*16)-16;
}					
}else{
$page1 = 0;
$page = 1;	
}


$servername = "localhost";
$username = "root";
$password = "root";
$db = "prueba";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

if (!isset($_POST['buscar'])){$_POST['buscar'] = '';}
if (!isset($_POST['buscanombre'])){$_POST['buscanombre'] = '';}
if (!isset($_POST['buscacarrera'])){$_POST['buscacarrera'] = '';}
if (!isset($_POST['buscaIdioma'])){$_POST['buscaIdioma'] = '';}
if (!isset($_POST['mudarse'])){$_POST['mudarse'] = '';}
if (!isset($_POST['buscaEdad'])){$_POST['buscaEdad'] = '';}
if (!isset($_POST['buscaLocalidad'])){$_POST['buscaLocalidad'] = '';}
if (!isset($_POST['buscaGenero'])){$_POST['buscaGenero'] = '';}
if (!isset($_POST['situacion'])){$_POST['situacion'] = '';}
if (!isset($_POST["orden"])){$_POST["orden"] = '';}

?>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Platea21 - Employees</title>
	<meta name="description" content="Online Job Management / Job Portal" />
	<meta name="keywords" content="job, work, resume, applicants, application, employee, employer, hire, hiring, human resource management, hr, online job management, company, worker, career, recruiting, recruitment" />
	<meta name="author" content="BwireSoft">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta property="og:image" content="http://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:secure_url" content="https://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="Bwire Jobs" />
    <meta property="og:description" content="Online Job Management / Job Portal" />

	<link rel="shortcut icon" href="images/ico/favicon.png">
	
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">	
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/component.css" rel="stylesheet">
	
	<link rel="stylesheet" href="icons/linearicons/style.css">
	<link rel="stylesheet" href="icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="icons/simple-line-icons/simple-line-icons.html">
	<link rel="stylesheet" href="icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="icons/rivolicons/style.css">
	<link rel="stylesheet" href="icons/flaticon-line-icon-set/flaticon-line-icon-set.css">
	<link rel="stylesheet" href="icons/flaticon-streamline-outline/flaticon-streamline-outline.css">
	<link rel="stylesheet" href="icons/flaticon-thick-icons/flaticon-thick.css">
	<link rel="stylesheet" href="icons/flaticon-ventures/flaticon-ventures.css">

	<link href="css/style.css" rel="stylesheet">	
</head>

  <style>  
    .autofit2 {
	height:63px;
	width:63px;
    object-fit:cover; 
  }  
  </style>
  
<body class="not-transparent-header">   
            <h4 class="card-title" style="position:relative; left: 40%">Filtro de busqueda</h4> 
            <div class="col-11">
                        <table class="table"style="width:1200px">
                                <thead>
                                        <tr class="filters" style="position:relative; left: 3%;">                    
                                            
                                                <th>                                                        Carrera
                                                        <select id="assigned-tutor-filter" id="buscacarrera" name="buscacarrera" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                <?php if ($_POST["buscacarrera"] != ''){ ?>
                                                                <option value="<?php echo $_POST["buscacarrera"]; ?>"><?php echo $_POST["buscacarrera"]; ?></option>
                                                                <?php } ?>
                                                                <option value="">Todos</option>
                                                                <option value="Anelista de sistemas">Analista de sistemas</option>
                                                                <option value="Regimen aduanero">Regimen aduanero</option>
                                                                <option value="Administracion de empresas">Administracion de empresas</option>
                                                                <option value="Gestion Hotelera y turismo">Gestion Hotelera y turismo</option>
                                                                
                                                        </select>
                                                </th>
                                                <th>
                                                        Nombre:
                                                        <input type="text"  id="buscanombre" witdh="50px" name="buscanombre"  class="form-control mt-2" value="<?php echo $_POST["buscanombre"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Localidad:
                                                        <input type="text" id="buscaLocalidad" name="buscaLocalidad" class="form-control mt-2" value="<?php echo $_POST["buscaLocalidad"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                         
                                                <th>
                                                        Edad :
                                                        <input type="number" id="buscaEdad" name="buscaEdad" class="form-control mt-2" value="<?php echo $_POST["buscaEdad"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                                                                                                   <th>
                                                        Genero:
                                                        <select id="subject-filter" id="buscaGenero" name="buscaGenero" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                <?php if ($_POST["buscaGenero"] != ''){ ?>
                                                                <option value="<?php echo $_POST["buscaGenero"]; ?>"><?php echo $_POST["buscaGenero"]; ?></option>
                                                                <?php } ?>
                                                                <option value="">Todos</option>
                                                                <option style="buscaGenero: M;" value="M">M</option>
                                                                <option style="buscaGenero: F;" value="F">F</option>
                                                        </select>
                                                </th>  
                                                  <th>
                                               
                                                        Idioma :
                                                        <input type="text" id="buscaIdioma" name="buscaIdioma" class="form-control mt-2" value="<?php echo $_POST["buscaIdioma"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                </th> 
                                                <th>
                                                                                                                                   <th>
                                                        Sit. laboral :
                                                        <select id="subject-filter" id="situacion" name="situacion" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                <?php if ($_POST["mudarse"] != ''){ ?>
                                                                <option value="<?php echo $_POST["situacion"]; ?>"><?php echo $_POST["situacion"]; ?></option>
                                                                <?php } ?>
                                                                <option value="">Todos</option>
                                                                <option style="situacion: Empleado;" value="Empleado">Empleado</option>
                                                                <option style="situacion: Desempleado;" value="Desempleado">Desempleado</option>
                                                        </select>
                                                </th> 

                                                <th>
                                                        Disp. mudarse :
                                                        <select id="subject-filter" id="mudarse" name="mudarse" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                <?php if ($_POST["mudarse"] != ''){ ?>
                                                                <option value="<?php echo $_POST["mudarse"]; ?>"><?php echo $_POST["mudarse"]; ?></option>
                                                                <?php } ?>
                                                                <option value="">Todos</option>
                                                                <option style="mudarse: si;" value="si">si</option>
                                                                <option style="mudarse: no;" value="no">no</option>
                                                        </select>
                                                </th>
                                        </tr>
                                </thead>
                        </table>
                </div>               
            
            <div class="col-11">

                        <table class="table" style="width:1200px">
                                <thead>
                                        <tr class="filters" style="position:relative; left: 3%;">     
                                              
                                      
                                        </tr>
                                </thead>
                        </table>
                </div>
           
          

                <div class="col-1">
                        <input type="submit" class="btn "  value="Ver" id="buscar" style="position:relative; left: 5%; background-color: purple; color: white;">
                        
                </div>
        </div>
            
            <!-- FILTRO///////////////FILTRO//////// --> 
        <?php
        $registroAlumnos;
        $filtro="";
        $nombre=$_POST['buscanombre'];
        $carrera=$_POST['buscacarrera'];
        
        if (isset($_POST['buscar'])){
            if(!empty($_POST['buscacarrera'])){
                $filtro="SELECT * FROM usuario where nombre like '".$nombre."%'";            
            }
            else if (!empty ($_POST['btn'])){
                $filtro="SELECT * FROM usuario where carrera='".$carrera."'";
                
            }
            else $filtro="SELECT * FROM usuario where nombre like '".$nombre."%' and  carrera='".$carrera."'";
        }            
        
        $datos = mysqli_query ($filtro,$conn);   
        
        ?>
            <p style=" position: relative; left:38%; font-weight: bold; color:purple;"><i class ="mdi mdi-file-document"></i> Resultados Encontrados</<p> 
            
<!------------------------------------------------------------------------------------------------ -->
            <div class="table-responsive">
                <table class=""table" style="width:1200px">
                    <thead>
                        <tr style="backgrond-color:#00695c;color:#FFFFFF;">
                            <th style="text-align:center;"> Carrera</th>
                            <th style="text-align:center;"> Nombre</th>
                            <th style="text-align:center;"> Localidad</th>
                            <th style="text-align:center;"> edad</th>
                            <th style="text-align:center;"> Genero</th>
                            <th style="text-align:center;"> Idioma</th>
                            <th style="text-align:center;"> Sit. Laboral</th>
                            <th style="text-align:center;"> disp. mudarse</th> 
                        </tr>                  
                    
                    </thead>
                    <tbody>
                     
                    <?php
                    
                    while ($registroAlumnos=mysqli_fetch_array($datos)) 
                    {        
                       echo'<tr>                     
                        
                            <td>'.$registroAlumnos['carrera'].' </td>
                            <td>'.$registroAlumnos['nombre'].' </td>
                            <td>'.$registroAlumnos['apellido'].' </td>
                            <td>'.$registroAlumnos['edad'].' </td>
                            <td>'.$registroAlumnos['genero'].' </td>
                            <td>'.$registroAlumnos['idioma'].' </td>
                            <td>'.$registroAlumnos['situacionlab'].' </td>
                            <td>'.$registroAlumnos['dispmudarse'].' </td>

                        </tr>';
                    }
                    ?>                   
              
                    </tbody>
                <table>   
 

<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="js/bootstrap-modal.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="js/bootstrap-tokenfield.js"></script>
<script type="text/javascript" src="js/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="js/bootstrap3-wysihtml5.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js/jquery-filestyle.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>
<script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
<script type="text/javascript" src="js/handlebars.min.js"></script>
<script type="text/javascript" src="js/jquery.countimator.js"></script>
<script type="text/javascript" src="js/jquery.countimator.wheel.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript" src="js/easy-ticker.js"></script>
<script type="text/javascript" src="js/jquery.introLoader.min.js"></script>
<script type="text/javascript" src="js/jquery.responsivegrid.js"></script>
<script type="text/javascript" src="js/customs.js"></script>


</body>


</html>

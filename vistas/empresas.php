<?php
require('../db/conexionDb.php');
require('../db/verificarCredenciales.php');
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="stylesheet" href="../assets/css/filtro.css">
  
</head>
<body>
    <div class="content">
        <div id="log_img" class="logo">
            <a href="#" class="logo__link">
            <img
                src="http://www.iaes.edu.ar/wp-content/uploads/2014/08/logo-top-1.png"
                alt="Logo del IAES"
            />
            </a>
        </div>
        <div class="create">
            <a id="botonCrear" href="./registro.php">Crear Usuario</a>
        </div>
        <header id="header" class="header_dasboard">
            <a class="header_link" href="./editarCredenciales.php">
                <?php echo $_SESSION['usuario'];?></a>
            <a class="header_link" href="filtro.php">Filtro</a>
            <a class="header_link" href="../db/logout.php">Salir</a>
        </header>
    </div>
    <div class="row">
        <div class="col 3">
            <h1 class="text-decoration-underline">Registrar Empresas</h1><br>
            <form id="empresas" method="post">
                <div class="input-field">
                    <label for="empresa">Empresa</label>
                    <input  type="text" name="empresa" value="" id="empresa" placeholder="">
                    
                </div>
                
                <div class="input-field">
                    <label for="cuit">CUIT</label>
                    <input  type="text" name="cuit" value="" id="cuit" placeholder="">
                   
                </div>                
                <div class="input-field">
                    <label for="presidente">Presidente</label>
                    <input  type="text" name="presidente" value="" id="presidente" placeholder="">
                    
                </div>
                
                <div class="input-field">
                    <label for="correo">Correo</label>
                    <input  type="text" name="correo" value="" id="correo" placeholder="">
                </div>
                
                <div class="input-field">
                    <label for="telefono">Telefono</label>
                    <input  type="text" name="telefono" value="" id="telefono" placeholder="">
                </div>
                 <div class="input-field">
                     <button  type="submit" name="guardar" class="btn-success">Guardar</button>
                    
                </div>
                
            </form>
        </div>
    </div>


<script src="../jquery/jquery-3.6.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../popper/popper.min.js"></script>
<script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/js/empresasjs.js"></script>

<!--<script>
    $(document).ready(function(){
        M.AutoInit();
    });
    $(document).ready(function(){
        
    });
</script>-->
</body>

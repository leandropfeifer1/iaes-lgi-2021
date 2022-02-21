<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda de Empleado</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <link href="../select2/css/select2.css" rel="stylesheet" type="text/css"/>
</head>
    <header>
        <h3 class="text-center">Todas las Busquedas</h3>        
    </header>
    <div class="container">
        <div id="tabla"></div>
    </div>

<script src="../jquery/jquery-3.6.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../popper/popper.min.js"></script>
<script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/js/sucursalesjs.js"></script>
<script src="../select2/js/select2.js" type="text/javascript"></script>
</html>

<script type="text/javascript">
    $(document).ready(function(){
       $('#tabla').load('bussuc.php');
    });
</script>
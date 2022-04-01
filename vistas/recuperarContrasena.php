<?php

$idUser = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <title>Recuperar Contraseña</title>
    </head>
    <body>
        <div class="container">
            <div class="row my-auto justify-content-md-center">
                <div class="col-6">
                    <form id="form_forgot_pass" class="p-3 mx-6 border bg-light">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ingrese Nueva Contraseña</label>
                            <input required type="text" placeholder="Ingresa la Nueva Contraseña" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <input disabled type="hidden" id="idUser" value="<?php echo $idUser ?>">
                            <div id="emailHelp" class="form-text text-muted">Las Contraseña se cambiará al que hayas ingresado</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cambiar</button>
                    </form>
                </div>
            </div>
            
        </div>
    <div class="row my-auto justify-content-md-center">
    </div>   
<script src="../jquery/jquery-3.6.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../popper/popper.min.js"></script>
<script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="../assets/js/recuperarPass.js"></script>
</body>
</html>
<?php




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
                            <label for="exampleInputEmail1" class="form-label">Dirección de Email</label>
                            <input id="email_forgot" required type="email" placeholder="Ingresa el email que usaste en tu registro" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text text-muted">Tu password llegará a tu email</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Recuperar</button>
                    </form>
                </div>
            </div>
        </div>
<script src="./jquery/jquery-3.6.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../popper/popper.min.js"></script>
<script src="./plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="./assets/js/verificarEmail.js"></script>
</body>
</html>
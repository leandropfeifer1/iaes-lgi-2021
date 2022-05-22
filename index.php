<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit-no">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./plugins/sweetalert/sweetalert2.min.css">
    <title>Bolsa de Empleo</title>
</head>
<body>
    <header id="head">
      <div class="logo">
        <a href="#" class="logo__link">
          <img
            src="http://www.iaes.edu.ar/wp-content/uploads/2014/08/logo-top-1.png"
            alt="Logo del IAES"
          />
        </a>
      </div>
      <nav class="nav">
        <a href="https://iaes.edu.ar" class="nav__link">Instituto</a>
        <a href="#" class="nav__link">Preguntas</a>
      </nav>
    </header>
    <h1 id="title">Bolsa de Empleo IAES</h1>
    <form id="formLogin" action="" method="POST">
        <h3>Iniciar Sesión</h3>
        <input autocomplete="off" id="usuario" type="text" placeholder="Ingresa tu usuario" name="usuario">
        <input id="password" type="password" placeholder="Ingresa tu contraseña" name="password">
        <input name="submit" type="submit">
        <!-- <a id="link_forgot" href="./vistas/recuperarContrasena.php">Olvidé mi contraseña</a> -->
    </form>
<script src="./jquery/jquery-3.6.0.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script src="./popper/popper.min.js"></script>
<script src="./plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="./assets/js/app.js"></script>
</body>
</html>
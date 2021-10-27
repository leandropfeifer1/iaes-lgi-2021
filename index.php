<?php
session_start();
require("./db/conexionDb.php");
$message = '';
if(isset($_POST['userLog']) && isset($_POST['passLog'])){
    $sql = "SELECT * FROM usuarios WHERE username = '".$_POST['userLog']."';";
    $resultado = mysqli_query($conexion, $sql);

    if (!empty($resultado) && mysqli_num_rows($resultado) != 0) {
        while($row = mysqli_fetch_assoc($resultado)) {
            if(password_verify($_POST['passLog'], $row["password"])){
                $_SESSION['id_user'] = $row['iduser'];
                $_SESSION['usuario'] = $row['username'];
                $_SESSION['id_rol'] = $row['rol'];
                header('location: /login-php/redirect.php');
            } else {
                $message = "Usuario o Contraseña Incorrectas";
            }
        }
    } else {
        $message = "Usuario No encontrado";
    }

    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asserts/css/style.css">
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
        <a href="#" class="nav__link">Instituto</a>
        <a href="#" class="nav__link">Preguntas</a>
      </nav>
    </header>
    <h1 id="title">Bolsa de Empleo IAES</h1>
    <div class="divToDelete">
        <?php   
            if(!empty($message)):
        ?>
        <p id="loginMessage"> <?php echo $message ?></p>
        <?php endif; ?>
    </div>
    <form id="login_form" action="index.php" method="POST">
        <h3>Iniciar Sesión</h3>
        <input required type="text" placeholder="Ingresa tu usuario" name="userLog">
        <input required type="password" placeholder="Ingresa tu contraseña" name="passLog">
        <input type="submit">
    </form>
    <script src="./asserts/js/message.js"></script>
</body>
</html>
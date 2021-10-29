<?php 
require("./db/conexionDb.php");
$message = "";

if(!empty($_POST["user"]) && !empty($_POST["pass"]) && !empty($_POST["rol"])){
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $rol = (int)$_POST["rol"];

    $passwordHash = password_hash($pass, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (username, password, rol)
    VALUES ('".$user."','".$passwordHash."',".$rol.");";

    if (mysqli_query($conexion, $sql)) {
        $message = "Usuario creado correctamente";
    } else {
        $message = "Lo siento! Ha habido un problema creando el usuario";
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
    <title>Registrarse</title>
</head>
<body>
    <h2>Sign Up</h2>
    <span><a href="login.php">Ingresar</a></span>

    <div class="divToDelete">
        <?php   
            if(!empty($message)):
        ?>
        <p id="signupMessage"> <?php echo $message ?></p>
        <?php endif; ?>
    </div>

    <form action="signup.php" method="POST">
        <input required type="text" placeholder="Ingresa tu usuario" name="user">
        <div class="caja">
            <select name="rol" id="select">
                <option selected value="3">Usuario</option>
                <option value="2">Secretaría</option>
                <option value="1">Administrador</option>
            </select>
        </div>
        <input required type="password" placeholder="Ingresa tu contraseña" name="pass">
        <input required type="password" placeholder="Confirma tu contraseña" name="passConfirm">
        <input type="submit">
    </form>
    <script src="./asserts/js/message.js"></script>
</body>
</html>
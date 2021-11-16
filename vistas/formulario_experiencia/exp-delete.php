
<?php
include 'conexionDb.php';

    if (isset($_POST['id'])) {
        $idexp = $_POST['id'];
        $query = "DELETE FROM experiencia WHERE idexp=$idexp";
        $result = mysqli_query($conexion, $query);
        if(!$result){
            die('Query failed');
        }
        echo "exp eliminada";
    }
?>

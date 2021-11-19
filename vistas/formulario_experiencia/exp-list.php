<?php 
    include ('conexionDb.php');

    //Selecciona todas las experiencias de un usuario 
    $query = "SELECT * FROM experiencia WHERE iduser='1'";
    $result = mysqli_query($conexion, $query);		
	if (!$result) {
		die('Query failed!'. mysqli_error($conexion));
	}

    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'idexp' => $row['idexp'],
            'iduser' => $row['iduser'],
            'idempresa' => $row['idempresa'],
            'empresa' => $row['empresa'],
            'puesto' => $row['puesto'],
            'desde' => $row['desde'],
            'hasta' => $row['hasta'],
            'contacto' => $row['contacto']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

?>
<?php
session_start();
require '../db/conexionDb.php';
mysqli_set_charset($conexion, "utf8");
?>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered" style="background-color: #eee;">
            <caption>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalagregarsuc">Agregar                 
                </button>
            </caption>

            <tr>
                <td>Empresa Perteneciente</td>
                <td>Dirección</td>
                <td>Localidad</td>
                <td>Departamento</td>
                <td>Provincia</td>
                <td>Pais</td>
                <td>Telefono</td>
                <td>Gerente</td>
                <td>Central</td>
                <td>En Busqueda</td>
                <td>Modificar</td> 
                <td>Borrar</td>
            </tr>
            <?php
            if (isset($_SESSION['consulta'])) {
                if ($_SESSION['consulta'] > 0) {
                    $emp = $_SESSION['consulta'];                    
                    $sql = "SELECT `idsucursal`, `empresa`, `direccion`, `localidad`, `departamento`, `provincia`, `pais`, `telefono`, `gerente`, `central` FROM `sucursales` WHERE empresa =$emp";
                } else {
                    $sql = "SELECT `idsucursal`, `empresa`, `direccion`, `localidad`, `departamento`, `provincia`, `pais`, `telefono`, `gerente`, `central` FROM `sucursales` WHERE 1";
                }
            } else {
                $sql = "SELECT `idsucursal`, `empresa`, `direccion`, `localidad`, `departamento`, `provincia`, `pais`, `telefono`, `gerente`, `central` FROM `sucursales` WHERE 1";
            }
            
            $lista = mysqli_query($conexion, $sql);
            while ($fila = $lista->fetch_assoc()) {
                $datos = $fila['idsucursal'] . "||" . $fila['empresa'] . "||" . $fila['direccion'] . "||" . $fila['localidad'] . "||" . $fila['departamento'] . "||" . $fila['provincia'] . "||" . $fila['pais'] . "||" . $fila['telefono'] . "||" . $fila['gerente'] . "||" . $fila['central'];
                $sql1 = "SELECT empresa FROM `empresas` WHERE idempresa=" . $fila['empresa'] . "";
                $result1 = mysqli_query($conexion, $sql1);
                $empresa = mysqli_fetch_array($result1);
                $sql2 = "SELECT localidad FROM `localidad` WHERE idloc=" . $fila['localidad'] . "";
                $result2 = mysqli_query($conexion, $sql2);
                $localidad = mysqli_fetch_array($result2);
                $sql3 = "SELECT departamento FROM `departamento` WHERE idep=" . $fila['departamento'] . "";
                $result3 = mysqli_query($conexion, $sql3);
                $departamento = mysqli_fetch_array($result3);
                $sql4 = "SELECT provincia FROM `provincia` WHERE idpro=" . $fila['provincia'] . "";
                $result4 = mysqli_query($conexion, $sql4);
                $provincia = mysqli_fetch_array($result4);
                $sql5 = "SELECT pais FROM `pais` WHERE idpais = " . $fila['pais'] . "";
                $result5 = mysqli_query($conexion, $sql5);
                $pais = mysqli_fetch_array($result5);
                $datos = $fila['idsucursal'] . "||" . $fila['direccion'] . "||" . $fila['localidad'] . "||" . $fila['departamento'] . "||" . $fila['provincia'] . "||" . $fila['pais'] . "||" . $fila['telefono'] . "||" . $fila['gerente'] . "||" . $fila['central'];
                ?>
                <tr>
                    <td><?php echo $empresa[0] ?></td>
                    <td><?php echo $fila['direccion'] ?></td> 
                    <td><?php echo $localidad[0] ?></td> 
                    <td><?php echo $departamento[0] ?></td> 
                    <td><?php echo $provincia[0] ?></td> 
                    <td><?php echo $pais[0] ?></td>
                    <td><?php echo $fila['telefono'] ?></td>
                    <td><?php echo $fila['gerente'] ?></td> 
                    <td><?php
            if ($fila['central'] == 1) {
                echo 'Central';
            } else {
                echo 'Sucursal';
            }
                ?>
                    <td><?php
                    $sql7 = "SELECT `idbusqueda` FROM `buscaempleado` WHERE `idsucursal`=" . $fila['idsucursal'];
                    $busca = mysqli_query($conexion, $sql7);

                    $q = '';                   
                    if(mysqli_num_rows($busca)>0){
                    ?> <button class="btn btn-success btnbuscando">Buscando</button><?php
                            $q = 0;
                        } else {
                            echo "No Busca";
                            $q = 0;
                        }
                        ?></td>
                        
                    <td>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditarsuc" onclick="agregaform('<?php echo $datos ?>')">Editar</button>
                    </td>  
                    <td>
                        <button class="btn btn-danger" onclick="confirmaciondel('<?php echo $fila['idsucursal'] ?>')">Eliminar</button>
                    </td>
                    <?php
                }
                ?>
            </tr>
        </table>        
    </div>
</div>
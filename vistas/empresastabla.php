<?php
require '../db/conexionDb.php';
?>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <caption>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalagregar">Agregar                 
                </button>
            </caption>
            
            <tr>
                <td>Empresa</td>
                <td>Cuit</td>
                <td>Presidente</td>
                <td>Correo</td>
                <td>Telefono</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
            <?php
            
                $sql = "SELECT `idempresa`, `empresa`, `cuit`, `presidente`, `correo`, `telefono` FROM `empresas` WHERE 1";
		$lista = mysqli_query($conexion, $sql);
                while ($fila = $lista->fetch_assoc()) {
                    $datos=$fila['idempresa']."||".$fila['empresa']."||".$fila['cuit']."||".$fila['presidente']."||".$fila['correo']."||".$fila['telefono'];
            ?>
            <tr>
                <td><?php echo $fila['empresa']?></td>
                <td><?php echo $fila['cuit']?></td> 
                <td><?php echo $fila['presidente']?></td> 
                <td><?php echo $fila['correo']?></td> 
                <td><?php echo $fila['telefono']?></td> 
                <td>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditar" onclick="agregaform('<?php echo $datos ?>')">Editar</button>
                </td>  
                <td>
                    <button class="btn btn-danger" onclick="confirmaciondel('<?php echo $fila['idempresa'] ?>')">Eliminar</button>
                </td>
             <?php
                }
             ?>
            </tr>
        </table>        
    </div>
</div>
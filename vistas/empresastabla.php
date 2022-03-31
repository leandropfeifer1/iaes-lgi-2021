<?php
require '../db/conexionDb.php';
mysqli_set_charset($conexion, "utf8");
?>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <caption>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalagregar">Agregar
                </button>
            </caption>

            <tr style="background-color: #eee;">
                <td>Logo</td>
                <td>Empresa</td>
                <td>Cuit</td>
                <td>Presidente</td>
                <td>Correo</td>
                <td>Telefono</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
            <?php

            $sql = "SELECT `idempresa`, `empresa`, `cuit`, `presidente`, `correo`, `telefono`, `logo` FROM `empresas` WHERE 1";
            $lista = mysqli_query($conexion, $sql);
            while ($fila = $lista->fetch_assoc()) {
                $datos = $fila['idempresa'] . "||" . $fila['empresa'] . "||" . $fila['cuit'] . "||" . $fila['presidente'] . "||" . $fila['correo'] . "||" . $fila['telefono']. "||" . $fila['logo'];
            ?>            
                <tr style="background-color: #eee;">
                    
                    <td><?php if($fila['logo'] != ""){
                        $logo = $fila['logo'];
                    }else{
                        $logo = "default.png";
                    }?> <img class="img-thumbnail" src="<?php echo "../db/images/" . $logo ?>" width="50" alt=""></td>
                    <td><?php echo $fila['empresa'] ?></td>
                    <td><?php echo $fila['cuit'] ?></td>
                    <td><?php echo $fila['presidente'] ?></td>
                    <td><?php echo $fila['correo'] ?></td>
                    <td><?php echo $fila['telefono'] ?></td>
                    <td>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaleditar" onclick="agregaform('<?php echo $datos ?>')" style="width: 100%;">Editar</button>
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="confirmaciondel('<?php echo $fila['idempresa'] ?>')" style="width: 100%;">Eliminar</button>
                    </td>
                <?php
            }
                ?>
                </tr>
        </table>
    </div>
</div>
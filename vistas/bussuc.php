<?php
require '../db/conexionDb.php';
?>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <caption>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalagregarsuc">Agregar                 
                </button>
            </caption>
            
            <tr>
                <td>Empresa</td>
                <td>Carrera</td>
            </tr>
            <?php            
                $sql = "SELECT * FROM `buscaempleado`";
		$lista = mysqli_query($conexion, $sql);               
                while ($fila = $lista->fetch_assoc()) {
                    $sql1 = "SELECT `empresa` FROM `sucursales` WHERE `idsucursal`=".$fila['idsucursal'];
                    $lista1 = mysqli_query($conexion, $sql1);
                    $empresa = mysqli_fetch_array($lista1);
                    $sql2 = "SELECT `empresa` FROM `empresas` WHERE `idempresa`=".$empresa[0];
                    $lista2=mysqli_query($conexion, $sql2);
                    $nombre = mysqli_fetch_array($lista2);
                    $sql4 = "SELECT `carrera` FROM `carrera` WHERE `idcar`=".$fila['idcarrera'];
                    $lista4= mysqli_query($conexion, $sql4);
                    $idcar = mysqli_fetch_array($lista4);
                    ?>
            <tr>
                <td><?php echo $nombre[0]?></td>
                <td><?php echo $idcar[0]?></td> 
                <?php
                }
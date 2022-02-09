<?php
require('../db/conexionDb.php');
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
    <header>
        <h3 class="text-center">Todas las Sucursales</h3>        
    </header>
    <div class="container">
        <div id="tabla"></div>
    </div>
    <div class="modal fade" id="modalagregarsuc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Sucursal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <th>Empresa</th>
		<select name="empresa" id="empresa" class="form-control">
		<option value=""></option>
                <?php
                $sql = "SELECT * FROM empresas";
		$lista = mysqli_query($conexion, $sql);
		while ($fila = $lista->fetch_assoc()) {
                    
                        $empresa = $fila['idempresa'];
			$nombre = $fila['empresa'];
			echo "<option value=$empresa>$nombre</option>";
                }
                ?>
                </select>
                <label>Direccion</label>
                <input type="text" name="direccion" id="direccion" class="form-control input-sm">
                <th>Localidad</th>
		<select name="localidad" id="localidad" class="form-control">
		<option value=""></option>
                <?php
                $sql ="SELECT * FROM localidad";
		$lista = mysqli_query($conexion, $sql);
		while ($fila = $lista->fetch_assoc()) {
                    
                        $localidad = $fila['idloc'];
			$nombre = $fila['localidad'];
			echo "<option value=$localidad>$nombre</option>";
                }
                ?>
                </select>
                <th>Departamento</th>
		<select name="departamento" id="departamento" class="form-control">
		<option value=""></option>
                <?php
                    $sql ="SELECT * FROM departamento";
                    $lista = mysqli_query($conexion, $sql);
                    while ($fila = $lista->fetch_assoc()) {

                            $departamento = $fila['idep'];
                            $nombre = $fila['departamento'];
                            echo "<option value=$departamento>$nombre</option>";
                    }
                ?>
                </select>
                <th>Provincia</th>
		<select name="provincia" id="provincia" class="form-control">
		<option value=""></option>
                <?php
                    $sql ="SELECT * FROM provincia";
                    $lista = mysqli_query($conexion, $sql);
                    while ($fila = $lista->fetch_assoc()) {

                            $provincia = $fila['idpro'];
                            $nombre = $fila['provincia'];
                            echo "<option value=$provincia>$nombre</option>";
                    }
                ?>
                </select>
                <th>Pais</th>
		<select name="pais" id="pais" class="form-control">
		<option value=""></option>
                <?php
                    $sql ="SELECT * FROM pais";
                    $lista = mysqli_query($conexion, $sql);
                    while ($fila = $lista->fetch_assoc()) {

                            $pais = $fila['idpais'];
                            $nombre = $fila['pais'];
                            echo "<option value=$pais>$nombre</option>";
                    }
                ?>
                </select>
                <label>Telefono</label>
                <input type="text" name="telefono" id="telefono" class="form-control input-sm"> 
                <label>Gerente</label>
                <input type="text" name="gerente" id="gerente" class="form-control input-sm"> 
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="guardarN">Guardar</button>
          </div>
        </div>
      </div>
    </div>
</body>

<div class="modal fade" id="modaleditarsuc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Informacion de Sucursal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                </select>
                <label>Direccion</label>
                <input type="text" name="direccion" id="direccion" class="form-control input-sm">
                <th>Localidad</th>
		<select name="localidade" id="localidade" class="form-control">
		<option value=""></option>
                <?php
                $sql ="SELECT * FROM localidad";
		$lista = mysqli_query($conexion, $sql);
		while ($fila = $lista->fetch_assoc()) {
                    
                        $localidad = $fila['idloc'];
			$nombre = $fila['localidad'];
			echo "<option value=$localidad>$nombre</option>";
                }
                ?>
                </select>
                <th>Departamento</th>
		<select name="departamentoe" id="departamentoe" class="form-control">
		<option value=""></option>
                <?php
                    $sql ="SELECT * FROM departamento";
                    $lista = mysqli_query($conexion, $sql);
                    while ($fila = $lista->fetch_assoc()) {

                            $departamento = $fila['idep'];
                            $nombre = $fila['departamento'];
                            echo "<option value=$departamento>$nombre</option>";
                    }
                ?>
                </select>
                <th>Provincia</th>
		<select name="provinciae" id="provinciae" class="form-control">
		<option value=""></option>
                <?php
                    $sql ="SELECT * FROM provincia";
                    $lista = mysqli_query($conexion, $sql);
                    while ($fila = $lista->fetch_assoc()) {

                            $provincia = $fila['idpro'];
                            $nombre = $fila['provincia'];
                            echo "<option value=$provincia>$nombre</option>";
                    }
                ?>
                </select>
                <th>Pais</th>
		<select name="paise" id="paise" class="form-control">
		<option value=""></option>
                <?php
                    $sql ="SELECT * FROM pais";
                    $lista = mysqli_query($conexion, $sql);
                    while ($fila = $lista->fetch_assoc()) {

                            $pais = $fila['idpais'];
                            $nombre = $fila['pais'];
                            echo "<option value=$pais>$nombre</option>";
                    }
                ?>
                </select>
                <label>Telefono</label>
                <input type="text" name="telefonoe" id="telefonoe" class="form-control input-sm"> 
                <label>Gerente</label>
                <input type="text" name="gerentee" id="gerentee" class="form-control input-sm"> 
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </div>
</body>

<script src="../jquery/jquery-3.6.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../popper/popper.min.js"></script>
<script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/js/sucursalesjs.js"></script>


<script type="text/javascript">
    $(document).ready(function(){
       $('#tabla').load('sucursalestabla.php');
    });
</script>
<?php
require('../db/conexionDb.php');
require('../db/verificarCredenciales.php');
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
  
    <div class="row">
        <div class="col 14">
            <h5 class="text-decoration-underline">Registrar Empresas</h5><br>
            <form id="sucursales" method="post">
                <table>
                    <tr>
			<th>Empresa</th>
                    </tr>
			<tr>
                            <td>
				<select name="empresa" class="form-control" placeholder>
                                    <?php
                                    include '../db/conexionDb.php';
                                    $sql = "SELECT `idempresa`, `empresa` FROM `empresas`";
                                    $lista = mysqli_query($conexion, $sql);
                                    while ($fila = $lista->fetch_assoc()) {
                                        $idempresa = $fila['idempresa'];
                                        $empresa = $fila['empresa'];
                                        echo "<option value=$idempresa>$empresa</option>";
                                        }
                                    ?>
				</select>
                            </td>
			</tr>
		</table>
                <div class="input-field">
                    <label for="direccion">Direccion</label>
                    <input  type="text" name="direccion" value="" id="direccion" placeholder="">
                    
                </div>
                <div class="input-field">
                    <label for="telefono">Telefono</label>
                    <input  type="text" name="telefono" value="" id="telefono" placeholder="">
                    
                </div>
                <table>
                <div class="input-field">
                    <label for="gerente">Gerente</label>
                    <input  type="text" name="gerente" value="" id="gerente">
                    
                </div>
                    </table>
                <table>
					<tr>
						<th>Localidad</th>
					</tr>
					<tr>
						<td>
							<select name="localidad" class="form-control" placeholder>
								<?php
								include '../db/conexionDb.php';
								$sql = "SELECT * FROM localidad";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									$localidad = $fila['idloc'];
									$nombre = $fila['localidad'];
									echo "<option value=$localidad>$nombre</option>";
								}
								?>
							</select>
						</td>
					</tr>
				</table>

				<table>
					<tr>
						<th>Departamento</th>
					</tr>
					<tr>
						<td>
							<select name="departamento" class="form-control">
								<?php
								include '../db/conexionDb.php';
								$sql = "SELECT * FROM departamento";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									$id = $fila['idep'];
									$nombre = $fila['departamento'];
									echo "<option value=$id>$nombre</option>";
								}
								?>
							</select>
						</td>
					</tr>
				</table>

				<table>
					<tr>
						<th>Provincia</th>
					</tr>
					<tr>
						<td>
							<select name="provincia" class="form-control">
								<?php
								include '../db/conexionDb.php';
								$sql = "SELECT * FROM provincia";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									$id = $fila['idpro'];
									$nombre = $fila['provincia'];
									echo "<option value=$id>$nombre</option>";
								}
								?>
							</select>
						</td>
					</tr>
				</table>

				<table>
					<tr>
						<th>Paises</th>
					</tr>
					<tr>
						<td>
							<select name="pais" class="form-control">
								<?php
								include '../db/conexionDb.php';
								$sql = "SELECT * FROM pais";
								$lista = mysqli_query($conexion, $sql);
								while ($fila = $lista->fetch_assoc()) {
									$idpais = $fila['idpais'];
									$nombre = $fila['pais'];
									echo "<option value = $idpais >$nombre</option>";
								}
								?>
							</select>
						</td>
					</tr>
				</table>
  
                
                <br>
                <table>
                    <tr>
                        <th>Central?</th>
                    </tr>
                    <td>
                        <select name="central" class="form-control">
                            <?php
                            echo "<option value= 1>Central</option>";
                            echo "<option value= 0>No es Central</option>";
                            ?>
                        </select>
                    </td>
                </table>
                <table>
                    <tr>
                        <th>Buscando Empleado?</th>
                    </tr>
                    <td>
                        <select name="buscando" class="form-control">
                            <?php
                            echo "<option value= 1>Si</option>";
                            echo "<option value=0>No</option>";
                            ?>
                        </select>
                    </td>
                </table>
                 <div class="input-field">
                     <button  type="submit" name="guardar" class="btn-success">Guardar</button>
                    
                </div>
              
            </form>
        </div>
    </div>


<script src="../jquery/jquery-3.6.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../popper/popper.min.js"></script>
<script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/js/sucursalesjs.js"></script>

<!--<script>
    $(document).ready(function(){
        M.AutoInit();
    });
    $(document).ready(function(){
        
    });
</script>-->
</body>

<?php
require '../db/conexionDb.php';
mysqli_set_charset($conexion, "utf8");
$sql = "SELECT `idempresa`,`empresa` FROM `empresas` WHERE 1";
$sel = mysqli_query($conexion, $sql);
?>
<br><br>
<div class="row">
    <div class="col-sm-12">
        <div>
            <label>Filtro por Empresas</label>
            <select name="empresa" id="empresa" class="form-control input-sm">
                <option value="0">---</option>
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
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#empresa').select2();
        $('#empresa').change(function(){
            $.ajax({
               type:"post",
               data:'valor=' +$('#empresa').val(),
               url:"../db/bsuc.php",
               success:function(r){
                   $('#tabla').load('sucursalestabla.php');
               }
            });
        });
    });
</script>
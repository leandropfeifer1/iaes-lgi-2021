<?php
require('../db/conexionDb.php');
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empresas</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="stylesheet" href="../assets/css/filtro.css">  
    <script src="../jquery/jquery-3.6.0.min.js"></script>
    <script src="../popper/popper.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../assets/js/createUser.js"></script>
    <script src="../assets/js/empresasjs.js"></script>
</head>
<body>
    <header>
        <h3 class="text-center">Listado de Empresas</h3>        
    </header>
    <div class="container">
        <div id="tabla"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalagregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Empresa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label>Empresa</label>
                <input type="text" name="empresa" id="empresa" class="form-control input-sm">
                <label>CUIT</label>
                <input type="text" name="cuit" id="cuit" class="form-control input-sm">
                <label>Presidente</label>
                <input type="text" name="presidente" id="presidente" class="form-control input-sm">
                <label>Correo</label>
                <input type="text" name="correo" id="correo" class="form-control input-sm"> 
                <label>Telefono</label>
                <input type="text" name="telefono" id="telefono" class="form-control input-sm"> 
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="guardarN">Guardar</button>
          </div>
        </div>
      </div>
    </div>
</body>

<div class="modal fade" id="modaleditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Informacion de Empresa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <input type="text" hidden="" id="idempresa" name="">
                <label>Empresa</label>
                <input type="text" name="empresae" id="empresae" class="form-control input-sm">
                <label>CUIT</label>
                <input type="text" name="cuite" id="cuite" class="form-control input-sm">
                <label>Presidente</label>
                <input type="text" name="presidentee" id="presidentee" class="form-control input-sm">
                <label>Correo</label>
                <input type="text" name="correoe" id="correoe" class="form-control input-sm"> 
                <label>Telefono</label>
                <input type="text" name="telefonoe" id="telefonoe" class="form-control input-sm"> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" id="modificar" class="btn btn-primary" data-bs-dismiss="modal">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
       $('#tabla').load('empresastabla.php');
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
       $('#guardarN').click(function(){
          empresa=$('#empresa').val();
          cuit=$('#cuit').val();
          presidente=$('#cuit').val();
          correo=$('#correo').val();
          telefono=$('#telefono').val();
          agregardatos(empresa,cuit,presidente,correo,telefono);
       });
       
       
       $('#modificar').click(function(){
           modificar();
       });
    });
</script>

function agregardatos(empresa,direccion,localidad,departamento,provincia,pais,telefono,gerente,central){
    datos="empresa="+empresa+"&direccion="+direccion+"&localidad="+localidad+"&departamento="+departamento
        +"&provincia="+provincia+"&pais="+pais+"&telefono="+telefono+"&gerente="+gerente+"&central="+central;
    $.ajax({
        type:"POST",
        url:"../db/sucursalesdb.php",
        data:datos,  
        success:function(r){
            if(r===1){
                Swal.fire({
                    icon: 'success',
                    title: 'Sucursal Guardada',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
                $('tabla').load('sucursalestabla.php');
            }else{
                Swal.fire({
                    icon: 'success',
                    title: 'Sucursal Guardada',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
                $('#tabla').load('sucursalestabla.php');
            }
        }
    });
}
function agregaform(datos){
    d=datos.split('||');
    $('#idempresa').val(d[0]);
    $('#empresae').val(d[1]);
    $('#cuite').val(d[2]);
    $('#presidentee').val(d[3]);
    $('#correoe').val(d[4]);
    $('#telefonoe').val(d[5]);

}
function confirmaciondel(idsucursal){
    Swal.fire({
    title: 'Confirme',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'No'
    }).then((result) => {
    if (result.isConfirmed) {
        borrar(idsucursal)
        $('#tabla').load('sucursalestabla.php')
        Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
        )
    }
})
}
function borrar(idsucursal){
    cadena="idsucursal="+idsucursal;
    $.ajax({
       type:"POST",
       url:"../db/sucursalesdel.php",
       data:cadena, 
    });
}
function busqueda(idsucursal){
    cadena="idsucursal="+idsucursal;
    $.ajax({
       type:"POST",
       url:"../db/sucbus.php",
       data:cadena, 
    });
    $('tabla').load('sucursalestabla.php');
}
    function sucbus(idsucusal){
        document.getElementById("sucbus").innerHTML="";
        $('#buscando').modal('show');
        $('#contenido').load("bussuc.php",{idsucursal:idsucursal});
    }
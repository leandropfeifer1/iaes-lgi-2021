function agregardatos(empresa,cuit,presidente,correo,telefono){
    cadena="empresa="+empresa+"&cuit="+cuit+"&presidente="+presidente+"&correo="+correo+"&telefono="+telefono;
    $.ajax({
        type:"POST",
        url:"../db/empresasdb.php",
        data:cadena,
        success:function(r){
            if(r==1){
                alert("Exito");
                $('#tabla').load('empresastabla.php');
            }else{
                alert("Fallo");
            }
        }
    });
    return false;
    }; 

function agregaform(datos){
    d=datos.split('||');
    $('#idsucursal').val(d[0])
    $('#direccione').val(d[1]);
    $('#localidade').val(d[2]);
    $('#departamentoe').val(d[3]);
    $('#provinciae').val(d[4]);
    $('#paise').val(d[5]);
    $('#telefonoe').val(d[6]);
    $('#gerentee').val(6);
    $('#central').val(7);

}

function modificar(){
    idempresa=$('#idempresa').val();
    empresae=$('#empresae').val();
    cuite=$('#cuite').val();
    presidentee=$('#presidentee').val();
    correoe=$('#correoe').val();
    telefonoe=$('#telefonoe').val();
    cadena="idempresa="+idempresa+"&empresa="+empresae+"&cuit="+cuite+"&presidente="+presidentee+"&correo="+correoe+"&telefono="+telefonoe;
    $.ajax({
        type:"POST",
        url:"../db/empresasmod.php",
        data:cadena,
        success:function(r){
            if(r==1){
                alert("Modificacion Exitosa");
                $('#tabla').load('empresastabla.php');
            }else{
                alert("Fallo la Modificacion");
            }
        }
    });
}
function confirmaciondel(idempresa){
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
        borrar(idempresa)
        $('#tabla').load('empresastabla.php')
        Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
        )
    }
})
}

function borrar(idempresa){
    cadena="idempresa="+idempresa;
    $.ajax({
       type:"POST",
       url:"../db/empresasdel.php",
       data:cadena, 
    });
}
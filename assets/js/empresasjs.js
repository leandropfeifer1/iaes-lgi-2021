function agregardatos(empresa,cuit,presidente,correo,telefono){
    cadena="empresa="+empresa+"&cuit="+cuit+"&presidente="+presidente+"&correo="+correo+"&telefono="+telefono;
    $.ajax({
        type:"POST",
        url:"../db/empresasdb.php",
        data:cadena,
        success:function(r){
            if(r==1){
                Swal.fire({
                    icon: 'success',
                    title: 'Sucursal Guardada',
                    confirmButtonColor: '#ffa361',
                    confirmButtonText: 'Ok',
                });
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
    $('#idempresa').val(d[0]);
    $('#empresae').val(d[1]);
    $('#cuite').val(d[2]);
    $('#presidentee').val(d[3]);
    $('#correoe').val(d[4])
    $('#telefonoe').val(d[5]);
}

function modificar(){
    idempresa=$('#idempresa').val();
    empresae=$('#empresae').val();
    cuite=$('#cuite').val();
    presidentee=$('#presidentee').val();
    correoe=$('#correoe').val();
    telefonoe=$('#telefonoe').val();
    
    if(empresae===''){
            Swal.fire({
            icon: 'warning',
            title: 'Falta Completar campo "Empresa"',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
            }else{
                if(cuite===''){   
                    Swal.fire({
                        icon: 'warning',
                        title: 'Falta Completar campo "CUIT"',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                        });
                }else{
                    if(presidentee===''){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Falta Completar campo "Presidente"',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                    }else{
                        if(correoe===''){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Falta Completar campo "Empresa"',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                        }else{
                            if(telefonoe===''){
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Falta Completar campo "Telefono"',
                                    confirmButtonColor: '#ffa361',
                                    confirmButtonText: 'Ok',
                                });
                            }else{
                                    cadena="idempresa="+idempresa+"&empresa="+empresae+"&cuit="+cuite+"&presidente="+presidentee+"&correo="+correoe+"&telefono="+telefonoe;
                                    $.ajax({
                                        type:"POST",
                                        url:"../db/empresasmod.php",
                                        data:cadena,
                                        success:function(r){
                                            if(r==1){
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Modificacion Exitosa',
                                                    confirmButtonColor: '#ffa361',
                                                    confirmButtonText: 'Ok',
                                                });
                                                $('#tabla').load('empresastabla.php');
                                            }else{
                                                alert("Fallo la Modificacion");
                                            }
                                        }
                                    });
                            }
                        }
                    }
                    
                }
            }

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
    $('#tabla').load('empresastabla.php')
}
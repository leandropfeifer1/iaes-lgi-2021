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
    $('#idsucursal').val(d[0]);
    $('#direccione').val(d[1]);
    $('#localidad').val(d[2]);
    $('#departamento').val(d[3]);
    $('#provincia').val(d[4]);
    $('#pais').val(d[5]);
    $('#telefonoe').val(d[6]);
    $('#gerentee').val(d[7]);
    $('#centrale').val(d[8]);

}
function modsucursal(){
           idsucursal=$('#idsucursal').val();
           direccione=$('#direccione').val();
           localidade=$('#localidade').val();
           departamentoe=$('#departamentoe').val();
           provinciae=$('#provinciae').val();
           paise=$('#paise').val();
           telefonoe=$('#telefonoe').val();
           gerentee=$('#gerentee').val();
           centrale=$('#centrale').val();
                if(direccione===''){   
                    Swal.fire({
                        icon: 'warning',
                        title: 'Falta Completar campo "CUIT"',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                        });
                }else{
                    if(localidade===''){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Falta Completar campo "Presidente"',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                    }else{
                        if(departamentoe===''){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Falta Completar campo "Empresa"',
                                confirmButtonColor: '#ffa361',
                                confirmButtonText: 'Ok',
                            });
                        }else{
                            if(provinciae===''){
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Falta Completar campo "Telefono"',
                                    confirmButtonColor: '#ffa361',
                                    confirmButtonText: 'Ok',
                                });
                            }else{
                                if(paise===''){
                                    Swal.fire({
                                    icon: 'warning',
                                    title: 'Falta Completar campo "Telefono"',
                                    confirmButtonColor: '#ffa361',
                                    confirmButtonText: 'Ok',
                                });
                                }
                                else{
                                    if(telefonoe===''){
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Falta Completar campo "Telefono"',
                                            confirmButtonColor: '#ffa361',
                                            confirmButtonText: 'Ok',
                                        });
                                    }
                                    else{
                                        if(gerentee===''){
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Falta Completar campo "Telefono"',
                                                confirmButtonColor: '#ffa361',
                                                confirmButtonText: 'Ok',
                                            });
                                        }
                                        else{
                                            if(centrale===''){
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Falta Completar campo "Telefono"',
                                                    confirmButtonColor: '#ffa361',
                                                    confirmButtonText: 'Ok',
                                                });
                                            }
                                            else{
                                                cadena="empresae="+empresae+"&direccione="+direccione+"&localidade="+localidade+"&departamentoe="+departamentoe+"&provinciae="+provinciae+"&paise="+paise+"&telefonoe="+telefonoe+"&gerentee="+gerentee+"&centrale="+centrale;
                                                $.ajax({
                                                    type:"POST",
                                                    url:"../db/sucursalesmod.php",
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
                                                            $('#tabla').load('empresastabla.php');
                                                        }
                                                    }
                                                });
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
    }
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
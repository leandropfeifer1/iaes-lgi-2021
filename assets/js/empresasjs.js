function agregardatos(empresa,cuit,presidente,correo,telefono){
    cadena="empresa"+empresa+"&cuit"+cuit+"&presidente"+presidente+"&correo"+correo+"&telefono"+telefono;
    $.ajax({
       type:"POST",
       url:"..\vistas\empresas.php",
       data:cadena,
       succes:function(r){
           if(r==1){
               alertify.success("agregado con exito");
               $('#tabla').load('empresastabla.php');
           }else{
               alertify.error("fallo de guardado");
           }
       }
   });
}
$(document).ready(function(){
    $('#empresas').submit((event) => {
    event.preventDefault();
    const empresa = $.trim($('#empresa').val());
    const cuit = parseInt($.trim($('#cuit').val()));
    const presidente = $.trim($('#presidente').val());
    const correo = $.trim($('#correo').val());
    const telefono = $.trim($('#telefono').val());
    if(
          empresa.length === 0 ||
          typeof empresa === 'undefined' ||
          cuit.length === 0 ||
          typeof cuit === 'undefined' ||
          presidente.length === 0 ||
          typeof presidente === 'undefined' ||
          correo.length === 0 ||
          typeof correo === 'undefined'||
          telefono.length === 0 ||
          typeof telefono === 'undefined'
        ){
          Swal.fire({
            icon: 'warning',
            title: 'Debe completar todos los campos para agregar una Empresa',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
          return false;
        } else {
          $.ajax({
            url: '../db/empresasdb.php',
            type: 'POST',
            datatype: 'json',
            data: {
              empresa: empresa,
              cuit: cuit,
              presidente: presidente,
              correo: correo,
              telefono: telefono,
            },
            success: (datajs) => {
              let data=JSON.parse(datajs);
              if (data == 'false') {
                Swal.fire({
                  icon: 'error',
                  title: 'OOPS! Ha Ocurrido un Error Agregando la Empresa',
                  confirmButtonColor: '#ffa361',
                  confirmButtonText: 'Ok',
                });
              } else {
                Swal.fire({
                  icon: 'success',
                  title: '¡Empresa Agregada Correctamente!',
                  confirmButtonColor: '#ffa361',
                  confirmButtonText: 'Ok',
                }).then((result) => {
                    $('#empresa').val("");
                    $('#cuit').val("");
                    $('#presidente').val("");
                    $('#correo').val("");
                    $('#telefono').val("");
                    });
              }
            },
          });
      }
    });
});

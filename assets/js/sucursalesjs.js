$(document).ready(function(){
    $('#sucursales').submit((event) => {
    event.preventDefault();
    const empresa = parseInt($.trim($('#empresa').val()));
    const direccion = $.trim($('#direccion').val());
    const telefono = $.trim($('#telefono').val());
    const gerente = $.trim($('#gerente').val());
    const localidad = parseInt($.trim($('#localidad').val()));
    const departamento = parseInt($.trim($('#departamento').val()));
    const provincia = parseInt($.trim($('#provincia').val()));
    const pais = parseInt($.trim($('#pais').val()));
    const central = parseInt($.trim($('#central').val()));
    const buscando = parseInt($.trim($('#buscando').val()));
    if(
          empresa.length === 0 ||
          typeof empresa === 'undefined' ||
          direccion.length === 0 ||
          typeof direccion === 'undefined' ||
          telefono.length === 0 ||
          typeof telefono === 'undefined' ||
          gerente.length === 0 ||
          typeof gerente === 'undefined'||
          localidad.length === 0 ||
          typeof localidad === 'undefined' ||
          provincia.length === 0 ||
          typeof provincia === 'undefined'||
          pais.length === 0 ||
          typeof pais === 'undefined' ||
          central.length === 0 ||
          typeof central === 'undefined'||
          buscando.length === 0 ||
          typeof buscando === 'undefined'
        ){
          Swal.fire({
            icon: 'warning',
            title: 'Debe completar todos los campos para agregar una Sucursal',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
          return false;
        } else {
          $.ajax({
            url: '../db/sucursalesdb.php',
            type: 'POST',
            datatype: 'json',
            data: {
              empresa: empresa,
              direccion: direccion,
              telefono: telefono,
              gerente: gerente,
              localidad: localidad,
              departamento: departamento,
              provincia: provincia,
              pais: pais,
              central: central,
              buscando: buscando,
            },
            success: (datajs) => {
              let data=JSON.parse(datajs);
              if (data === 'false') {
                Swal.fire({
                  icon: 'error',
                  title: 'OOPS! Ha Ocurrido un Error Agregando la Sucursal',
                  confirmButtonColor: '#ffa361',
                  confirmButtonText: 'Ok',
                });
              } else {
                Swal.fire({
                  icon: 'success',
                  title: '¡Sucursal Agregada Correctamente!',
                  confirmButtonColor: '#ffa361',
                  confirmButtonText: 'Ok',
                }).then((result) => {                   
                    $('#direccion').val("");
                    $('#gerente').val("");
                    $('#telefono').val("");
                    });
              }
            },
          });
      }
    });
});

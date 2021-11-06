$('#formUser').submit((event) => {
  event.preventDefault();
  const newUsername = $.trim($('#newUsername').val());
  const passwordToConfirm = $.trim($('#confirmUser').val());
  if (newUsername === '' || passwordToConfirm === '') {
    Swal.fire({
      icon: 'warning',
      title: 'Debe ingresar un nuevo Usuario y su Contraseña',
      confirmButtonColor: '#ffa361',
      confirmButtonText: 'Ok',
    });
    return false;
  } else {
    $.ajax({
      url: '../db/editarUserData.php',
      type: 'POST',
      datatype: 'json',
      data: {
        usuario: newUsername,
        password: passwordToConfirm,
      },
      success: (data) => {
        let dataToJson = JSON.parse(data);
        if (dataToJson.verificar === false || dataToJson.error === 'vacio') {
          Swal.fire({
            icon: 'warning',
            title: 'OOPS! La Contraseña ingresada es incorrecta',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
          // 'OOPS! Ha Ocurrido un Error, Verifica que tu contraseña sea correcta',
        } else if (
          dataToJson.usuario === null &&
          dataToJson.error === 'vacio'
        ) {
          Swal.fire({
            icon: 'error',
            title: 'OOPS! Ha Ocurrido un Error',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
        } else {
          Swal.fire({
            icon: 'success',
            title: '¡Usuario Modificado Correctamente!',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: '../db/actualizarSesion.php',
                type: 'GET',
                datatype: 'json',
                data: {
                  usuario: newUsername,
                },
                success: (data) => {
                  let newData = JSON.parse(data); // Paso array de PHP a json
                  if (data !== 'false') {
                    $('#nombreUsuario').text(newData.usuario);
                  }
                  $('#newUsername').val('');
                  $('#confirmUser').val('');
                },
              });
            }
          });
        }
      },
    });
  }
});

$('#formPass').submit((event) => {
  event.preventDefault();
});

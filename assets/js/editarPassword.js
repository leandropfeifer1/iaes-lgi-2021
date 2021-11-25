// Este script no solo edita el password, sino tambien el nombre de usuario

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
        console.log(data);
        let dataToJson = JSON.parse(data);
        if (dataToJson.verificar === false || dataToJson.error === 'vacio') {
          Swal.fire({
            icon: 'warning',
            title: 'La Contraseña ingresada es incorrecta',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
        } else if (
          dataToJson.usuario === 'no se concretó la conexion' ||
          dataToJson.error === 'vacio' ||
          dataToJson.error === 'error al inicio'
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

// Evento Submit de Editar Contraseña
$('#formPass').submit((event) => {
  event.preventDefault();
  const actualPass = $.trim($('#actualPass').val());
  const newPass = $.trim($('#newPass').val());
  const confirmPass = $.trim($('#confirmPass').val());

  if (actualPass === '' || newPass === '' || confirmPass === '') {
    Swal.fire({
      icon: 'warning',
      title: 'Debes completar los 3 campos para continuar',
      confirmButtonColor: '#ffa361',
      confirmButtonText: 'Ok',
    });
    return false;
  } else if (newPass !== confirmPass) {
    Swal.fire({
      icon: 'warning',
      title: 'Las Contraseñas no coinciden',
      confirmButtonColor: '#ffa361',
      confirmButtonText: 'Ok',
    });
    $('#confirmPass').val('');
  } else {
    $.ajax({
      url: '../db/editarUserPassword.php',
      type: 'POST',
      datatype: 'json',
      data: {
        actualPass: actualPass,
        newPass: newPass,
        confirmPass: confirmPass,
      },
      success: (data) => {
        console.log(data);
        let response = JSON.parse(data);
        if (response.verificar === false || response.error === 'vacio') {
          Swal.fire({
            icon: 'warning',
            title: 'La Contraseña ingresada es incorrecta',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
          $('#actualPass').val('');
        } else if (
          response.usuario === 'no se concretó la conexion' ||
          response.error === 'vacio' ||
          response.error === 'error al inicio'
        ) {
          Swal.fire({
            icon: 'error',
            title: 'OOPS! Ha ocurrido un error',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
          $('#actualPass').val('');
          $('#newPass').val('');
          $('#confirmPass').val('');
        } else {
          Swal.fire({
            icon: 'success',
            title: 'Tu Contraseña fue modificada correctamente!',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
          $('#actualPass').val('');
          $('#newPass').val('');
          $('#confirmPass').val('');
        }
      },
    });
  }
});

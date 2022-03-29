$(document).ready(() => {
  $('#recuperarPass').click((event) => {
    const user = $('#idUser').val();
    const idUser = parseInt(user);

    Swal.fire({
      title: 'Submit your Github username',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off',
      },
      showCancelButton: true,
      confirmButtonText: 'Look up',
      showLoaderOnConfirm: true,
      preConfirm: (pass) => {
        $.ajax({
          url: '../db/cambiarPassword.php',
          type: 'POST',
          datatype: 'json',
          data: {
            user: idUser,
            password: pass,
          },
          success: (data) => {
            if (data === 'false') {
              Swal.fire({
                icon: 'error',
                title: 'OOPS! Ese Email no existe en nuestro sistema',
                confirmButtonColor: '#ffa361',
                confirmButtonText: 'Ok',
              });
            } else {
              Swal.fire({
                icon: 'success',
                title: 'Contraseña Cambiada! Ya puedes usarla',
                confirmButtonColor: '#ffa361',
                confirmButtonText: 'Ok',
              });
            }
          },
        });
      },
    });
    // Brackets del OnClick
  });
  // brackets del document.ready
});

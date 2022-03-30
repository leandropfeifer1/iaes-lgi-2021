$(document).ready(() => {
  $('#form_forgot_pass').submit((event) => {
    event.preventDefault();

    const user = $('#idUser').val();
    const idUser = parseInt(user);
    const pass = $('#pass_forgot').val();

    $.ajax({
      url: '../db/cambiarPassword.php',
      type: 'POST',
      datatype: 'json',
      data: {
        user: idUser,
        password: pass,
      },
      success: (data) => {
        console.log('Respuesta:', data);
        if (data === false || data === 'false') {
          Swal.fire({
            icon: 'error',
            title: 'No se pudo cambiar la constraseña',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
        } else {
          Swal.fire({
            icon: 'success',
            title: 'Contraseña cambiada correctamente!',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
          });
        }
      },
      error: (error) => {
        console.error(error);
      },
    });

    // submit
  });
  // document.ready
});

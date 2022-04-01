$(document).ready(() => {
  $('#form_forgot_pass').submit((event) => {
    event.preventDefault();

    const userString = $('#idUser').val();
    const idUser = parseInt(userString);
    const pass = $('#exampleInputEmail1').val();

    $.ajax({
      url: '../db/cambiarPassword.php',
      type: 'POST',
      datatype: 'json',
      data: {
        idUser: idUser,
        pass: pass,
      },
      success: (data) => {
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

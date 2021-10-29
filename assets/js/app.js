$('#formLogin').submit((event) => {
  event.preventDefault();
  const usuario = $.trim($('#usuario').val());
  const password = $.trim($('#password').val());

  if (
    usuario.length === 0 ||
    typeof usuario === 'undefined' ||
    password.length === 0 ||
    typeof password === 'undefined'
  ) {
    Swal.fire({
      icon: 'warning',
      title: 'Debe ingresar un Usuario y/o Contraseña',
    });
    return false;
  } else {
    $.ajax({
      url: './db/login.php',
      type: 'POST',
      datatype: 'json',
      data: {
        usuario: usuario,
        password: password,
      },
      success: (data) => {
        if (data === 'false') {
          Swal.fire({
            icon: 'error',
            title: 'Usuario y/o Contraseña incorrecta',
          });
        } else {
          console.log(data);
          Swal.fire({
            icon: 'success',
            title: '¡Usuario Logeado Correctamente!',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Entrar',
          }).then((result) => {
            if (result.value) {
              window.location.href = './vistas/dashboardAdmin.php';
            }
          });
        }
      },
    });
  }
});

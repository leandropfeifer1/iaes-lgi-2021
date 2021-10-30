$('#formSignUp').submit((event) => {
  event.preventDefault();
  const usuario = $.trim($('#usuario').val());
  const rol = parseInt($.trim($('#select').val()));
  const password = $.trim($('#password').val());
  const passwordConfirm = $.trim($('#passwordConfirm').val());

  if (password !== passwordConfirm) {
    Swal.fire({
      icon: 'warning',
      title: 'OOPS! Las contraseñas no coinciden',
    });
  } else {
    if (
      usuario.length === 0 ||
      typeof usuario === 'undefined' ||
      password.length === 0 ||
      typeof password === 'undefined' ||
      rol.length === 0 ||
      typeof rol === 'undefined' ||
      passwordConfirm.length === 0 ||
      typeof passwordConfirm === 'undefined'
    ) {
      Swal.fire({
        icon: 'warning',
        title: 'Debe Completar Todos los Campos para crear un Usuario',
      });
      return false;
    } else {
      $.ajax({
        url: '../db/signup.php',
        type: 'POST',
        datatype: 'json',
        data: {
          usuario: usuario,
          password: password,
          select: rol,
        },
        success: (data) => {
          if (data === 'false') {
            Swal.fire({
              icon: 'error',
              title: 'OOPS! Ha Ocurrido un Error Creando el Usuario',
            });
          } else {
            Swal.fire({
              icon: 'success',
              title: '¡Usuario Creado Correctamente!',
              confirmButtonColor: '#ffa361',
              confirmButtonText: 'Ok',
            }).then((result) => {
              if (result.value) {
                $('#contenedor').empty();
                $('#contenedor').append(
                  `<div id="card_user">
                    <div class="separador">
                      <label>Usuario: <label>
                      <p class="valor">${usuario}</p>
                    </div>
                    <div class="separador">
                      <label>Contraseña: <label>
                      <p class="valor">${password}</p>
                    </div>
                 </div>`
                );
              }
            });
          }
        },
      });
    }
  }
});

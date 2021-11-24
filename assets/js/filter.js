$('#carrera').change(() => sendRequest());
$('#localidad').change(() => sendRequest());
$('#licencia').change(() => sendRequest());
$('#vehiculo').change(() => sendRequest());
$('#edad').keyup(() => sendRequest());
$('#modalidad').change(() => sendRequest());
$('#genero').change(() => sendRequest());
$('#disponible').change(() => sendRequest());
$('#buscador').keyup(() => sendRequest());

// Funcion para enviar Datos
const sendRequest = () => {
  $('.div-datos').empty();
  const carrera = parseInt($('#carrera').val());
  const localidad = parseInt($('#localidad').val());
  const licencia = parseInt($('#licencia').val());
  const vehiculo = parseInt($('#vehiculo').val());
  let edad = $('#edad').val(); // Es "" si no se pone nada
  const modalidad = parseInt($('#modalidad').val());
  const genero = $('#genero').val(); // es tipo string
  const disponible = parseInt($('#disponible').val());
  let buscador = $('#buscador').val(); // Es "" si no se pone nada

  $.ajax({
    url: '../db/filterData.php',
    type: 'POST',
    datatype: 'json',
    data: {
      carrera: carrera,
      localidad: localidad,
      licencia: licencia,
      vehiculo: vehiculo,
      edad: edad,
      modalidad: modalidad,
      genero: genero,
      disponible: disponible,
      buscador: buscador,
    },
    success: (data) => {
      $('.div-datos').empty();
      let contadorUsuario = 0;
      let disponibilidad = '';

      if (data['data']) {
        data['data'].forEach((user) => {
          contadorUsuario++;

          if (user.situacionlab == 1) {
            disponibilidad = 'Disponible';
          } else {
            disponibilidad = 'No Disponible';
          }
          $('.div-datos').append(
            `<a href="#" class="card">
            <div class="card-header">
              <img src="../assets/logo.jpg" alt="logo" />
            </div>
            <div class="card-body">
              <span class="tag tag-purple">${disponibilidad}</span>
              <h4>
                ${user.usuario} ${user.apellido}
              </h4>
              <p>
                ${capitalizarPrimeraLetra(user.genero)}
              </p>
              <div class="user">
                <div class="user-info">
                  <h5>Id Usuario: ${user.iduser}</h5>
                </div>
              </div>
            </div>
          </a>`
          );
        });
      } else {
        $('.div-datos').empty();
        $('.div-datos').append(`
          <div>No se encontraron Resultados</div>
        `);
      }
    },
    error: (err) => {
      console.log('err');
    },
  });
};

const capitalizarPrimeraLetra = (str) => {
  // Retorna el genero con la primera letra en Mayuscula
  return str.charAt(0).toUpperCase() + str.slice(1);
};

$(document).ready(() => {
  let carrera;
  let localidad;
  let licencia;
  let vehiculo;
  let edad;
  let modalidad;
  let genero;
  let disponible;
  let buscador;

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
    carrera = parseInt($('#carrera').val());
    localidad = parseInt($('#localidad').val());
    licencia = parseInt($('#licencia').val());
    vehiculo = parseInt($('#vehiculo').val());
    edad = $('#edad').val(); // Es "" si no se pone nada
    modalidad = parseInt($('#modalidad').val());
    genero = $('#genero').val(); // es tipo string
    disponible = parseInt($('#disponible').val());
    buscador = $('#buscador').val(); // Es "" si no se pone nada
    let divDatos;
    // console.log('car', carrera);
    // console.log('loc', localidad);
    // console.log('lic', licencia);
    // console.log('veh', vehiculo);
    // console.log('eda', edad);
    // console.log('mod', modalidad);
    // console.log('gen', genero);
    // console.log('dis', disponible);
    // console.log('bus', buscador);
    // console.log('----------------------');

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
        let dataJson = JSON.parse(data);
        divDatos = $('#div-datos');
        console.log(dataJson);
      },
    });
  };
});

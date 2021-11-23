// const carrera;
// const localidad;
// const licencia;
// const vehiculo;
// let edad;
// const modalidad;
// const genero;
// const disponible;
// let buscador;

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
  const carrera = parseInt($('#carrera').val());
  const localidad = parseInt($('#localidad').val());
  const licencia = parseInt($('#licencia').val());
  const vehiculo = parseInt($('#vehiculo').val());
  let edad = $('#edad').val(); // Es "" si no se pone nada
  const modalidad = parseInt($('#modalidad').val());
  const genero = $('#genero').val(); // es tipo string
  const disponible = parseInt($('#disponible').val());
  let buscador = $('#buscador').val(); // Es "" si no se pone nada
  let divDatos;

  // console.log('car', carrera);
  // console.log('loc', localidad);
  // console.log('lic', licencia);
  // console.log('veh', vehiculo);
  // console.log('eda', edad);
  // console.log('mod', modalidad);
  // console.log('gen', genero);
  // console.log('dis', disponible);
  console.log('buscador', buscador);
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
      console.log(data);
    },
  });
};

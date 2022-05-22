$('.div-datos').append(
  `<div class="errorMessage">No se encontraron Resultados</div>`
)
getData() //trae todos los datos desde el inicio
$('#carrera').change(() => sendRequest())
$('#localidad').change(() => sendRequest())
$('#licencia').change(() => sendRequest())
$('#vehiculo').change(() => sendRequest())
$('#edadMin').keyup(() => sendRequest())
$('#edadMax').keyup(() => sendRequest())
$('#edadMin').click(() => sendRequest())
$('#edadMax').click(() => sendRequest())
$('#modalidad').change(() => sendRequest())
$('#genero').change(() => sendRequest())
$('#disponible').change(() => sendRequest())
$('#buscador').keyup(() => sendRequest())
$('#reset').click(() => {
  $('#carrera').val('')
  $('#localidad').val('')
  $('#licencia').val('')
  $('#vehiculo').val('')
  $('#edadMin').val('')
  $('#edadMax').val('')
  $('#modalidad').val('')
  $('#genero').val('')
  $('#disponible').val('')
  $('#buscador').val('')
  sendRequest()
})

function getData() {
  $('.div-datos').empty()
  $.ajax({
    url: '../db/getDataStudents.php',
    type: 'POST',
    datatype: 'json',
    data: {},
    success: (data) => {
      $('.div-datos').empty()
      let disponibilidad = ''
      let classAvailable = ''
      let gender = ''
      let tipoModalidad = ''

      if (data['data']) {
        data['data'].forEach((user) => {
          if (user.situacionlab && user.situacionlab === '1') {
            disponibilidad = 'Disponible'
            classAvailable = 'tag-purple'
          } else {
            disponibilidad = 'No Disponible'
            classNoAvailable = 'tag-red'
          }

          if (user.genero === '1') {
            gender = 'Hombre'
          } else if (user.genero === '2') {
            gender = 'Mujer'
          } else if (user.genero === '3') {
            gender = 'No Binarix'
          } else {
            gender = 'Otro'
          }

          user.modalidad === '1' ? (tipoModalidad = 'Full-Time') : tipoModalidad

          user.modalidad === '2' ? (tipoModalidad = 'Part-Time') : tipoModalidad

          user.modalidad === '3' ? (tipoModalidad = 'Trainee') : tipoModalidad

          user.modalidad === '4' ? (tipoModalidad = 'Pasantías') : tipoModalidad

          if (user.foto) {
            foto = '../db/images/' + user.foto
          } else {
            // foto = '../assets/logo.jpg'
            foto = '../db/images/default.png'
          }
          $('.div-datos').append(
            `<a href="../vistas/vistaUsuario.php?iduser=${user.iduser}" target="_blank" class="card">
              <div class="card-header">
                <img style="object-fit: scale-down;" src="${foto}" alt="${user.usuario} ${user.apellido}" />
              </div>
              <div class="card-body">
                  <span class="tag ${classAvailable}">${disponibilidad}</span>
                  <h4 class="nombreCompleto">
                    ${user.usuario} ${user.apellido} <small>(${user.edad} años)</small>
                  </h4>
                  <p class="modalidadParrafo">
                    ${tipoModalidad}
                  </p>
                  <div class="user">
                    <div class="user-info">
                      <p>${gender}</p>
                    </div>
                  </div>
                  <div class="user-info">
                    <p>Area: ${user.area}</p>
                  </div>
              </div>
          </a>`
          )
          classAvailable = ''
        })
      } else {
        $('.div-datos').empty()
        $('.div-datos').append(`
          <div class="errorMessage">No se encontraron Resultados</div>
        `)
      }
    },
    error: (err) => {
      console.log(err)
    },
  })
}

// Funcion para enviar Datos
const sendRequest = () => {
  $('.div-datos').empty()
  const carrera = parseInt($('#carrera').val())
  console.log(carrera)
  const localidad = parseInt($('#localidad').val())
  const licencia = parseInt($('#licencia').val())
  const vehiculo = parseInt($('#vehiculo').val())
  let edadMinima = $('#edadMin').val() // Es "" si no se pone nada
  let edadMaxima = $('#edadMax').val()
  const modalidad = parseInt($('#modalidad').val())
  const genero = parseInt($('#genero').val())
  const disponible = parseInt($('#disponible').val())
  let buscador = $('#buscador').val() // Es "" si no se pone nada

  edadMinima === '' ? (edadMinima = '1') : edadMinima
  edadMaxima === '' ? (edadMaxima = '1') : edadMaxima
  let edadMin = parseInt(edadMinima)
  let edadMax = parseInt(edadMaxima)
  edadMin >= edadMax ? (edadMax = 99) : edadMax

  $.ajax({
    url: '../db/filterData.php',
    type: 'POST',
    datatype: 'json',
    data: {
      carrera: carrera,
      localidad: localidad,
      licencia: licencia,
      vehiculo: vehiculo,
      edadMin: edadMin,
      edadMax: edadMax,
      modalidad: modalidad,
      genero: genero,
      disponible: disponible,
      buscador: buscador,
    },
    success: (data) => {
      $('.div-datos').empty()
      let disponibilidad = ''
      let classAvailable = ''
      let gender = ''
      let tipoModalidad = ''

      if (data['data']) {
        data['data'].forEach((user) => {
          if (user.situacionlab && user.situacionlab === '1') {
            disponibilidad = 'Disponible'
            classAvailable = 'tag-purple'
          } else {
            disponibilidad = 'No Disponible'
            classNoAvailable = 'tag-red'
          }

          if (user.genero === '1') {
            gender = 'Hombre'
          } else if (user.genero === '2') {
            gender = 'Mujer'
          } else if (user.genero === '3') {
            gender = 'No Binarix'
          } else {
            gender = 'Otro'
          }

          user.modalidad === '1' ? (tipoModalidad = 'Full-Time') : tipoModalidad

          user.modalidad === '2' ? (tipoModalidad = 'Part-Time') : tipoModalidad

          user.modalidad === '3' ? (tipoModalidad = 'Trainee') : tipoModalidad

          user.modalidad === '4' ? (tipoModalidad = 'Pasantías') : tipoModalidad

          if (user.foto) {
            foto = '../db/images/' + user.foto
          } else {
            foto = '../assets/logo.jpg'
          }
          $('.div-datos').append(
            `<a href="../vistas/vistaUsuario.php?iduser=${user.iduser}" target="_blank" class="card">
              <div class="card-header">
                <img src="${foto}" alt="logo" />
              </div>
              <div class="card-body">
                  <span class="tag ${classAvailable}">${disponibilidad}</span>
                  <h4 class="nombreCompleto">
                    ${user.usuario} ${user.apellido} <small>(${user.edad} años)</small>
                  </h4>
                  <p class="modalidadParrafo">
                    ${tipoModalidad}
                  </p>
                  <div class="user">
                    <div class="user-info">
                      <p>${gender}</p>
                    </div>
                  </div>
                  <div class="user-info">
                    <p>Area: ${user.area}</p>
                  </div>
              </div>
          </a>`
          )
          classAvailable = ''
        })
      } else {
        $('.div-datos').empty()
        $('.div-datos').append(`
          <div class="errorMessage">No se encontraron Resultados</div>
        `)
      }
    },
    error: (err) => {
      console.log(err)
    },
  })
}

// Retorna el genero con la primera letra en Mayuscula
const capitalizarPrimeraLetra = (str) => {
  return str.charAt(0).toUpperCase() + str.slice(1)
}

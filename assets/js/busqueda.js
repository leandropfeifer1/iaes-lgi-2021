$(".div-datos").append(
  `<div class="errorMessage">No se encontraron Resultados</div>`
);
$("#empresa").change(() => sendRequest());
$("#sucursal").change(() => sendRequest());
$("#carrera").change(() => sendRequest());
$("#localidad").change(() => sendRequest());
$("#departamento").change(() => sendRequest());
$("#provincia").change(() => sendRequest());
$("#edad").keyup(() => sendRequest());
$("#edad").click(() => sendRequest());
$("#genero").change(() => sendRequest());
$("#disponibilidad").change(() => sendRequest());
$("#buscador").keyup(() => sendRequest());
$("#reset").click(() => {
  $("#empresa").val("");
  $("#sucursal").val("");
  $("#carrera").val("");
  $("#localidad").val("");
  $("#edadMin").val("");
  $("#edadMax").val("");
  $("#genero").val("");
  $("#disponibilidad").val("");
  $("#buscador").val("");
  sendRequest();
});

// Funcion para enviar Datos
const sendRequest = () => {
  $(".div-datos").empty();
  const empresa = parseInt($("#empresa").val());
  const sucursal=parseInt($("#sucursal").val());
  const carrera = parseInt($("#carrera").val()); 
  let edad = $("#edad").val(); // Es "" si no se pone nada
  const genero = parseInt($("#genero").val());
  const disponibilidad = parseInt($("#disponibilidad").val());
  const localidad = parseInt($("#localidad").val());
  const departamento = parseInt($("#departamento").val());
  const provincia= parseInt($("#provincia").val());
  let buscador = $("#buscador").val(); // Es "" si no se pone nada

  $.ajax({    
    url: "../db/busf2.php",
    type: "POST",
    datatype: "json",
    data: {
        empresa: empresa,
        sucursal: sucursal,
        carrera: carrera,
        localidad: localidad,
        departamento: departamento,
        provincia:provincia,
        edad: edad,
        genero: genero,
        disponibilidad: disponibilidad,
        buscador: buscador,
    },
    success: (data) => {
      $(".div-datos").empty();
      let disponibilidad = "";
      let classAvailable = "";
      let gender = "";
      let tipoModalidad = "";
      const busqueda = JSON.parse(data)
      if (busqueda) {
        busqueda.forEach((user) => {
          if (user.situacionlab && user.situacionlab === "1") {
            disponibilidad = "Disponible";
            classAvailable = "tag-purple";
          } else {
            disponibilidad = "No Disponible";
            classNoAvailable = "tag-red";
          }

          if (user.genero === "1") {
            gender = "Hombre";
          } else if (user.genero === "2") {
            gender = "Mujer";
          } else if (user.genero === "3") {
            gender = "No Binarix";
          } else {
            gender = "Otro";
          }

          user.disponibilidad === "1"
            ? (tipoModalidad = "Full-Time")
            : tipoModalidad;

          user.disponibilidad === "2"
            ? (tipoModalidad = "Part-Time")
            : tipoModalidad;

          user.disponibilidad === "3" ? (tipoModalidad = "Trainee") : tipoModalidad;

          user.disponibilidad === "4"
            ? (tipoModalidad = "Pasantías")
            : tipoModalidad;

          $(".div-datos").append(
            `<a="_blank" class="card">
              <div class="card-header">
                <img src="../assets/logo.jpg" alt="logo" />
              </div>
              <div class="card-body">
                  <span class="tag ${classAvailable}">${user.carrera}</span>
                  <h4 class="nombreCompleto">
                    ${user.empresa}  ${user.idsucursal} <small>(${user.localidad}  ${user.provincia})</small>
                  </h4>
                  <p class="modalidadParrafo">
                    Entre ${user.edadmin} y ${user.edadmax} años
                  </p>
                  <div class="user">
                    <div class="user-info">
                      <p>Genero: ${gender}</p>
                    </div>
                  </div>
                  <div class="user-info">
                    <p>Disponibilidad: ${tipoModalidad}</p><button class="btn" onclick="confimaciondel(${user.idbusqueda})">Eliminar</button><p></>
                  </div>
              </div>
          </a>`
          );
          classAvailable = "";
        });
      } else {
        $(".div-datos").empty();
        $(".div-datos").append(`
          <div class="errorMessage">No se encontraron Resultados</div>
        `);
      }
    },
    error: (err) => {
      console.log("err");
    },
  });
};

// Retorna el genero con la primera letra en Mayuscula
const capitalizarPrimeraLetra = (str) => {
  return str.charAt(0).toUpperCase() + str.slice(1);
};
$(document).ready(function(){
    let $provincia = document.querySelector('#provincia')
    let $departamento = document.querySelector('#departamento')
    let $localidad = document.querySelector('#localidad')
    let $empresa = document.querySelector('#empresa')
    let $carrera = document.querySelector('#carrera')
    let $sucursal = document.querySelector('#sucursal')
        cargaremp()      
        sucursales()
        cargacar()
        cargarloc()
        cargaremp()
        cargarpro()
        cargardep()
        
    $("#reset").click(() => {
        cargaremp()      
        sucursales()
        cargacar()
        $("#edadMin").val("");
        $("#edadMax").val("");
        $("#modalidad").val("");
        $("#genero").val("");
        $("#disponible").val("");
        cargarloc()
        cargardep()
        cargarpro()
        $("#buscador").val("");
        sendRequest();
    });

    function cargarpro(){
        $.ajax({
            url: "../db/probus.php",
            type: "GET",
            success: function(res){

                const provincias = JSON.parse(res)
                let template= '<option class="from-control" selected disabled>---</option>'
                provincias.forEach(provincia => {
                    template += `<option value="${provincia.idpro}">${provincia.provincia}</option>`                    
                })
                $provincia.innerHTML= template;                
            }
        });
    }
    function cargardep(){
        $.ajax({
            url: "../db/depbus.php",
            type: "GET",
            success: function(res){
                
                const deparmentos = JSON.parse(res)
                let template= '<option class="from-control" selected disabled>---</option>'
                deparmentos.forEach(departamento => {
                    template += `<option value="${departamento.idep}">${departamento.departamento}</option>`                    
                })
                $departamento.innerHTML= template;                
            }
        });
    }
    function cargarloc(){
        $.ajax({
            url: "../db/busdb.php",
            type: "GET",
            success: function(res){
                
                const localidades = JSON.parse(res)
                let template= '<option class="from-control" selected disabled>---</option>'
                localidades.forEach(localidad => {
                    template += `<option value="${localidad.idloc}">${localidad.localidad}</option>`                    
                })
                $localidad.innerHTML= template;                
            }
        });
    }
    function cargaremp(){
        $.ajax({
            url: "../db/emprebus.php",
            type: "GET",
            success: function(res){                
                const empresas = JSON.parse(res)
                let template= '<option class="from-control" selected disabled>---</option>'
                empresas.forEach(empresa => {
                    template += `<option value="${empresa.idempresa}">${empresa.empresa}</option>`                    
                })
                $empresa.innerHTML= template;                
            }
        });
    }
    function sucursales(){
        $.ajax({
            url: "../db/sucbus.php",
            type: "GET",
            success: function(res){                 
                const sucursales = JSON.parse(res)
                let template= '<option class="from-control" selected disabled>---</option>'
                sucursales.forEach(sucursal => {
                    template += `<option value="${sucursal.idsucursal}">${sucursal.direccion}</option>`                    
                })
                $sucursal.innerHTML= template;                
            }
        });
    }
    function cargarsuc(sendsuc){
        $.ajax({            
            url: "../db/sucbus.php",
            type: "POST",
            data: sendsuc,
            success: function(res){ 
                const sucursales = JSON.parse(res)
                let template= '<option class="from-control" selected disabled>---</option>'
                sucursales.forEach(sucursal => {
                    template += `<option value="${sucursal.idsucursal}">${sucursal.direccion}</option>`                    
                })
                $sucursal.innerHTML= template;                
            }
        });
    }
    function cargacar(){
        $.ajax({
            url: "../db/carbus.php",
            type: "GET",
            success: function(res){                
                const carreras = JSON.parse(res)
                let template= '<option class="from-control" selected disabled>---</option>'
                carreras.forEach(carrera => {
                    template += `<option value="${carrera.idcar}">${carrera.carrera}</option>`                    
                })
                $carrera.innerHTML= template;                
            }
        });
    }

function cargarlocalidades(sendep){        
        $.ajax({
            url: "../db/busdb.php",
            type: "POST",
            data: sendep,
            success: function(res){
                
                const localidades = JSON.parse(res)
                let template= '<option class="from-control" selected disabled>---</option>'
                localidades.forEach(localidad => {
                    template += `<option value="${localidad.idloc}">${localidad.localidad}</option>`                    
                })
                $localidad.innerHTML= template;                 
            }
        });
    }
function cargardep(sendpro){        
        $.ajax({
            url: "../db/depbus.php",
            type: "POST",
            data: sendpro,
            success: function(res){
               
                const deparmentos = JSON.parse(res)
                let template= '<option class="from-control" selected disabled>---</option>'
                deparmentos.forEach(departamento => {
                    template += `<option value="${departamento.idep}">${departamento.departamento}</option>`                    
                })
                $departamento.innerHTML= template;                       
            }
        });
    }
$departamento.addEventListener('change',function(){
        const codped = $departamento.value
        
        const senddep={
            'cdep':codped
        }
        cargarlocalidades(senddep)
    })

$provincia.addEventListener('change',function(){
        const codpro = $provincia.value
        cargarloc()
        const sendpro={
            'cpro':codpro
        }
        cargardep(sendpro)
    })
$empresa.addEventListener('change',function(){
        const idsuc = $empresa.value
        const sendsuc={
            'suc': idsuc
        }
        cargarsuc(sendsuc)
    })

})

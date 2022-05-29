function agregardatos(
  empresa,
  direccion,
  localidad,
  departamento,
  provincia,
  pais,
  telefono,
  gerente,
  central
) {
  datos =
    "&empresa=" +
    empresa +
    "&direccion=" +
    direccion +
    "&localidad=" +
    localidad +
    "&departamento=" +
    departamento +
    "&provincia=" +
    provincia +
    "&pais=" +
    pais +
    "&telefono=" +
    telefono +
    "&gerente=" +
    gerente +
    "&central=" +
    central;
  $.ajax({
    type: "POST",
    url: "../db/sucursalesdb.php",
    data: datos,
    success: function (r) {
      if (r === 1) {
        Swal.fire({
          icon: "success",
          title: "Sucursal Guardada",
          confirmButtonColor: "#ffa361",
          confirmButtonText: "Ok",
        });
        $("tabla").load("sucursalestabla.php");
      } else {
        Swal.fire({
          icon: "success",
          title: "Sucursal Guardada",
          confirmButtonColor: "#ffa361",
          confirmButtonText: "Ok",
        });
        $("#empresa").val('');
        $("#direccion").val('');
        $("#localidad").val('');
        $("#departamento").val('');
        $("#provincia").val('');
        $("#pais").val('');
        $("#telefono").val('');
        $("#gerente").val('');
        $("#central").val('');
        $("#tabla").load("sucursalestabla.php");
      }
    },
  });
}
function agregaform(datos) {
  d = datos.split("||");
  $("#idsucursal").val(d[0]);
  $("#direccione").val(d[1]);
  $("#localidade").val(d[2]);
  $("#departamentoe").val(d[3]);
  $("#provinciae").val(d[4]);
  $("#paise").val(d[5]);
  $("#telefonoe").val(d[6]);
  $("#gerentee").val(d[7]);
  $("#centrale").val(d[8]);
}
function modsucursal() {
  idsucursal = $("#idsucursal").val();
  direccione = $("#direccione").val();
  localidade = $("#localidade").val();
  departamentoe = $("#departamentoe").val();
  provinciae = $("#provinciae").val();
  paise = $("#paise").val();
  telefonoe = $("#telefonoe").val();
  gerentee = $("#gerentee").val();
  centrale = $("#centrale").val();

  if (direccione === "") {
    Swal.fire({
      icon: "warning",
      title: 'Falta Completar campo "Direccion"',
      confirmButtonColor: "#ffa361",
      confirmButtonText: "Ok",
    });
  } else {
    if (localidade === "") {
      Swal.fire({
        icon: "warning",
        title: 'Falta Completar campo "localidad"',
        confirmButtonColor: "#ffa361",
        confirmButtonText: "Ok",
      });
    } else {
      if (departamentoe === "") {
        Swal.fire({
          icon: "warning",
          title: 'Falta Completar campo "Departamento"',
          confirmButtonColor: "#ffa361",
          confirmButtonText: "Ok",
        });
      } else {
        if (provinciae === "") {
          Swal.fire({
            icon: "warning",
            title: 'Falta Completar campo "Provincia"',
            confirmButtonColor: "#ffa361",
            confirmButtonText: "Ok",
          });
        } else {
          if (paise === "") {
            Swal.fire({
              icon: "warning",
              title: 'Falta Completar campo "pais"',
              confirmButtonColor: "#ffa361",
              confirmButtonText: "Ok",
            });
          } else {
            if (telefonoe === "") {
              Swal.fire({
                icon: "warning",
                title: 'Falta Completar campo "Telefono"',
                confirmButtonColor: "#ffa361",
                confirmButtonText: "Ok",
              });
            } else {
              if (gerentee === "") {
                Swal.fire({
                  icon: "warning",
                  title: 'Falta Completar campo "gerente"',
                  confirmButtonColor: "#ffa361",
                  confirmButtonText: "Ok",
                });
              } else {
                if (centrale === "") {
                  Swal.fire({
                    icon: "warning",
                    title: 'Falta Completar campo "central"',
                    confirmButtonColor: "#ffa361",
                    confirmButtonText: "Ok",
                  });
                } else {
                  cadena =
                    "&empresa=" +
                    empresa +
                    "&idsucursal=" +
                    idsucursal +
                    "&direccion=" +
                    direccione +
                    "&localidad=" +
                    localidade +
                    "&departamento=" +
                    departamentoe +
                    "&provincia=" +
                    provinciae +
                    "&pais=" +
                    paise +
                    "&telefono=" +
                    telefonoe +
                    "&gerente=" +
                    gerentee +
                    "&central=" +
                    centrale;
                  $.ajax({
                    type: "POST",
                    url: "../db/sucursalesmod.php",
                    data: cadena,
                    success: function (r) {
                      if (r == 1) {
                        Swal.fire({
                          icon: "success",
                          title: "Modificacion Exitosa",
                          confirmButtonColor: "#ffa361",
                          confirmButtonText: "Ok",
                        });
                        $("#idsucursal").val('');
                        $("#direccione").val('');
                        $("#localidade").val('');
                        $("#departamentoe").val('');
                        $("#provinciae").val('');
                        $("#paise").val('');
                        $("#telefonoe").val('');
                        $("#gerentee").val('');
                        $("#centrale").val('');
                        $("#tabla").load("sucursalestabla.php");
                      } else {
                        alert("Fallo la Modificacion");
                      }
                    }
                  });
                }
              }
            }
          }
        }
      }
    }
  }
}

function confirmaciondel(idsucursal) {
  Swal.fire({
    title: "Confirme",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      borrar(idsucursal);
      $("#tabla").load("sucursalestabla.php");
      Swal.fire("Deleted!", "Your file has been deleted.", "success");
    }
  });
}
function borrar(idsucursal) {
  cadena = "idsucursal=" + idsucursal;
  $.ajax({
    type: "POST",
    url: "../db/sucursalesdel.php",
    data: cadena,
  });
}
function busqueda(idsucursal) {
  cadena = "idsucursal=" + idsucursal;
  $.ajax({
    type: "POST",
    url: "../db/sucbus.php",
    data: cadena,
  });
  $("tabla").load("sucursalestabla.php");
}
$(document).ready(function () {
  let $provincia = document.querySelector('#provincia')
  let $departamento = document.querySelector('#departamento')
  let $localidad = document.querySelector('#localidad')
  let $pais = document.querySelector('#pais')

  /*
    const codpais = $pais.value
      const sendpais = {
        'cpais': codpais
      }
      cargarprovincia(sendpais)
  
  
      const codped = $departamento.value
      const senddep = {
        'cdep': codped
      }
      cargarlocalidades(senddep)
  
      const codpro = $provincia.value
      const sendpro = {
        'cpro': codpro
      }
      cargardep(sendpro)
  */
  function cargarpro() {
    $.ajax({
      url: "../db/probus.php",
      type: "GET",
      success: function (res) {

        const provincias = JSON.parse(res)
        let template = '<option class="from-control" selected disabled>---</option>'
        provincias.forEach(provincia => {
          template += `<option value="${provincia.idpro}">${provincia.provincia}</option>`
        })
        $provincia.innerHTML = template;
      }
    });
  }
  /*
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
  }*/
  function cargarloc() {
    $.ajax({
      url: "../db/busdb.php",
      type: "GET",
      success: function (res) {

        const localidades = JSON.parse(res)
        let template = '<option class="from-control" selected disabled>---</option>'
        localidades.forEach(localidad => {
          template += `<option value="${localidad.idloc}">${localidad.localidad}</option>`
        })
        $localidad.innerHTML = template;
      }
    });
  }

  function cargarlocalidades(sendep) {
    $.ajax({
      url: "../db/busdb.php",
      type: "POST",
      data: sendep,
      success: function (res) {

        const localidades = JSON.parse(res)
        let template = '<option class="from-control" selected disabled>---</option>'
        localidades.forEach(localidad => {
          template += `<option value="${localidad.idloc}">${localidad.localidad}</option>`
        })
        $localidad.innerHTML = template;
      }
    });
  }
  function cargardep(sendpro) {
    $.ajax({
      url: "../db/depbus.php",
      type: "POST",
      data: sendpro,
      success: function (res) {

        const deparmentos = JSON.parse(res)
        let template = '<option class="from-control" selected disabled>---</option>'
        deparmentos.forEach(departamento => {
          template += `<option value="${departamento.idep}">${departamento.departamento}</option>`
        })
        $departamento.innerHTML = template;
      }
    });
  }
  function cargarprovincia(sendpais) {
    $.ajax({
      url: "../db/probus.php",
      type: "POST",
      data: sendpais,
      success: function (res) {

        const provincia = JSON.parse(res)
        let template = '<option class="from-control" selected disabled>---</option>'
        provincia.forEach(provincia => {
          template += `<option value="${provincia.idpro}">${provincia.provincia}</option>`
        })
        $provincia.innerHTML = template;
      }
    });
  }
  //-----------------------------------------------------PAIS
  $pais.addEventListener('change', function () {
    const codpais = $pais.value
    const codpro = 0
    const codped = 0

    const sendpais = {
      'cpais': codpais
    }
    cargarprovincia(sendpais)
   
    const sendpro = {
      'cpro': codpro
    }
    cargardep(sendpro)
    
    const senddep = {
      'cdep': codped
    }
    cargarlocalidades(senddep)
  })

  //-----------------------------------------------------PROVINCIA
  $provincia.addEventListener('change', function () {
    const codpro = $provincia.value
    const codped = 0
    
    const sendpro = {
      'cpro': codpro
    }
    cargardep(sendpro)
    
    const senddep = {
      'cdep': codped
    }
    cargarlocalidades(senddep)
  })

  //-----------------------------------------------------DEPARTAMENTO
  $departamento.addEventListener('change', function () {
    const codped = $departamento.value
    const senddep = {
      'cdep': codped
    }
    cargarlocalidades(senddep)
  })  
})
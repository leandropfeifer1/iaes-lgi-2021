function agregardatos(
  sucursal,
  edadmin,
  edadmax,
  carrera,
  genero,
  disponibilidad,
  requisitos,
  sueldo
) {
console.log(sueldo);
  datos =
    "&sueldo=" +
    sueldo+
    "&sucursal=" +
    sucursal +
    "&edadmin=" +
    edadmin +
    "&edadmax=" +
    edadmax +
    "&carrera=" +
    carrera +
    "&genero="+
    genero +
    "&disponibilidad="+
    disponibilidad +
    "&requisitos=" +
    requisitos    

  $.ajax({      
    type: "POST",
    url: "../db/signbus.php",
    data: datos,
    
    success: function (r) {
      console.log(r)
      if (r === "1") {
        Swal.fire({
          icon: "success",
          title: "Busqueda Guardada",
          confirmButtonColor: "#ffa361",
          confirmButtonText: "Ok",
        });        
      } else {
        Swal.fire({
          icon: "warning",
          title: "Fallo al Guardar",
          confirmButtonColor: "#ffa361",
          confirmButtonText: "Ok",
        });
        $("#sucursal").val('');
        $("#edadmin").val('');
        $("#edadmax").val('');
        $("#carrera").val('');
        $("#genero").val('');
        $("#requisitos").val('');
        $("#disponibilidad").val('');
        $("#sueldo").val('');
      }
    },
  });
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
$(document).ready(function () {
    let $empresa = document.querySelector('#empresa')
    let $carrera = document.querySelector('#carrera')
    let $sucursal = document.querySelector('#sucursal')
    cargaremp()
    cargacar()
    cargaremp()

    $("#reset").click(() => {
        cargaremp()
        sucursales()
        cargacar()
        $("#edadMin").val("");
        $("#edadMax").val("");
        $("#modalidad").val("");
        $("#genero").val("");
        $("#sueldo").val("");
        $("#disponible").val("");
        $("#buscador").val("");
        sendRequest();
    });
    function cargaremp() {
        $.ajax({
            url: "../db/emprebus.php",
            type: "GET",
            success: function (res) {
                const empresas = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                empresas.forEach(empresa => {
                    template += `<option value="${empresa.idempresa}">${empresa.empresa}</option>`
                })
                $empresa.innerHTML = template;
            }
        });
    }
    function sucursales() {
        $.ajax({
            url: "../db/sucbus.php",
            type: "GET",
            success: function (res) {
                const sucursales = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                sucursales.forEach(sucursal => {
                    template += `<option value="${sucursal.idsucursal}">${sucursal.direccion}</option>`
                })
                $sucursal.innerHTML = template;
            }
        });
    }
    function cargarsuc(senemp) {
        $.ajax({
            url: "../db/sucbus.php",
            type: "POST",
            data: senemp,
            success: function (res) {
                const sucursales = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                sucursales.forEach(sucursal => {
                    template += `<option value="${sucursal.idsucursal}">${sucursal.direccion}</option>`
                })
                $sucursal.innerHTML = template;
            }
        });
    }
    function cargacar() {
        $.ajax({
            url: "../db/carbus.php",
            type: "GET",
            success: function (res) {
                const carreras = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                carreras.forEach(carrera => {
                    template += `<option value="${carrera.idcar}">${carrera.carrera}</option>`
                })
                $carrera.innerHTML = template;
            }
        });
    }
$empresa.addEventListener('change',function(){
        const codpais = $empresa.value
        const senemp={
            'cemp':codpais
        }
        cargarsuc(senemp)
})
})
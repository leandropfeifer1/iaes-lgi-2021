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
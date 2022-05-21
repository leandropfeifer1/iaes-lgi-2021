function log(lg) {
  if (lg) {
    $.ajax({
      url: "../db/foto.php",
      type: "POST",
      datatype: "json",
      data: lg,
      contentType: false,
      processData: false,
      success: (data) => {
        console.log(data);
      },
    });
  }

}
function agregardatos(empresa, cuit, presidente, correo, telefono, logo) {
  cadena =
    "empresa=" +
    empresa +
    "&cuit=" +
    cuit +
    "&presidente=" +
    presidente +
    "&correo=" +
    correo +
    "&telefono=" +
    telefono +
    "&logo=" +
    logo;
  $.ajax({
    type: "POST",
    url: "../db/empresasdb.php",
    data: cadena,
    success: function (r) {
      if (r == 1) {
        Swal.fire({
          icon: "success",
          title: "Empresa Guardada",
          confirmButtonColor: "#ffa361",
          confirmButtonText: "Ok",
        });
        $("#empresa").val("");
        $("#cuit").val("");
        $("#cuit").val("");
        $("#presidente").val("");
        $("#correo").val("");
        $("#telefono").val("");
        $("#tabla").load("empresastabla.php");
      } else {
        alert("Fallo");
      }
    },
  });
  return false;
}

function agregaform(datos) {
  d = datos.split("||");
  $("#idempresa").val(d[0]);
  $("#empresae").val(d[1]);
  $("#cuite").val(d[2]);
  $("#presidentee").val(d[3]);
  $("#correoe").val(d[4]);
  $("#telefonoe").val(d[5]);
}

function modificar(lg) {
  idempresa = $("#idempresa").val();
  empresae = $("#empresae").val();
  cuite = $("#cuite").val();
  presidentee = $("#presidentee").val();
  correoe = $("#correoe").val();
  telefonoe = $("#telefonoe").val();

  if ($("#logomod").val()) {
    var lg = new FormData();
    var files = $("#logomod")[0].files;
    var f1 = files[0];
    var logo = f1["name"];

    cadena =
      "&logo=" +
      logo;

    $.ajax({
      type: "POST",
      async: false,
      url: "../db/cadenaAleatoria.php",
      data: cadena,
      success: function (response) {
        console.log(response);
        logomod = response;
      },
    });
    logomod = logomod.replace(/['"]+/g, '');
    // Check file selected or not
    if (files.length > 0) {
      lg.append("logom", files[0]);
      lg.append("logomod", logomod);
    }
    log(lg);
  } else {
    var logomod = 0;
  }

  if (empresae === "") {
    Swal.fire({
      icon: "warning",
      title: 'Falta Completar campo "Empresa"',
      confirmButtonColor: "#ffa361",
      confirmButtonText: "Ok",
    });
  } else {
    if (cuite === "") {
      Swal.fire({
        icon: "warning",
        title: 'Falta Completar campo "CUIT"',
        confirmButtonColor: "#ffa361",
        confirmButtonText: "Ok",
      });
    } else {
      if (presidentee === "") {
        Swal.fire({
          icon: "warning",
          title: 'Falta Completar campo "Presidente"',
          confirmButtonColor: "#ffa361",
          confirmButtonText: "Ok",
        });
      } else {
        if (correoe === "") {
          Swal.fire({
            icon: "warning",
            title: 'Falta Completar campo "Empresa"',
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
            cadena =
              "idempresa=" +
              idempresa +
              "&empresa=" +
              empresae +
              "&cuit=" +
              cuite +
              "&presidente=" +
              presidentee +
              "&correo=" +
              correoe +
              "&telefono=" +
              telefonoe +
              "&logo=" +
              logomod;
            $.ajax({
              type: "POST",
              url: "../db/empresasmod.php",
              data: cadena,
              success: function (r) {
                console.log(r);
                if (r == '1') {
                  Swal.fire({
                    icon: "success",
                    title: "Modificacion Exitosa",
                    confirmButtonColor: "#ffa361",
                    confirmButtonText: "Ok",
                  });
                  $("#tabla").load("empresastabla.php");
                } else {
                  alert("Fallo la Modificacion");
                }
              },
            });
          }
        }
      }
    }
  }
}

function confirmaciondel(idempresa) {
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
      borrar(idempresa);
      $("#tabla").load("empresastabla.php");
      Swal.fire("Deleted!", "Your file has been deleted.", "success");
    }
  });
}

function borrar(idempresa) {
  cadena = "idempresa=" + idempresa;
  $.ajax({
    type: "POST",
    url: "../db/empresasdel.php",
    data: cadena,
  });
  $("#tabla").load("empresastabla.php");
}

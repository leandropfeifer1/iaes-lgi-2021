function agregardatos(
  sucursal,
  edadmin,
  edadmax,
  carrera,
  genero,
  requisitos,
) {
  datos =
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
    "&requisitos=" +
    requisitos,    
  $.ajax({
    type: "POST",
    url: "../db/signbus.php",
    data: datos,
    
    success: function (r) {
      console.log(r)
      if (r === "1") {
        Swal.fire({
          icon: "success",
          title: "Sucursal Guardada",
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
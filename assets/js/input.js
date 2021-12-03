$(document).ready(function () {
  //let id = 213;
  var iduser = document.getElementById("iduser");
  let id = iduser.value;
  $.post("../db/mostrar_reg.php", { id }, function (response) {
    if (response) {
      const datos = JSON.parse(response);
      $("#usuario").val(datos.usuario);
      $("#apellido").val(datos.apellido);
      $("#email").val(datos.correo);
      $("#dni").val(datos.dni);
      $("#fechanacimiento").val(datos.fechanacimiento);
      $("#contacto").val(datos.contacto);
      $("#localidad").val(datos.localidad);
      $("#departamento").val(datos.departamento);
      $("#provincia").val(datos.provincia);
      $("#idpais").val(datos.idpais);
      $("#codpostal").val(datos.codpostal);
      $("#domicilio").val(datos.domicilio);
      $("#discapacidades").val(datos.discapacidades);
      $("#habilidades").val(datos.habilidades);
      $("#cursos").val(datos.cursos);
      $("#progs").val(datos.progs);
      $("#puestodeseado").val(datos.puestodeseado);
      $("#area").val(datos.area);
      $("#salariomin").val(datos.salariomin);
      $("#discapacidades").val(datos.discapacidades);

      if (datos.genero == $("#g1").val()) {
        $("#g1").prop("checked", true);
      } else if (datos.genero == $("#g2").val()) {
        $("#g2").prop("checked", true);
      } else if (datos.genero == $("#g3").val()) {
        $("#g3").prop("checked", true);
      } else if (datos.genero == $("#g4").val()) {
        $("#g4").prop("checked", true);
      }

      if (datos.ecivil == $("#e1").val()) {
        $("#e1").prop("selected", true);
      } else if (datos.ecivil == $("#e2").val()) {
        $("#e2").prop("selected", true);
      } else if (datos.ecivil == $("#e3").val()) {
        $("#e3").prop("selected", true);
      }

      switch (datos.licencia) {
        case "2":
          $("#licsi").prop("checked", true);
          var d = document.getElementById("auto");
          d.style.display = "block";
          break;
        case "1":
          $("#licno").prop("checked", true);
          var d = document.getElementById("auto");
          d.style.display = "none";
          break;
      }

      switch (datos.auto) {
        case "2":
          $("#vsi").prop("checked", true);
          break;
        case "1":
          $("#vno").prop("checked", true);
          break;
      }

      switch (datos.situacionlab) {
        case "":
          $("#s1").prop("selected", true);
          break;
        case "1":
          $("#s2").prop("selected", true);
          break;
        case "2":
          $("#s3").prop("selected", true);
          break;
      }
      //console.log(datos.modalidad);
      switch (datos.modalidad) {
        case "0":
          $("#m0").prop("selected", true);
          break;
        case "1":
          $("#m1").prop("selected", true);
          break;
        case "2":
          $("#m2").prop("selected", true);
          break;
        case "3":
          $("#m3").prop("selected", true);
          break;
        case "4":
          $("#m4").prop("selected", true);
          break;
        case "5":
          $("#m5").prop("selected", true);
          break;
        case "6":
          $("#m6").prop("selected", true);
          break;
      }

      switch (datos.dispoviajar) {
        case "2":
          $("#dvsi").prop("checked", true);
          break;
        case "1":
          $("#dvno").prop("checked", true);
          break;
      }

      switch (datos.dispomuda) {
        case "2":
          $("#dcsi").prop("checked", true);
          break;
        case "1":
          $("#dcno").prop("checked", true);
          break;
      }

      edit = true;
    }
  });

  $.post("../db/mostrar_carrera.php", { id }, function (response) {
    if (response) {
      //console.log(response);
      const datos = JSON.parse(response);
      switch (datos.idcar) {
        case "":
          $("#c1").prop("selected", true);
          break;
        case "1":
          $("#c2").prop("selected", true);
          break;
        case "2":
          $("#c3").prop("selected", true);
          break;
        case "3":
          $("#c4").prop("selected", true);
          break;
        case "4":
          $("#c5").prop("selected", true);
          break;
      }
    }
    edit = true;
  });
});

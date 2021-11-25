$(document).ready(function () {
  //let id = 213;
  var iduser = document.getElementById("iduser");
  let id = iduser.value;
  $.post("mostrar_reg.php", { id }, function (response) {
    if(response){
      const datos = JSON.parse(response);
    //console.log(response);
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
    $("#detdiscapacidad").val(datos.detdiscapacidad);


    //$("#foto").val(datos.foto);
    //console.log(datos.foto);
    //$("#pdf").val(datos.pdf);
    //console.log(datos.pdf);


    $("#cursos").val(datos.cursos);
    $("#progs").val(datos.progs);
    $("#puestodeseado").val(datos.puestodeseado);
    $("#area").val(datos.area);
    $("#salariomin").val(datos.salariomin);

    //$("#genero").val(datos.genero);
    //console.log(datos.genero);
    if (datos.genero == $("#g1").val()) {
      console.log("asdasd");
      $("#g1").prop("checked", true);
    } else if (datos.genero == $("#g2").val()) {
      $("#g2").prop("checked", true);
    } else if (datos.genero == $("#g3").val()) {
      $("#g3").prop("checked", true);
    }

    //console.log($("#e2").val());
    if (datos.ecivil == $("#e1").val()) {
      $("#e1").prop("selected", true);
    } else if (datos.ecivil == $("#e2").val()) {
      $("#e2").prop("selected", true);
    } else if (datos.ecivil == $("#e3").val()) {
      $("#e3").prop("selected", true);
    }

    //$("#licencia").val(datos.licencia);
    switch (datos.licencia) {
      case "1":
        $("#licsi").prop("checked", true);
        var d = document.getElementById("auto");
        d.style.display = "block";
        break;
      case "0":
        $("#licno").prop("checked", true);
        var d = document.getElementById("auto");
        d.style.display = "none";
        break;
    }

    //$("#auto").val(datos.auto);
    switch (datos.auto) {
      case "1":
        $("#vsi").prop("checked", true);
        break;
      case "0":
        $("#vno").prop("checked", true);
        break;
    }

    //$("#discapacidades").val(datos.discapacidades);
    switch (datos.discapacidad) {
      case "1":
        var d = document.getElementById("disc");
        d.style.display = "block";
        $("#discsi").prop("checked", true);
        //console.log(datos.discapacidad);
        $("#discapacidades").val(datos.detdiscapacidad);
        break;
      case "0":
        $("#discno").prop("checked", true);
        break;
    }

    //$("#niveledu").val(datos.niveledu);
    //console.log(datos.niveledu);
    switch (datos.niveledu) {
      case "Terciario incompleto":
        $("#n1").prop("checked", true);
        break;
      case "Terciario completo":
        $("#n2").prop("checked", true);
        break;
      case "Universitario incompleto":
        $("#n3").prop("checked", true);
        break;
      case "Universitario completo":
        $("#n4").prop("checked", true);
        break;
    }

    //$("#situacionlab").val(datos.situacionlab);
    //console.log(datos.situacionlab);
    switch (datos.situacionlab) {
      case "":
        $("#s1").prop("selected", true);
        break;
      case "0":
        $("#s2").prop("selected", true);
        break;
      case "1":
        $("#s3").prop("selected", true);
        break;
    }

    //$("#dispoviajar").val(datos.dispoviajar);
    switch (datos.dispoviajar) {
      case "1":
        $("#dvsi").prop("checked", true);
        break;
      case "0":
        $("#dvno").prop("checked", true);
        break;
    }

    //$("#dispomuda").val(datos.dispomuda);
    switch (datos.dispomuda) {
      case "1":
        $("#dcsi").prop("checked", true);
        break;
      case "0":
        $("#dcno").prop("checked", true);
        break;
    }

    switch (datos.carrera) {
      case "":
        $("#c1").prop("selected", true);
        break;
      case "1":
        $("#c2").prop("selected", true);
        break;
      case "2":
        $("#c3").prop("selected", true);
        break;
    }

    //$('#puesto').val(exp.puesto);

    edit = true;
    }
    
  });

  
  $.post("mostrar_carrera.php", { id }, function (response) {
    if(response){
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

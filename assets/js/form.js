$(document).ready(function () {
  var form_count = 1,
    previous_form,
    next_form,
    total_forms;
  total_forms = $("fieldset").length;
  //-----------------------------------------------------------------------------------------------------------------
  $("#sig1").click(function () {
    var dni_validation = /^\d{8}$/;

    if ($.trim($("#usuario").val()).length == 0) {
      error_usuario = "Complete este campo";
      $("#error_usuario").text(error_usuario);
      $("#usuario").addClass("has-error");
    } else {
      error_usuario = "";
      $("#error_usuario").text(error_usuario);
      $("#usuario").removeClass("has-error");
    }

    if ($.trim($("#apellido").val()).length == 0) {
      error_apellido = "Complete este campo";
      $("#error_apellido").text(error_apellido);
      $("#apellido").addClass("has-error");
    } else {
      error_apellido = "";
      $("#error_apellido").text(error_apellido);
      $("#apellido").removeClass("has-error");
    }

    if ($.trim($("#dni").val()).length == 0) {
      error_dni = "Complete este campo";
      $("#error_dni").text(error_dni);
      $("#dni").addClass("has-error");
    } else {
      if (!dni_validation.test($("#dni").val())) {
        error_dni = "Dni invalido!";
        $("#error_dni").text(error_dni);
        $("#dni").addClass("has-error");
      } else {
        error_dni = "";
        $("#error_dni").text(error_dni);
        $("#dni").removeClass("has-error");
      }
    }

    if ($.trim($("#email").val()).length == 0) {
      error_email = "Complete este campo";
      $("#error_email").text(error_email);
      $("#email").addClass("has-error");
    } else {
      error_email = "";
      $("#error_email").text(error_email);
      $("#email").removeClass("has-error");
    }

    if ($.trim($("#fechanacimiento").val()).length == 0) {
      error_fechanacimiento = "Complete este campo";
      $("#error_fechanacimiento").text(error_fechanacimiento);
      $("#fechanacimiento").addClass("has-error");
    } else {
      error_fechanacimiento = "";
      $("#error_fechanacimiento").text(error_fechanacimiento);
      $("#fechanacimiento").removeClass("has-error");
      if ($.trim($("#fechanacimiento").val()) <= "1950-01-01") {
        error_fechanacimiento = "Fecha invalida";
        $("#error_fechanacimiento").text(error_fechanacimiento);
        $("#fechanacimiento").addClass("has-error");
      } else {
        error_fechanacimiento = "";
        $("#error_fechanacimiento").text(error_fechanacimiento);
        $("#fechanacimiento").removeClass("has-error");
      }
    }

    if ($.trim($("#genero").val()).length == 0) {
      error_genero = "Complete este campo";
      $("#error_genero").text(error_genero);
      $("#genero").addClass("has-error");
    } else {
      error_genero = "";
      $("#error_genero").text(error_genero);
      $("#genero").removeClass("has-error");
    }

    if (!$("input[name='genero']:radio").is(":checked")) {
      error_genero = "Complete este campo";
      $("#error_genero").text(error_genero);
      $("#genero").addClass("has-error");
    } else {
      error_genero = "";
      $("#error_genero").text(error_genero);
      $("#genero").removeClass("has-error");
    }

    if ($.trim($("#contacto").val()).length == 0) {
      error_contacto = "Complete este campo";
      $("#error_contacto").text(error_contacto);
      $("#contacto").addClass("has-error");
    } else {
      error_contacto = "";
      $("#error_contacto").text(error_contacto);
      $("#contacto").removeClass("has-error");
    }

    if ($.trim($("#domicilio").val()).length == 0) {
      error_domicilio = "Complete este campo";
      $("#error_domicilio").text(error_domicilio);
      $("#domicilio").addClass("has-error");
    } else {
      error_domicilio = "";
      $("#error_domicilio").text(error_domicilio);
      $("#domicilio").removeClass("has-error");
    }

    if ($.trim($("#localidad").val()).length == 0) {
      error_localidad = "Complete este campo";
      $("#error_localidad").text(error_localidad);
      $("#localidad").addClass("has-error");
    } else {
      error_localidad = "";
      $("#error_localidad").text(error_localidad);
      $("#localidad").removeClass("has-error");
    }

    if ($.trim($("#departamento").val()).length == 0) {
      error_departamento = "Complete este campo";
      $("#error_departamento").text(error_departamento);
      $("#departamento").addClass("has-error");
    } else {
      error_departamento = "";
      $("#error_departamento").text(error_departamento);
      $("#departamento").removeClass("has-error");
    }

    if ($.trim($("#provincia").val()).length == 0) {
      error_provincia = "Complete este campo";
      $("#error_provincia").text(error_provincia);
      $("#provincia").addClass("has-error");
    } else {
      error_provincia = "";
      $("#error_provincia").text(error_provincia);
      $("#provincia").removeClass("has-error");
    }

    if ($.trim($("#pais").val()).length == 0) {
      error_pais = "Complete este campo";
      $("#error_pais").text(error_pais);
      $("#pais").addClass("has-error");
    } else {
      error_pais = "";
      $("#error_pais").text(error_pais);
      $("#pais").removeClass("has-error");
    }

    if (!$("input[name='licencia']:radio").is(":checked")) {
      error_licencia = "Complete este campo";
      $("#error_licencia").text(error_licencia);
      $("#licencia").addClass("has-error");
    } else {
      error_licencia = "";
      $("#error_licencia").text(error_licencia);
      $("#liceerror_licencia").removeClass("has-error");
      if ($("#licsi").is(":checked")) {
        if (!$("input[name='auto']:radio").is(":checked")) {
          error_auto = "";
          $("#error_licencia").text(error_auto);
          $("#licencia").removeClass("has-error");
        } else {
          error_auto = "";
          $("#error_auto").text(error_auto);
          $("#liceerror_auto").removeClass("has-error");
        }
      }
    }

    if (
      error_usuario != "" ||
      error_apellido != "" ||
      error_email != "" ||
      error_dni != "" ||
      error_fechanacimiento != "" ||
      error_genero != "" ||
      error_contacto != "" ||
      error_domicilio != "" ||
      error_localidad != "" ||
      error_departamento != "" ||
      error_provincia != "" ||
      error_pais != ""
    ) {
      error = " Campos faltantes o invalidos*";
      $("#error").text(error);
      $("#error").addClass("has-error");
      return false;
    } else {
      error = "";
      $("#error").text(error);
      $("#error").removeClass("has-error");
    }

    previous_form = $(this).parent();
    next_form = $(this).parent().next();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(++form_count);
  });
  //-----------------------------------------------------------------------------------------------------------------
  $("#sig2").click(function () {
    if ($.trim($("#carh").val()).length == 0) {
      error_carh = "Complete este campo";
      $("#error_carh").text(error_carh);
      $("#carh").addClass("has-error");
    } else {
      error_carh = "";
      $("#error_carh").text(error_carh);
      $("#carh").removeClass("has-error");
    }

    if (error_carh != "") {
      error = " Campos faltantes o invalidos*";
      $("#error2").text(error);
      $("#error2").addClass("has-error");
      return false;
    } else {
      error = "";
      $("#error2").text(error);
      $("#error2").removeClass("has-error");
    }

    previous_form = $(this).parent();
    next_form = $(this).parent().next();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(++form_count);
  });

  $("#sig3").click(function () {
    previous_form = $(this).parent();
    next_form = $(this).parent().next();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(++form_count);
  });
  //-----------------------------------------------------------------------------------------------------------------
  $("#sig4").click(function () {
    var error_idiomas = "";

    // Obtener hijos dentro de etiqueta <div>
    var cont = document.getElementById("idiomas").children;
    var i = 0;
    var al_menos_uno = false;
    //Recorrido de checkbox's
    while (i < cont.length) {
      // Verifica si el elemento es un checkbox
      if (cont[i].tagName == "INPUT" && cont[i].type == "checkbox") {
        // Verifica si esta checked
        if (cont[i].checked) {
          al_menos_uno = true;
        }
      }
      i++;
    }   


    if (!al_menos_uno) {
      error = " Campos faltantes o invalidos*";
      $("#error3").text(error);
      $("#error3").addClass("has-error");

      error_idiomas = "Complete este campo";
      $("#error_idiomas").text(error_idiomas);
      $("#idiomas").addClass("has-error");
      return false;
    } else {
      error = "";
      $("#error3").text(error);
      $("#error3").removeClass("has-error");

      error_idiomas = "";
      $("#error_idiomas").text(error_idiomas);
      $("#idiomas").removeClass("has-error");
    }

    previous_form = $(this).parent();
    next_form = $(this).parent().next();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(++form_count);
  });
  //-----------------------------------------------------------------------------------------------------------------
  $(".previous-form").click(function () {
    previous_form = $(this).parent();
    next_form = $(this).parent().prev();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(--form_count);
  });
  //-----------------------------------------------------------------------------------------------------------------
  setProgressBarValue(form_count);
  function setProgressBarValue(value) {
    var percent = parseFloat(100 / total_forms) * value;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width", percent + "%")
      .html(percent + "%");
  }

  //-----------------------------------------------------------------------------------------------------------------
  $("#register_form").submit(function (event) {
    event.preventDefault();

    if ($.trim($("#slaboral").val()).length == 0) {
      error_slaboral = "Complete este campo";
      $("#error_slaboral").text(error_slaboral);
      $("#slaboral").addClass("has-error");
    } else {
      error_slaboral = "";
      $("#error_slaboral").text(error_slaboral);
      $("#slaboral").removeClass("has-error");
    }

    if ($.trim($("#area").val()).length == 0) {
      error_area = "Complete este campo";
      $("#error_area").text(error_area);
      $("#area").addClass("has-error");
    } else {
      error_area = "";
      $("#error_area").text(error_area);
      $("#area").removeClass("has-error");
    }

    if ($.trim($("#modalidad").val()).length == 0) {
      error_modalidad = "Complete este campo";
      $("#error_modalidad").text(error_modalidad);
      $("#modalidad").addClass("has-error");
    } else {
      error_modalidad = "";
      $("#error_modalidad").text(error_modalidad);
      $("#modalidad").removeClass("has-error");
    }

    if ($.trim($("#salariomin").val()).length == 0) {
      error_salariomin = "Complete este campo";
      $("#error_salariomin").text(error_salariomin);
      $("#salariomin").addClass("has-error");
    } else {
      error_salariomin = "";
      $("#error_salariomin").text(error_salariomin);
      $("#salariomin").removeClass("has-error");
    }

    if ($.trim($("#dv").val()).length == 0) {
      error_dv = "Complete este campo";
      $("#error_dv").text(error_dv);
      $("#dv").addClass("has-error");
    } else {
      error_dv = "";
      $("#error_dv").text(error_dv);
      $("#dv").removeClass("has-error");
    }

    if (!$("input[name='dv']:radio").is(":checked")) {
      error_dv = "Complete este campo";
      $("#error_dv").text(error_dv);
      $("#dv").addClass("has-error");
    } else {
      error_dv = "";
      $("#error_dv").text(error_dv);
      $("#dv").removeClass("has-error");
    }

    if (!$("input[name='dcr']:radio").is(":checked")) {
      error_dcr = "Complete este campo";
      $("#error_dcr").text(error_dcr);
      $("#dcr").addClass("has-error");
    } else {
      error_dcr = "";
      $("#error_dcr").text(error_dcr);
      $("#dcr").removeClass("has-error");
    }

    if (
      error_slaboral != "" ||
      error_area != "" ||
      error_modalidad != "" ||
      error_salariomin != "" ||
      error_dv != "" ||
      error_dcr != ""
    ) {
      error4 = " Campos faltantes o invalidos*";
      $("#error4").text(error4);
      $("#error4").addClass("has-error");
      return false;
    } else {
      error4 = "";
      $("#error4").text(error4);
      $("#error4").removeClass("has-error");
    }

    const usuario = $.trim($("#usuario").val());
    const apellido = $.trim($("#apellido").val());
    const dni = $.trim($("#dni").val());
    const email = $.trim($("#email").val());
    const fechanacimiento = $.trim($("#fechanacimiento").val());
    const genero = $(".genero:checked").val();
    const ecivil = $.trim($("#ecivil").val());
    const contacto = $.trim($("#contacto").val());
    const domicilio = $.trim($("#domicilio").val());
    const localidad = $.trim($("#localidad").val());
    const departamento = $.trim($("#departamento").val());
    const provincia = $.trim($("#provincia").val());
    const pais = $.trim($("#pais").val());
    const licencia = $(".licencia:checked").val();
    const auto = $(".auto:checked").val();
    const discapacidades = $.trim($("#discapacidades").val());
    const carh = $.trim($("#carh").val());
    const cursos = $.trim($("#cursos").val());

    var idiomas = [];
    $(":checkbox[name=idiomas]").each(function () {
      if (this.checked) {
        // agregas cada elemento.
        idiomas.push($(this).val());
      }
    });

    const progs = $.trim($("#progs").val());
    const habilidades = $.trim($("#habilidades").val());
    const slaboral = $.trim($("#slaboral").val());
    const area = $.trim($("#area").val());
    const modalidad = $.trim($("#modalidad").val());
    const salariomin = $.trim($("#salariomin").val());
    const dv = $(".dv:checked").val();
    const dcr = $(".dcr:checked").val();

    //----------------------FOTO
    var fd = new FormData();
    var files = $("#foto")[0].files;
    // Check file selected or not
    if (files.length > 0) {
      fd.append("foto", files[0]);
    }

    $.ajax({
      url: "../db/archivos.php",
      type: "POST",
      datatype: "json",
      data: fd,
      contentType: false,
      processData: false,
      success: (data) => {
        console.log(data);
      },
    });
    //----------------------------------PDF
    var fd = new FormData();
    var files = $("#pdf")[0].files;
    // Check file selected or not
    if (files.length > 0) {
      fd.append("pdf", files[0]);
    }

    $.ajax({
      url: "../db/archivos.php",
      type: "POST",
      datatype: "json",
      data: fd,
      contentType: false,
      processData: false,
      success: (data) => {
        console.log(data);
      },
    });

    /*
    $.ajax({
      url: 'upload.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
         if(response != 0){
            $("#img").attr("src",response); 
            $(".preview img").show(); // Display image element
         }else{
            alert('file not uploaded');
         }
      },
   });*/

    $.ajax({
      url: "../db/multi_form_action.php",
      type: "POST",
      datatype: "json",
      data: {
        usuario: usuario,
        apellido: apellido,
        dni: dni,
        email: email,
        fechanacimiento: fechanacimiento,
        genero: genero,
        ecivil: ecivil,
        contacto: contacto,
        domicilio: domicilio,
        localidad: localidad,
        departamento: departamento,
        provincia: provincia,
        pais: pais,
        licencia: licencia,
        auto: auto,
        discapacidades: discapacidades,
        carh: carh,
        cursos: cursos,
        idiomas: idiomas,
        progs: progs,
        habilidades: habilidades,
        slaboral: slaboral,
        area: area,
        modalidad: modalidad,
        salariomin: salariomin,
        dv: dv,
        dcr: dcr,
      },
      success: (data) => {
        if (data === "false") {
          Swal.fire({
            icon: "success",
            title: "¡Guardado correctamente!",
            confirmButtonColor: "#ffa361",
            confirmButtonText: "Entrar",
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Ups! No se pudo guardar correctamente",
          });
        }
      },
    });
    return true;
  });

  $("#licsi").click(function () {
    var v = document.getElementById("auto");
    if (document.getElementById("licsi").checked) {
      v.style.display = "block";
    }
  });
  $("#licno").click(function () {
    var v = document.getElementById("auto");
    v.style.display = "none";
    document.getElementById("vsi").checked = false;
    document.getElementById("vno").checked = false;
    var auto = document.getElementsByName("auto");
    auto.value = 0;
  });
});

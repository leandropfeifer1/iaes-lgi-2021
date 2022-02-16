$(document).ready(function () {
  var form_count = 1,
    previous_form,
    next_form,
    total_forms;
  total_forms = $("fieldset").length;
  $(".next-form").click(function () {
    previous_form = $(this).parent();
    next_form = $(this).parent().next();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(++form_count);
  });
  $(".previous-form").click(function () {
    previous_form = $(this).parent();
    next_form = $(this).parent().prev();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(--form_count);
  });
  setProgressBarValue(form_count);
  function setProgressBarValue(value) {
    var percent = parseFloat(100 / total_forms) * value;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width", percent + "%")
      .html(percent + "%");
  }
  $("#register_form").submit(function (event) {
    event.preventDefault();
    var error = "Por favor, complete los siguientes campos: <br>";
    var error_message = "";
    var error_preferencias = "";
    var b = 0;

    if (!$("#usuario").val()) {
      error_message += "*Nombre";
      b = 1;
    }
    if (!$("#apellido").val()) {
      error_message += "<br>*Apellido";
      b = 1;
    }
    if (!$("#dni").val()) {
      error_message += "<br>*Dni";
      b = 1;
    }
    if (!$("#email").val()) {
      error_message += "<br>*Email";
      b = 1;
    }
    if (!$("#fechanacimiento").val()) {
      error_message += "<br>*Fecha de nacimiento";
      b = 1;
    }
    if (!$("input[name='genero']:radio").is(":checked")) {
      error_message += "<br>*Genero";
      b = 1;
    }    
    if (!$("#contacto").val()) {
      error_message += "<br>*Telefono";
      b = 1;
    }
    if (!$("#domicilio").val()) {
      error_message += "<br>*Domicilio";
      b = 1;
    }
    if (!$("#ecivil").val()) {
      error_message += "<br>*Estado civil";
      b = 1;
    }
    if (!$("#localidad").val()) {
      error_message += "<br>*Localidad";
      b = 1;
    }
    if (!$("#departamento").val()) {
      error_message += "<br>*Departamento";
      b = 1;
    }
    if (!$("#provincia").val()) {
      error_message += "<br>*Provincia";
      b = 1;
    }
    if (!$("#pais").val()) {
      error_message += "<br>*Pais";
      b = 1;
    }
    if (!$("input[name='licencia']:radio").is(":checked")) {
      error_message += "<br>*Licencia de conducir";
      b = 1;
    } else if ($("#licsi").is(":checked")) {
      if (!$("input[name='auto']:radio").is(":checked")) {
        error_message += "<br>*Dispone de vehiculo propio";
        b = 1;
      }
    }
    if (b == 1) {
      error_message = "<br>Datos personales:<br>" + error_message;
      b = 0;
    }

    if (!$("#slaboral").val()) {
      error_preferencias += "<br>*Situacion laboral";
      b = 1;
    }
    if (!$("#modalidad").val()) {
      error_preferencias += "<br>*Modalidad";
      b = 1;
    }
    if (!$("#area").val()) {
      error_preferencias += "<br>*Area";
      b = 1;
    }
    if (!$("#salariomin").val()) {
      error_preferencias += "<br>*Salaro minimo aceptado";
      b = 1;
    }
    if (!$("input[name='dv']:radio").is(":checked")) {
      error_preferencias += "<br>*Disponibilidad para viajar";
      b = 1;
    }
    if (!$("input[name='dcr']:radio").is(":checked")) {
      error_preferencias += "<br>*Disponibilidad para mudarse";
      b = 1;
    }
    if (b == 1) {
      error_preferencias =
        "<br><br>Preferencias laborales:" + error_preferencias;
      b = 0;
    }

    // Display error if any else submit form
    if (error_message || error_preferencias) {
      $(".alert-success")
        .removeClass("hide")
        .html(error + error_message + error_preferencias);
      //return false;
    } else {
      $(".alert-success").addClass("hide");
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
          if (data === 'false'){
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
    }
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

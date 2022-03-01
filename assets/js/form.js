$(document).ready(function () {
  var form_count = 1,
    previous_form,
    next_form,
    total_forms;
  total_forms = $("fieldset").length;
  //---------------------------------------------------------------Botones
  $("#sig1").click(function () {
    val_personales = val_usuario();
    if (val_personales != "") {
      previous_form = $(this).parent();
      next_form = $(this).parent().next();
      next_form.show();
      previous_form.hide();
      setProgressBarValue(++form_count);
    }
  });
  $("#sig2").click(function () {
    academicos = val_academicos();
    if (academicos != "") {
      previous_form = $(this).parent();
      next_form = $(this).parent().next();
      next_form.show();
      previous_form.hide();
      setProgressBarValue(++form_count);
    }
  });
  $("#sig3").click(function () {
    previous_form = $(this).parent();
    next_form = $(this).parent().next();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(++form_count);
  });
  $("#sig4").click(function () {
    habilidades = val_habilidades();
    if (habilidades != "") {
      previous_form = $(this).parent();
      next_form = $(this).parent().next();
      next_form.show();
      previous_form.hide();
      setProgressBarValue(++form_count);
    }
  });
  $(".previous-form").click(function () {
    previous_form = $(this).parent();
    next_form = $(this).parent().prev();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(--form_count);
  });

  function val_usuario() {
    if (
      val_nombre() != "" ||
      val_apellido() != "" ||
      val_dni() != "" ||
      val_fechanacimiento() != "" ||
      val_email() != "" ||
      val_genero() != "" ||
      val_contacto() != "" ||
      val_domicilio() != "" ||
      val_localidad() != "" ||
      val_departamento() != "" ||
      val_provincia() != "" ||
      val_pais() != "" ||
      val_licencia() != "" ||
      val_auto() != ""
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
  }

  function val_academicos() {
    if (val_carrera() != "") {
      error = " Campos faltantes o invalidos*";
      $("#error2").text(error);
      $("#error2").addClass("has-error");
      return false;
    } else {
      console.log("asddddddddd");
      error = "";
      $("#error2").text(error);
      $("#error2").removeClass("has-error");
    }
  }

  function val_habilidades() {
    val_idiomas();

    if (!val_idiomas()) {
      error = " Campos faltantes o invalidos*";
      $("#error3").text(error);
      $("#error3").addClass("has-error");
      return false;
    } else {
      error = "";
      $("#error3").text(error);
      $("#error3").removeClass("has-error");
    }
  }

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
  function val_laborales() {
    val_slaboral();
    val_area();
    val_modalidad();
    val_salariomin();
    val_dv();
    val_dcr();

    if (
      val_slaboral() != "" ||
      val_area() != "" ||
      val_modalidad() != "" ||
      val_salariomin() != "" ||
      val_dv() != "" ||
      val_dcr() != ""
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
  }

  $("#register_form").submit(function (event) {
    event.preventDefault();
    val_laborales();
    if (val_laborales != "") {
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
        success: () => {
          //console.log(data);
        },
      });

      $.ajax({
        url: "../db/archivos.php",
        type: "POST",
        datatype: "json",
        data: fd,
        contentType: false,
        processData: false,
        success: (data) => {
          //console.log(data);
        },
      });

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

  //----------------------------------------------------------------------------------------

  function val_nombre() {
    var letters_validation = /^[a-zA-Z ]+$/;
    if ($.trim($("#usuario").val()).length == 0) {
      error_usuario = "Complete este campo*";
      $("#error_usuario").text(error_usuario);
      $("#usuario").addClass("has-error");
    } else if (!letters_validation.test($("#usuario").val())) {
      error_usuario = "usuario invalido!";
      $("#error_usuario").text(error_usuario);
      $("#usuario").addClass("has-error");
    } else {
      error_usuario = "";
      $("#error_usuario").text(error_usuario);
      $("#usuario").removeClass("has-error");
    }
    return error_usuario;
  }
  function val_apellido() {
    var letters_validation = /^[a-zA-Z ]+$/;
    if ($.trim($("#apellido").val()).length == 0) {
      error_apellido = "Complete este campo*";
      $("#error_apellido").text(error_apellido);
      $("#apellido").addClass("has-error");
    } else if (!letters_validation.test($("#apellido").val())) {
      error_apellido = "apellido invalido!";
      $("#error_apellido").text(error_apellido);
      $("#apellido").addClass("has-error");
    } else {
      error_apellido = "";
      $("#error_apellido").text(error_apellido);
      $("#apellido").removeClass("has-error");
    }
    return error_apellido;
  }
  function val_dni() {
    var dni_validation = /^\d{8}$/;
    if ($.trim($("#dni").val()).length == 0) {
      error_dni = "Complete este campo*";
      $("#error_dni").text(error_dni);
      $("#dni").addClass("has-error");
    } else if (!dni_validation.test($("#dni").val())) {
      error_dni = "Dni invalido!";
      $("#error_dni").text(error_dni);
      $("#dni").addClass("has-error");
    } else {
      error_dni = "";
      $("#error_dni").text(error_dni);
      $("#dni").removeClass("has-error");
    }
    return error_dni;
  }
  function val_email() {
    var email_validation = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    if ($.trim($("#email").val()).length == 0) {
      error_email = "Complete este campo*";
      $("#error_email").text(error_email);
      $("#email").addClass("has-error");
    } else if (!email_validation.test($("#email").val())) {
      error_email = "Email invalido!";
      $("#error_email").text(error_email);
      $("#email").addClass("has-error");
    } else {
      error_email = "";
      $("#error_email").text(error_email);
      $("#email").removeClass("has-error");
    }
    return error_email;
  }
  function val_fechanacimiento() {
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var hoy =
      d.getFullYear() +
      "-" +
      (month < 10 ? "0" : "") +
      month +
      "-" +
      (day < 10 ? "0" : "") +
      day;
    if ($.trim($("#fechanacimiento").val()).length == 0) {
      error_fechanacimiento = "Complete este campo*";
      $("#error_fechanacimiento").text(error_fechanacimiento);
      $("#fechanacimiento").addClass("has-error");
    } else if (
      $("#fechanacimiento").val() <= "1950-01-01" ||
      $("#fechanacimiento").val() > hoy
    ) {
      error_fechanacimiento = "Fecha invalida";
      $("#error_fechanacimiento").text(error_fechanacimiento);
      $("#fechanacimiento").addClass("has-error");
    } else {
      error_fechanacimiento = "";
      $("#error_fechanacimiento").text(error_fechanacimiento);
      $("#fechanacimiento").removeClass("has-error");
    }
    return error_fechanacimiento;
  }
  function val_genero() {
    if (!$("input[name='genero']:radio").is(":checked")) {
      error_genero = "Complete este campo*";
      $("#error_genero").text(error_genero);
      $("#genero").addClass("has-error");
    } else {
      error_genero = "";
      $("#error_genero").text(error_genero);
      $("#genero").removeClass("has-error");
    }
    return error_genero;
  }
  function val_contacto() {
    if ($.trim($("#contacto").val()).length == 0) {
      error_contacto = "Complete este campo*";
      $("#error_contacto").text(error_contacto);
      $("#contacto").addClass("has-error");
    } else {
      error_contacto = "";
      $("#error_contacto").text(error_contacto);
      $("#contacto").removeClass("has-error");
    }
    return error_contacto;
  }
  function val_domicilio() {
    if ($.trim($("#domicilio").val()).length == 0) {
      error_domicilio = "Complete este campo*";
      $("#error_domicilio").text(error_domicilio);
      $("#domicilio").addClass("has-error");
    } else {
      error_domicilio = "";
      $("#error_domicilio").text(error_domicilio);
      $("#domicilio").removeClass("has-error");
    }
    return error_domicilio;
  }
  function val_localidad() {
    if ($.trim($("#localidad").val()).length == 0) {
      error_localidad = "Complete este campo*";
      $("#error_localidad").text(error_localidad);
      $("#localidad").addClass("has-error");
    } else {
      error_localidad = "";
      $("#error_localidad").text(error_localidad);
      $("#localidad").removeClass("has-error");
    }
    return error_localidad;
  }
  function val_departamento() {
    if ($.trim($("#departamento").val()).length == 0) {
      error_departamento = "Complete este campo*";
      $("#error_departamento").text(error_departamento);
      $("#departamento").addClass("has-error");
    } else {
      error_departamento = "";
      $("#error_departamento").text(error_departamento);
      $("#departamento").removeClass("has-error");
    }
    return error_departamento;
  }
  function val_provincia() {
    if ($.trim($("#provincia").val()).length == 0) {
      error_provincia = "Complete este campo*";
      $("#error_provincia").text(error_provincia);
      $("#provincia").addClass("has-error");
    } else {
      error_provincia = "";
      $("#error_provincia").text(error_provincia);
      $("#provincia").removeClass("has-error");
    }
    return error_provincia;
  }
  function val_pais() {
    if ($.trim($("#pais").val()).length == 0) {
      error_pais = "Complete este campo*";
      $("#error_pais").text(error_pais);
      $("#pais").addClass("has-error");
    } else {
      error_pais = "";
      $("#error_pais").text(error_pais);
      $("#pais").removeClass("has-error");
    }
    return error_pais;
  }
  function val_licencia() {
    if (!$("input[name='licencia']:radio").is(":checked")) {
      error_licencia = "Complete este campo*";
      $("#error_licencia").text(error_licencia);
      $("#licencia").addClass("has-error");
    } else {
      error_licencia = "";
      $("#error_licencia").text(error_licencia);
      $("#licencia").removeClass("has-error");
      if (!$("input[name='auto']:radio").is(":checked")) {
        error_auto = "Complete este campo*";
        $("#error_auto").text(error_auto);
        $("#auto").removeClass("has-error");
      } else {
        error_auto = "";
        $("#error_auto").text(error_auto);
        $("#auto").removeClass("has-error");
      }
    }
    return error_licencia;
  }
  function val_auto() {
    var licencia = $("input[name='licencia']:checked").val();
    if (licencia == 2) {
      console.log("si");
      if (!$("input[name='auto']:radio").is(":checked")) {
        error_auto = "Complete este campo*";
        $("#error_auto").text(error_auto);
        $("#auto").removeClass("has-error");
      } else {
        console.log("no");
        error_auto = "";
        $("#error_auto").text(error_auto);
        $("#auto").removeClass("has-error");
      }
    } else {
      error_auto = "";
      $("#error_auto").text(error_auto);
      $("#auto").removeClass("has-error");
    }
    return error_auto;
  }
  function val_carrera() {
    if ($("#carh").val().length == 0) {
      error_carh = "Complete este campo*";
      $("#error_carh").text(error_carh);
      $("#carh").addClass("has-error");
    } else {
      error_carh = "";
      $("#error_carh").text(error_carh);
      $("#carh").removeClass("has-error");
    }
    return error_carh;
  }
  function val_idiomas() {
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
      error_idiomas = "Complete este campo*";
      $("#error_idiomas").text(error_idiomas);
      $("#idiomas").addClass("has-error");
    } else {
      error_idiomas = "";
      $("#error_idiomas").text(error_idiomas);
      $("#idiomas").removeClass("has-error");
    }
    return al_menos_uno;
  }
  function val_slaboral() {
    if ($.trim($("#slaboral").val()).length == 0) {
      console.log("sla");
      error_slaboral = "Complete este campo*";
      $("#error_slaboral").text(error_slaboral);
      $("#slaboral").addClass("has-error");
    } else {
      console.log("slo");
      error_slaboral = "";
      $("#error_slaboral").text(error_slaboral);
      $("#slaboral").removeClass("has-error");
    }
    return error_slaboral;
  }

  function val_area() {
    if ($.trim($("#area").val()).length == 0) {
      error_area = "Complete este campo*";
      $("#error_area").text(error_area);
      $("#area").addClass("has-error");
    } else {
      error_area = "";
      $("#error_area").text(error_area);
      $("#area").removeClass("has-error");
    }
    return error_area;
  }
  function val_modalidad() {
    if ($.trim($("#modalidad").val()).length == 0) {
      error_modalidad = "Complete este campo*";
      $("#error_modalidad").text(error_modalidad);
      $("#modalidad").addClass("has-error");
    } else {
      error_modalidad = "";
      $("#error_modalidad").text(error_modalidad);
      $("#modalidad").removeClass("has-error");
    }
    return error_modalidad;
  }
  function val_salariomin() {
    if ($.trim($("#salariomin").val()).length == 0) {
      error_salariomin = "Complete este campo*";
      $("#error_salariomin").text(error_salariomin);
      $("#salariomin").addClass("has-error");
    } else {
      error_salariomin = "";
      $("#error_salariomin").text(error_salariomin);
      $("#salariomin").removeClass("has-error");
    }
    return error_salariomin;
  }
  function val_dv() {
    if (!$("input[name='dv']:radio").is(":checked")) {
      error_dv = "Complete este campo*";
      $("#error_dv").text(error_dv);
      $("#dv").addClass("has-error");
    } else {
      error_dv = "";
      $("#error_dv").text(error_dv);
      $("#dv").removeClass("has-error");
    }
    return error_dv;
  }
  function val_dcr() {
    if (!$("input[name='dcr']:radio").is(":checked")) {
      error_dcr = "Complete este campo*";
      $("#error_dcr").text(error_dcr);
      $("#dcr").addClass("has-error");
    } else {
      error_dcr = "";
      $("#error_dcr").text(error_dcr);
      $("#dcr").removeClass("has-error");
    }
    return error_dcr;
  }

  $("#usuario").keyup(function () {
    val_nombre();
  });
  $("#apellido").keyup(function () {
    val_apellido();
  });
  $("#dni").keyup(function () {
    val_dni();
  });
  $("#email").keyup(function () {
    val_email();
  });
  $("#fechanacimiento").keyup(function () {
    val_fechanacimiento();
  });
  $(".genero").change(function () {
    val_genero();
  });

  $("#contacto").keyup(function () {
    val_contacto();
  });
  $("#domicilio").keyup(function () {
    val_domicilio();
  });
  $("#localidad").keyup(function () {
    val_localidad();
  });
  $("#localidad").change(function () {
    val_localidad();
  });
  $("#departamento").keyup(function () {
    val_departamento();
  });
  $("#departamento").change(function () {
    val_departamento();
  });
  $("#provincia").keyup(function () {
    val_provincia();
  });
  $("#provincia").change(function () {
    val_provincia();
  });
  $("#pais").keyup(function () {
    val_pais();
  });
  $("#pais").change(function () {
    val_pais();
  });
  $(".licencia").change(function () {
    val_licencia();
  });
  $(".auto").change(function () {
    val_auto();
  });
  $("#carh").change(function () {
    val_carrera();
  });
  $("#idiomas").change(function () {
    val_idiomas();
  });
  $("#slaboral").change(function () {
    val_slaboral();
  });
  $("#slaboral").keyup(function () {
    val_slaboral();
  });
  $("#area").change(function () {
    val_area();
  });
  $("#area").keyup(function () {
    val_area();
  });
  $("#modalidad").change(function () {
    val_modalidad();
  });
  $("#modalidad").keyup(function () {
    val_modalidad();
  });
  $("#salariomin").keyup(function () {
    val_salariomin();
  });
  $(".dv").change(function () {
    val_dv();
  });
  $(".dcr").change(function () {
    val_dcr();
  });
});

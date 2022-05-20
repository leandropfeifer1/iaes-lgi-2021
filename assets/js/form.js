$(document).ready(function () {
  var previous_form, next_form, total_forms; //fieldsets
  var opacity;
  var current = 1;
  var total_forms = $("fieldset").length;

  setProgressBar(current);

  function setProgressBar(curStep) {
    var percent = parseFloat(100 / total_forms) * curStep;
    percent = percent.toFixed();
    $(".progress-bar").css("width", percent + "%");
  }

  $("#register_form").keypress(function (e) {
    if (e.which == 13) {
      e.preventDefault();
    }
  });

  //---------------------------------------------------------------Botones
  $("#sig1").click(function () {
    val_personales = val_usuario();
    if (val_personales != "") {
      current_fs = $(this).parent();
      next_form = $(this).parent().next();

      //Add Class Active
      $("#progressbar li")
        .eq($("fieldset").index(next_form))
        .addClass("active");

      //show the next fieldset
      next_form.show();
      //hide the current fieldset with style
      current_fs.animate(
        { opacity: 0 },
        {
          step: function (now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
              display: "none",
              position: "relative",
            });
            next_form.css({ opacity: opacity });
          },
          duration: 500,
        }
      );
      setProgressBar(++current);
    }
  });

  $("#sig2").click(function () {
    academicos = val_academicos();
    if (academicos != "") {
      current_fs = $(this).parent();
      next_form = $(this).parent().next();

      //Add Class Active
      $("#progressbar li")
        .eq($("fieldset").index(next_form))
        .addClass("active");

      //show the next fieldset
      next_form.show();
      //hide the current fieldset with style
      current_fs.animate(
        { opacity: 0 },
        {
          step: function (now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
              display: "none",
              position: "relative",
            });
            next_form.css({ opacity: opacity });
          },
          duration: 500,
        }
      );
      setProgressBar(++current);
    }
  });
  $("#sig3").click(function () {
    current_fs = $(this).parent();
    next_form = $(this).parent().next();

    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_form)).addClass("active");

    //show the next fieldset
    next_form.show();
    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          next_form.css({ opacity: opacity });
        },
        duration: 500,
      }
    );
    setProgressBar(++current);
  });
  $("#sig4").click(function () {
    habilidades = val_habilidades();
    if (habilidades != "") {
      current_fs = $(this).parent();
      next_form = $(this).parent().next();

      //Add Class Active
      $("#progressbar li")
        .eq($("fieldset").index(next_form))
        .addClass("active");

      //show the next fieldset
      next_form.show();
      //hide the current fieldset with style
      current_fs.animate(
        { opacity: 0 },
        {
          step: function (now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
              display: "none",
              position: "relative",
            });
            next_form.css({ opacity: opacity });
          },
          duration: 500,
        }
      );
      setProgressBar(++current);
    }
  });

  $("#sig5").click(function () {
    laborales = val_laborales();
    if (laborales != "") {
      current_fs = $(this).parent();
      next_form = $(this).parent().next();

      //Add Class Active
      $("#progressbar li")
        .eq($("fieldset").index(next_form))
        .addClass("active");

      //show the next fieldset
      next_form.show();
      //hide the current fieldset with style
      current_fs.animate(
        { opacity: 0 },
        {
          step: function (now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
              display: "none",
              position: "relative",
            });
            next_form.css({ opacity: opacity });
          },
          duration: 500,
        }
      );
      setProgressBar(++current);
    }
  });

  $(".previous").click(function () {
    current_fs = $(this).parent();
    previous_form = $(this).parent().prev();

    //Remove class active
    $("#progressbar li")
      .eq($("fieldset").index(current_fs))
      .removeClass("active");

    //show the previous fieldset
    previous_form.show();

    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          previous_form.css({ opacity: opacity });
        },
        duration: 500,
      }
    );
    setProgressBar(--current);
  });

  function val_usuario() {
    val_nombre();
    val_apellido();
    val_dni();
    val_fechanacimiento();
    val_email();
    val_genero();
    val_ecivil();
    val_contacto();
    val_domicilio();
    val_localidad();
    val_departamento();
    val_provincia();
    val_pais();
    val_licencia();
    val_auto();
    if (
      val_nombre() != "" ||
      val_apellido() != "" ||
      val_dni() != "" ||
      val_fechanacimiento() != "" ||
      val_email() != "" ||
      val_genero() != "" ||
      val_ecivil() != "" ||
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
      return true;
    }
  }

  function val_academicos() {
    if (val_carrera() != "") {
      error = " Campos faltantes o invalidos*";
      $("#error2").text(error);
      return false;
    } else {
      error = "";
      $("#error2").text(error);
      return true;
    }
  }

  function val_habilidades() {
    val_idiomas();

    if (!val_idiomas()) {
      error = " Campos faltantes o invalidos*";
      $("#error3").text(error);
      return false;
    } else {
      error = "";
      $("#error3").text(error);
      return true;
    }
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
      return false;
    } else {
      error4 = "";
      $("#error4").text(error4);
      return true;
    }
  }

  $("#register_form").submit(function (event) {
    event.preventDefault();

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
    const progs = $.trim($("#progs").val());
    const habilidades = $.trim($("#habilidades").val());
    const slaboral = $.trim($("#slaboral").val());
    const area = $.trim($("#area").val());
    const modalidad = $.trim($("#modalidad").val());
    const salariomin = $.trim($("#salariomin").val());
    const dv = $(".dv:checked").val();
    const dcr = $(".dcr:checked").val();

    var idiomas = [];
    $(":checkbox[name=idiomas]").each(function () {
      if (this.checked) {
        // agregas cada elemento.
        idiomas.push($(this).val());
      }
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
          $("#completar").remove();
        } else {
          Swal.fire({
            icon: "error",
            title: "Ups! No se pudo guardar correctamente",
          });
        }
      },
    });
    //----------------------FOTO

    if ($("#foto").val() != "") {

      var fd = new FormData();
      var files = $("#foto")[0].files;
      var fd = files[0];
      var foto = fd["name"];

      cadena =
        "foto=" +
        foto;
      $.ajax({
        type: "POST",
        async: false,
        url: "../db/cadenaAleatoria.php",
        data: cadena,
        success: function (response) {
          //alert(response);
          fotoNombre = response;
        },
      });
      fotoNombre = fotoNombre.replace(/['"]+/g, '');

      // Check file selected or not
      var fotoUsuario = new FormData();
      if (files.length > 0) {
        fotoUsuario.append("foto", files[0]);
        fotoUsuario.append("fotoNombre", fotoNombre);
      }

      $.ajax({
        url: "../db/foto.php",
        type: "POST",
        datatype: "json",
        data: fotoUsuario,
        contentType: false,
        processData: false,
        success: (data) => {
          data = data.replace(/['"]+/g, '');
          //console.log(data);
          $("#fotomostrar").attr("src", "../db/images/" + data);

        },
      });
    }

    //----------------------------------PDF
    if ($("#pdf").val() != "") {
      var cd = new FormData();
      var files = $("#pdf")[0].files;
      var cd = files[0];
      var pdf = cd.name;

      cadena =
        "pdf=" +
        pdf;

      $.ajax({
        type: "POST",
        async: false,
        url: "../db/cadenaAleatoria.php",
        data: cadena,
        success: function (response) {
          //alert(response);
          pdfNombre = response;
        },
      });
      pdfNombre = pdfNombre.replace(/['"]+/g, '');

      // Check file selected or not
      var pdfUsuario = new FormData();
      if (files.length > 0) {
        pdfUsuario.append("pdf", files[0]);
        pdfUsuario.append("pdfNombre", pdfNombre);
      }

      if ($("#pdf").val() != "") {
        $.ajax({
          url: "../db/cv.php",
          type: "POST",
          datatype: "json",
          data: pdfUsuario,
          contentType: false,
          processData: false,
          success: (data) => {
            //console.log(data);
          },
        });
      }
    }

    return true;
  });


  var lic = document.getElementById("licsi").checked;
  if (lic) {
    $(".auto").prop("disabled", false);
  }

  $("#licsi").click(function () {
    var v = document.getElementById("auto");
    if (document.getElementById("licsi").checked) {
      $(".auto").prop("disabled", false);
    }
  });
  $("#licno").click(function () {
    var v = document.getElementById("auto");
    $('input[name="auto"]')[0].checked = false;
    $('input[name="auto"]')[1].checked = false;
    $(".auto").prop("disabled", true);
    auto.value = 0;
  });

  //----------------------------------------------------------------------------------------

  function val_nombre() {
    var letters_validation = /^[a-zA-Z ]+$/;
    if ($.trim($("#usuario").val()).length == 0) {
      error_usuario = "Complete este campo*";
      $("#error_usuario").text(error_usuario);
    } else if (!letters_validation.test($("#usuario").val())) {
      error_usuario = "Usuario invalido!";
      $("#error_usuario").text(error_usuario);
    } else {
      error_usuario = "";
      $("#error_usuario").text(error_usuario);
    }
    return error_usuario;
  }
  function val_apellido() {
    var letters_validation = /^[a-zA-Z ]+$/;
    if ($.trim($("#apellido").val()).length == 0) {
      error_apellido = "Complete este campo*";
      $("#error_apellido").text(error_apellido);
    } else if (!letters_validation.test($("#apellido").val())) {
      error_apellido = "Apellido invalido!";
      $("#error_apellido").text(error_apellido);
    } else {
      error_apellido = "";
      $("#error_apellido").text(error_apellido);
    }
    return error_apellido;
  }
  function val_dni() {
    var dni_validation = /^\d{8}$/;
    var dni = $("#dni").val();
    var letra = dni.charAt(0);
    if ($.trim(dni).length == 0) {
      error_dni = "Complete este campo*";
      $("#error_dni").text(error_dni);
    } else if (!dni_validation.test(dni) || letra == 0) {
      error_dni = "Dni invalido!";
      $("#error_dni").text(error_dni);
    } else {
      error_dni = "";
      $("#error_dni").text(error_dni);
    }
    return error_dni;
  }
  function val_email() {
    var email_validation = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
    if ($.trim($("#email").val()).length == 0) {
      error_email = "Complete este campo*";
      $("#error_email").text(error_email);
    } else if (!email_validation.test($("#email").val())) {
      error_email = "Email invalido!";
      $("#error_email").text(error_email);
    } else {
      error_email = "";
      $("#error_email").text(error_email);
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
    } else if (
      $("#fechanacimiento").val() <= "1950-01-01" ||
      $("#fechanacimiento").val() > hoy
    ) {
      error_fechanacimiento = "Fecha invalida";
      $("#error_fechanacimiento").text(error_fechanacimiento);
    } else {
      error_fechanacimiento = "";
      $("#error_fechanacimiento").text(error_fechanacimiento);
    }
    return error_fechanacimiento;
  }
  function val_genero() {
    if (!$("input[name='genero']:radio").is(":checked")) {
      error_genero = "Complete este campo*";
      $("#error_genero").text(error_genero);
    } else {
      error_genero = "";
      $("#error_genero").text(error_genero);
    }
    return error_genero;
  }
  function val_contacto() {
    if ($.trim($("#contacto").val()).length == 0) {
      error_contacto = "Complete este campo*";
      $("#error_contacto").text(error_contacto);
    } else {
      error_contacto = "";
      $("#error_contacto").text(error_contacto);
    }
    return error_contacto;
  }
  function val_domicilio() {
    if ($.trim($("#domicilio").val()).length == 0) {
      error_domicilio = "Complete este campo*";
      $("#error_domicilio").text(error_domicilio);
    } else {
      error_domicilio = "";
      $("#error_domicilio").text(error_domicilio);
    }
    return error_domicilio;
  }
  function val_localidad() {
    if ($.trim($("#localidad").val()).length == 0) {      
      error_localidad = "Complete este campo*";
      $("#error_localidad").text(error_localidad);
    } else {
      error_localidad = "";
      $("#error_localidad").text(error_localidad);
    }
    return error_localidad;
  }
  function val_departamento() {
    if ($.trim($("#departamento").val()).length == 0) {
      error_departamento = "Complete este campo*";
      $("#error_departamento").text(error_departamento);
    } else {
      error_departamento = "";
      $("#error_departamento").text(error_departamento);
    }
    return error_departamento;
  }
  function val_provincia() {
    if ($.trim($("#provincia").val()).length == 0) {
      error_provincia = "Complete este campo*";
      $("#error_provincia").text(error_provincia);
    } else {
      error_provincia = "";
      $("#error_provincia").text(error_provincia);
    }
    return error_provincia;
  }
  function val_pais() {
    if ($.trim($("#pais").val()).length == 0) {
      error_pais = "Complete este campo*";
      $("#error_pais").text(error_pais);
    } else {
      error_pais = "";
      $("#error_pais").text(error_pais);
    }
    return error_pais;
  }
  function val_ecivil() {
    if ($.trim($("#ecivil").val()).length == 0) {
      error_ecivil = "Complete este campo*";
      $("#error_ecivil").text(error_ecivil);
    } else {
      error_ecivil = "";
      $("#error_ecivil").text(error_ecivil);
    }
    return error_ecivil;
  }
  function val_licencia() {
    if (!$("input[name='licencia']:radio").is(":checked")) {
      error_licencia = "Complete este campo*";
      $("#error_licencia").text(error_licencia);
    } else {
      error_licencia = "";
      $("#error_licencia").text(error_licencia);
    }
    return error_licencia;
  }
  function val_auto() {
    var licencia = $("input[name='licencia']:checked").val();
    if (licencia == 1) {
      if (!$("input[name='auto']:radio").is(":checked")) {
        error_auto = "Complete este campo*";
        $("#error_auto").text(error_auto);
      } else {
        error_auto = "";
        $("#error_auto").text(error_auto);
      }
    } else {
      error_auto = "";
      $("#error_auto").text(error_auto);
    }
    return error_auto;
  }
  function val_carrera() {
    if ($("#carh").val().length == 0) {
      error_carh = "Complete este campo*";
      $("#error_carh").text(error_carh);
    } else {
      error_carh = "";
      $("#error_carh").text(error_carh);
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
    } else {
      error_idiomas = "";
      $("#error_idiomas").text(error_idiomas);
    }
    return al_menos_uno;
  }
  function val_slaboral() {
    if ($.trim($("#slaboral").val()).length == 0) {
      error_slaboral = "Complete este campo*";
      $("#error_slaboral").text(error_slaboral);
    } else {
      error_slaboral = "";
      $("#error_slaboral").text(error_slaboral);
    }
    return error_slaboral;
  }

  function val_area() {
    if ($.trim($("#area").val()).length == 0) {
      error_area = "Complete este campo*";
      $("#error_area").text(error_area);
    } else {
      error_area = "";
      $("#error_area").text(error_area);
    }
    return error_area;
  }
  function val_modalidad() {
    if ($.trim($("#modalidad").val()).length == 0) {
      error_modalidad = "Complete este campo*";
      $("#error_modalidad").text(error_modalidad);
    } else {
      error_modalidad = "";
      $("#error_modalidad").text(error_modalidad);
    }
    return error_modalidad;
  }
  function val_salariomin() {
    if ($.trim($("#salariomin").val()).length == 0) {
      error_salariomin = "Complete este campo*";
      $("#error_salariomin").text(error_salariomin);
    } else {
      error_salariomin = "";
      $("#error_salariomin").text(error_salariomin);
    }
    return error_salariomin;
  }
  function val_dv() {
    if (!$("input[name='dv']:radio").is(":checked")) {
      error_dv = "Complete este campo*";
      $("#error_dv").text(error_dv);
    } else {
      error_dv = "";
      $("#error_dv").text(error_dv);
    }
    return error_dv;
  }
  function val_dcr() {
    if (!$("input[name='dcr']:radio").is(":checked")) {
      error_dcr = "Complete este campo*";
      $("#error_dcr").text(error_dcr);
    } else {
      error_dcr = "";
      $("#error_dcr").text(error_dcr);
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
  $(".genero").keyup(function () {
    val_genero();
  });
  $("#contacto").keyup(function () {
    val_contacto();
  });
  $("#ecivil").change(function () {
    val_ecivil();
  });
  $("#ecivil").keyup(function () {
    val_ecivil();
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
  $(".licencia").keyup(function () {
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

$("#pdf").on("change", function () {
  var ext = $(this).val().split(".").pop();
  if ($(this).val() != "") {
    if (ext == "pdf") {
      if ($(this)[0].files[0].size > 1048576) {
        alert("El documento excede el tamaño máximo! Se solicita un archivo no mayor a 1MB.");
        $(this).val("");
      }
    } else {
      alert("Extensión no permitida: " + ext);
      $(this).val("");
    }
  }
});

$("#foto").on("change", function () {
  var ext = $(this).val().split(".").pop();
  if ($(this).val() != "") {
    if (ext == "png" || ext == "jpeg" || ext == "jpg") {
      if ($(this)[0].files[0].size > 1048576) {
        alert("El documento excede el tamaño máximo! Se solicita un archivo no mayor a 1MB.");
        $(this).val("");
      }
    } else {
      alert("Extensión no permitida: " + ext);
      $(this).val("");
    }
  }
});

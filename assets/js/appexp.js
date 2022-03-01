$(document).ready(function () {
  let edit = false;
  fetchExps();

  //----------------------------------------------------------------------------------------------funcion que se ejecuta al guardar
  $("#form-exp").submit(function (e) {
    e.preventDefault();
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

    if ($.trim($("#empresa").val()).length == 0) {
      error_empresa = "Complete este campo*";
      $("#error_empresa").text(error_empresa);
      $("#empresa").addClass("has-error");
    } else {
      error_empresa = "";
      $("#error_empresa").text(error_empresa);
      $("#empresa").removeClass("has-error");
    }

    if ($.trim($("#puesto").val()).length == 0) {
      error_puesto = "Complete este campo*";
      $("#error_puesto").text(error_puesto);
      $("#puesto").addClass("has-error");
    } else {
      error_puesto = "";
      $("#error_puesto").text(error_puesto);
      $("#puesto").removeClass("has-error");
    }

    if ($.trim($("#desde").val()).length == 0) {
      error_desde = "Complete este campo*";
      $("#error_desde").text(error_desde);
      $("#desde").addClass("has-error");
    } else {
      error_desde = "";
      $("#error_desde").text(error_desde);
      $("#desde").removeClass("has-error");
      if ($.trim($("#desde").val()) <= "1950-01-01") {
        error_desde = "Fecha invalida";
        $("#error_desde").text(error_desde);
        $("#desde").addClass("has-error");
      } else {
        error_desde = "";
        $("#error_desde").text(error_desde);
        $("#desde").removeClass("has-error");
      }
    }

    if ($.trim($("#hasta").val()).length == 0) {
      error_hasta = "Complete este campo*";
      $("#error_hasta").text(error_hasta);
      $("#hasta").addClass("has-error");
    } else {
      error_hasta = "";
      $("#error_hasta").text(error_hasta);
      $("#hasta").removeClass("has-error");
      if (
        $.trim($("#hasta").val()) <= "1950-01-01" ||
        $("#fechanacimiento").val() > hoy
      ) {
        error_hasta = "Fecha invalida";
        $("#error_hasta").text(error_hasta);
        $("#hasta").addClass("has-error");
      } else if($("#desde").val() > $("#hasta").val()){
        error_hasta = "La fecha 'Hasta' no puede ser inferior a la fecha 'Desde'";
        $("#error_hasta").text(error_hasta);
        $("#hasta").addClass("has-error");

      }else{
        error_hasta = "";
        $("#error_hasta").text(error_hasta);
        $("#hasta").removeClass("has-error");
      }
    }

    if ($.trim($("#contacto").val()).length == 0) {
      error_contacto = "Complete este campo*";
      $("#error_contacto").text(error_contacto);
      $("#contacto").addClass("has-error");
    } else {
      error_contacto = "";
      $("#error_contacto").text(error_contacto);
      $("#contacto").removeClass("has-error");
    }

    if (
      error_empresa != "" ||
      error_puesto != "" ||
      error_desde != "" ||
      error_hasta != "" ||
      error_contacto != ""
    ) {
      error = "Campos faltantes o invalidos*";
      $("#error").text(error);
      $("#error").addClass("has-error");
      return false;
    } else {
      error = "";
      $("#error").text(error);
      $("#error").removeClass("has-error");
    }

    const postData = {
      //Toma los valores cargados en los inputs
      iduser: $("#iduser").val(),
      empresa: $("#empresa").val(),
      puesto: $("#puesto").val(),
      desde: $("#desde").val(),
      hasta: $("#hasta").val(),
      contacto: $("#contacto").val(),
      idexp: $("#idexp").val(),
    };

    //comprueba si se esta creando un nuevo reg o actualizando
    const url =
      edit === false
        ? "../db/form_exp/add-exp.php"
        : "../db/form_exp/exp-edit.php";
    console.log(url);

    $.post(url, postData, function (response) {
      // Resetea el formulario despues de presionar el boton guardar
      $("#form-exp").trigger("reset");
      console.log(response);
      fetchExps();
      edit = false;

      //document.getElementById('form-exp').reset();
    });
  });
  //------------------------------------------------------------------------------------------------------Lista los registros
  function fetchExps() {
    $.ajax({
      url: "../db/form_exp/exp-list.php",
      type: "GET",
      success: function (response) {
        //console.log(response);
        const exps = JSON.parse(response);
        let template = "";
        exps.forEach((exps) => {
          template += `
                <tr idexp="${exps.idexp}">                  
                  <td>${exps.empresa}</td>
                  <td>${exps.puesto}</td>
                  <td>${exps.desde}</td>
                  <td>${exps.hasta}</td>
                  <td>${exps.contacto}</td>
                  <td>
                    <button class="exp-delete btn btn-danger">
                      Borrar
                    </button>
                  </td>
                  <td>
                    <button class="exp-item btn btn-secondary">
                      Editar
                    </button>
                  </td>                  
                </tr>                   
                `;
        });
        $("#exps").html(template);
      },
    });
  }
  //---------------------------------------------------------------------------------------------Borrado
  $(document).on("click", ".exp-delete", function () {
    const element = $(this)[0].parentElement.parentElement;
    const id = $(element).attr("idexp");

    $.post("../db/form_exp/exp-delete.php", { id }, function (response) {
      //console.log(response);
      fetchExps();
      $("#form-exp").trigger("reset");
    });
  });
  //-----------------------------------------------------------------------------------------------Editar
  $(document).on("click", ".exp-item", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("idexp");

    $.post("../db/form_exp/exp-single.php", { id }, function (response) {
      const exp = JSON.parse(response);
      $("#empresa").val(exp.empresa);
      $("#puesto").val(exp.puesto);
      $("#desde").val(exp.desde);
      $("#hasta").val(exp.hasta);
      $("#contacto").val(exp.contacto);
      $("#idexp").val(exp.idexp);

      edit = true;
    });
  });


  $("#empresa").keyup(function () {
    if ($.trim($("#empresa").val()).length == 0) {
      error_empresa = "Complete este campo*";
      $("#error_empresa").text(error_empresa);
      $("#empresa").addClass("has-error");
    } else {
      error_empresa = "";
      $("#error_empresa").text(error_empresa);
      $("#empresa").removeClass("has-error");
    }
  });

  $("#puesto").keyup(function () {
    if ($.trim($("#puesto").val()).length == 0) {
      error_puesto = "Complete este campo*";
      $("#error_puesto").text(error_puesto);
      $("#puesto").addClass("has-error");
    } else {
      error_puesto = "";
      $("#error_puesto").text(error_puesto);
      $("#puesto").removeClass("has-error");
    }
  });

  $("#desde").keyup(function () {    
    if ($.trim($("#desde").val()).length == 0) {
      error_desde = "Complete este campo*";
      $("#error_desde").text(error_desde);
      $("#desde").addClass("has-error");
    } else {
      error_desde = "";
      $("#error_desde").text(error_desde);
      $("#desde").removeClass("has-error");
      if ($.trim($("#desde").val()) <= "1950-01-01") {
        error_desde = "Fecha invalida";
        $("#error_desde").text(error_desde);
        $("#desde").addClass("has-error");
      } else {
        error_desde = "";
        $("#error_desde").text(error_desde);
        $("#desde").removeClass("has-error");
      }
    }
  });

  $("#hasta").keyup(function () {
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
    if ($.trim($("#hasta").val()).length == 0) {
      error_hasta = "Complete este campo*";
      $("#error_hasta").text(error_hasta);
      $("#hasta").addClass("has-error");
    } else {
      error_hasta = "";
      $("#error_hasta").text(error_hasta);
      $("#hasta").removeClass("has-error");
      if (
        $.trim($("#hasta").val()) <= "1950-01-01" ||
        $("#fechanacimiento").val() > hoy
      ) {
        error_hasta = "Fecha invalida";
        $("#error_hasta").text(error_hasta);
        $("#hasta").addClass("has-error");
      } else if($("#desde").val() > $("#hasta").val()){
        error_hasta = "La fecha 'Hasta' no puede ser inferior a la fecha 'Desde'";
        $("#error_hasta").text(error_hasta);
        $("#hasta").addClass("has-error");

      }else{
        error_hasta = "";
        $("#error_hasta").text(error_hasta);
        $("#hasta").removeClass("has-error");
      }
    }
  });
  
  $("#contacto").keyup(function () {
    if ($.trim($("#contacto").val()).length == 0) {
      error_contacto = "Complete este campo*";
      $("#error_contacto").text(error_contacto);
      $("#contacto").addClass("has-error");
    } else {
      error_contacto = "";
      $("#error_contacto").text(error_contacto);
      $("#contacto").removeClass("has-error");
    }
  });

});

$(document).ready(function () {
  let edit = false;
  fetchExps();

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

  function val_empresa() {
    if ($.trim($("#empresa").val()).length == 0) {
      error_empresa = "Complete este campo*";
      $("#error_empresa").text(error_empresa);
    } else {
      error_empresa = "";
      $("#error_empresa").text(error_empresa);
    }
    return error_empresa;
  }

  function val_puesto() {
    if ($.trim($("#puesto").val()).length == 0) {
      error_puesto = "Complete este campo*";
      $("#error_puesto").text(error_puesto);
    } else {
      error_puesto = "";
      $("#error_puesto").text(error_puesto);
    }
    return error_puesto;
  }

  function val_desde(hoy) {
    if (($("#desde").val()).length == 0) {
      error_desde = "Complete este campo*";
      $("#error_desde").text(error_desde);
    } else {
      error_desde = "";
      $("#error_desde").text(error_desde);
      if (($("#desde").val()) <= "1950-01-01") {
        error_desde = "Fecha invalida";
        $("#error_desde").text(error_desde);

      } else {
        error_desde = "";
        $("#error_desde").text(error_desde);
      }
    }
    return error_desde;
  }

  function val_hasta(hoy) {
    if (($("#hasta").val()).length == 0) {
      error_hasta = "Complete este campo*";
      $("#error_hasta").text(error_hasta);
    } else {
      error_hasta = "";
      $("#error_hasta").text(error_hasta);
      if (
        ($("#hasta").val()) <= "1950-01-01" ||
        $("#fechanacimiento").val() > hoy
      ) {
        error_hasta = "Fecha invalida";
        $("#error_hasta").text(error_hasta);

      } else if ($("#desde").val() > $("#hasta").val()) {
        error_hasta = "'Hasta' es inferior a 'Desde'";
        $("#error_hasta").text(error_hasta);
      } else {
        error_hasta = "";
        $("#error_hasta").text(error_hasta);
      }
    }
    return error_hasta;
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

  //----------------------------------------------------------------------------------------------funcion que se ejecuta al guardar
  $("#form-exp").submit(function (e) {
    e.preventDefault();
    val_empresa();
    val_puesto();
    val_desde();
    val_hasta();
    val_contacto();
    if (
      val_empresa() != "" ||
      val_puesto() != "" ||
      val_desde() != "" ||
      val_hasta() != "" ||
      val_contacto() != ""
    ) {
      error = "Campos faltantes o invalidos*";
      $("#error").text(error);
      return false;
    } else {
      error = "";
      $("#error").text(error);
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
                    <button class="exp-item btn btn-warning" style="width: 100%;">
                      Editar
                    </button>
                  </td>    
                  <td>
                    <button class="exp-delete btn btn-danger" style="width: 100%;">
                      Borrar
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

  //----------------------------------------------------------------------------------------------------
  $("#empresa").keyup(function () {
    val_empresa();
  });

  $("#puesto").keyup(function () {
    val_puesto();
  });

  $("#desde").keyup(function () {
    val_desde(hoy);
  });

  $("#hasta").keyup(function () {
    val_hasta(hoy);
  });

  $("#contacto").keyup(function () {
    val_contacto();
  });
});

$(document).ready(function () {
  
  let edit = false;
  fetchExps();

  //----------------------------------------------------------------------------------------------funcion que se ejecuta al guardar
  $("#form-exp").submit(function (e) {
    e.preventDefault();
    const postData = {
      //Toma los valores cargados en los inputs
      empresa: $("#empresa").val(),
      puesto: $("#puesto").val(),
      desde: $("#desde").val(),
      hasta: $("#hasta").val(),
      contacto: $("#contacto").val(),
      idexp: $("#idexp").val()
    };

    //comprueba si se esta creando un nuevo reg o actualizando
    const url = edit === false ? 'add-exp.php' : 'exp-edit.php';
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
      url: "exp-list.php",
      type: "GET",
      success: function (response) {
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
  $(document).on('click', '.exp-delete', function() {
    const element = $(this)[0].parentElement.parentElement;
    const id = $(element).attr("idexp");
    $.post('exp-delete.php', {id},function(response){      
      fetchExps();
      $("#form-exp").trigger("reset");
    });

  });
//-----------------------------------------------------------------------------------------------Editar
  $(document).on('click', '.exp-item', function() {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("idexp");

    $.post('exp-single.php', {id}, function(response){
      const exp = JSON.parse(response);
      $('#empresa').val(exp.empresa);
      $('#puesto').val(exp.puesto);
      $('#desde').val(exp.desde);
      $('#hasta').val(exp.hasta);
      $('#contacto').val(exp.contacto);
      $('#idexp').val(exp.idexp);

      edit = true;
    });

  });
});

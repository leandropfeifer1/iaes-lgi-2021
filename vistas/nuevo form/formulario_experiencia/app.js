$(document).ready(function () {
  let edit = false;
  fetchExps();

  $("#form-exp").submit(function (e) {
    const postData = {
      empresa: $("#empresa").val(),
      puesto: $("#puesto").val(),
      desde: $("#desde").val(),
      hasta: $("#hasta").val(),
      contacto: $("#contacto").val(),
      idexp: $("#idexp").val()
    };

    //comprueba si se esta creando un nuevo reg o actualizando
    let url = edit === false ? 'add-exp.php' : 'exp-edit.php';
    console.log(url);

    $.post(url, postData, function (response) {
      fetchExps();

      // Resetea el formulario despues de presionar el boton guardar
      //$("#form-exp").trigger("reset");
      document.getElementById('form-exp').reset();
    });
    e.preventDefault();
  });

  function fetchExps() {
    $.ajax({
      url: "exp-list.php",
      type: "GET",
      success: function (response) {
        let exps = JSON.parse(response);
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

  $(document).on('click', '.exp-delete', function() {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("idexp");
    $.post('exp-delete.php', {id},function(response){      
      fetchExps();
    });

  });

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
    })

  });
});

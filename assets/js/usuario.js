$(document).ready(function () {

  var iduser = $("#idUser").val();
  var pdfExiste = true;
  $.ajax({
    type: "POST",
    async: false,
    url: "../db/consultas.php",
    datatype: 'json',
    data: {
      pdfExiste: pdfExiste,
      iduser: iduser,
    },
    success: function (response) {
      if (response === 'false') {
        $('#cv').removeAttr('href');
      }
    },
  });  

  $("#imprimir").click(function () {
    $("#descargarcv").hide();
    $("#imprimir").hide();
    $("#borrar").hide();
    $("#recuperarPass").hide();
    javascript: window.print();
    $("#descargarcv").show();
    $("#imprimir").show();
    $("#borrar").show();
    $("#recuperarPass").show();
  });

});

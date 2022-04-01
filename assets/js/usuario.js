$(document).ready(function () {
  $("#imprimir").click(function () {
    console.log("asdasd");
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

  
  if ($("#pdf").val() == "") {
    console.log("asdasdasdasdasd");
    $("#cv").bind("click", false);
    $("#error_cv").text("   Vacio*");
  } else {
    console.log("33333");
    $("#cv").unbind("click", false);
    $("#error_cv").text("");
  }
});

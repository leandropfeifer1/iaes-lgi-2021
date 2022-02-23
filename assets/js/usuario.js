$(document).ready(function () {
  $("#imprimir").click(function () {
    console.log("asdasd");
    $("#descargarcv").hide();
    $("#imprimir").hide();
    javascript: window.print();
    $("#descargarcv").show();
    $("#imprimir").show();
  });

  
  if ($("#pdf").val() == "") {
    console.log("asdasdasdasdasd");
    $("#cv").bind("click", false);
    $("#error_cv").text("   Vacio*");
    $("#cv").addClass("has-error");
  } else {
    console.log("33333");
    $("#cv").unbind("click", false);
    $("#error_cv").text("");
    $("#cv").removeClass("has-error");
  }
});

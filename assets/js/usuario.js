



$(document).ready(function () {
  $("#imprimir").click(function () {
    console.log("asdasd");
    $("#cv").hide();
    $("#imprimir").hide();
    javascript: window.print();
    $("#cv").show();
    $("#imprimir").show();
  });
});

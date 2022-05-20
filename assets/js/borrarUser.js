// ACE SE VA A BORRAR LOS USUARIOS DE vistaUsuario.php
$("#eliminarUsuario").click(function () {
    var iduser = $("#idUser").val();
    $.ajax({
        type: "POST",
        async: false,
        url: "../db/eliminarUsuario.php",
        datatype: 'json',
        data: {
            iduser: iduser,
        },
        success: function (response) {
            console.log("uu");
            var ventana = window.self;
            ventana.close();
        },
    });
});
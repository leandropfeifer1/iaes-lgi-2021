// ACE SE VA A BORRAR LOS USUARIOS DE vistaUsuario.php
$("#eliminarUsuario").click(function () {
    var iduser = $("#idUser").val();

    Swal.fire({
        title: "Confirme",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                async: false,
                url: "../db/eliminarUsuario.php",
                datatype: 'json',
                data: {
                    iduser: iduser,
                },
                success: function () {
                    var ventana = window.self;
                    ventana.close();
                },
            });
            
        }
    });


});
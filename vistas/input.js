$(document).ready(function () {
  let id = 206;
  $.post("mostrar_reg.php", { id }, function (response) {
    const datos = JSON.parse(response);
    $("#usuario").val(datos.usuario);
    $("#apellido").val(datos.apellido);
    $("#email").val(datos.correo);
    $("#dni").val(datos.dni);
    $("#fechanacimiento").val(datos.fechanacimiento);

    $("#genero").val(datos.genero);
    if(datos.genero == $("#g1").val()){
        $("input[name=radiobutton][value='hombre']").prop("checked",true);
    }else if(datos.genero == $("#g2").val()){
        $("input[name=radiobutton][value='mujer']").prop("checked",true);
    }else if(datos.genero == $("#g3").val()){
        $("input[name=radiobutton][value='otros']").prop("checked",true);
    }
   
    if(datos.ecivil == $("#e1").val()){
        $("#ecivil option[value='']").attr("selected",true);
    }else if(datos.genero == $("#e2").val()){
        $("#ecivil option[value='Soltero']").attr("selected",true);
    }else if(datos.genero == $("#e3").val()){
        $("#ecivil option[value='Casado']").attr("selected",true);
    }

    $("#contacto").val(datos.contacto);
    $("#localidad").val(datos.localidad);
    $("#departamento").val(datos.departamento);
    $("#provincia").val(datos.provincia);
    $("#idpais").val(datos.idpais);
    $("#codpostal").val(datos.codpostal);
    $("#domicilio").val(datos.domicilio);
    $("#licencia").val(datos.licencia);
    $("#auto").val(datos.auto);
    $("#discapacidades").val(datos.discapacidades);
    $("#foto").val(datos.foto);
    $("#pdf").val(datos.pdf);
    $("#cursos").val(datos.cursos);
    $("#niveledu").val(datos.niveledu);
    $("#progs").val(datos.progs);
    $("#situacionlab").val(datos.situacionlab);
    $("#puestodeseado").val(datos.puestodeseado);
    $("#area").val(datos.area);
    $("#salariomin").val(datos.salariomin);
    $("#dispoviajar").val(datos.dispoviajar);
    $("#dispomuda").val(datos.dispomuda);

    //$('#puesto').val(exp.puesto);

    edit = true;
  });
});

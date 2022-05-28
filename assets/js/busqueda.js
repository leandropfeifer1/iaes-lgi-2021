$(".div-datos").append(
        `<div class="errorMessage">No se encontraron Resultados</div>`
        );
$("#empresa").change(() => sendRequest());
$("#sucursal").change(() => sendRequest());
$("#carrera").change(() => sendRequest());
$("#edadmin").keyup(() => sendRequest());
$("#edadmax").keyup(() => sendRequest());
$("#genero").change(() => sendRequest());
$("#sueldomin").keyup(() => sendRequest());
$("#sueldomax").keyup(() => sendRequest());
$("#disponibilidad").change(() => sendRequest());
$("#buscador").keyup(() => sendRequest());
getData();
$("#reset").click(() => {
    $("#empresa").val("");
    $("#sucursal").val("");
    $("#carrera").val("");
    $("#edadMin").val("");
    $("#edadMax").val("");
    $("#genero").val("");
    $("#sueldo").val("");
    $("#disponibilidad").val("");
    $("#buscador").val("");
    sendRequest();
});
function getData() {
    $(".div-datos").empty();
    const empresa = parseInt($("#empresa").val());
    const sucursal = parseInt($("#sucursal").val());
    const carrera = parseInt($("#carrera").val());
    const sueldo = parseInt($("#sueldo").val());
    let edadmin = $("#edadmin").val();
    let edadmax = $("#edadmax").val();// Es "" si no se pone nada
    const genero = parseInt($("#genero").val());
    const disponibilidad = parseInt($("#disponibilidad").val());
    let buscador = $("#buscador").val(); // Es "" si no se pone nada

    $.ajax({
        url: "../db/busf2.php",
        type: "POST",
        datatype: "json",
        data: {
            empresa: empresa,
            sucursal: sucursal,
            carrera: carrera,
            edadmin: edadmin,
            edadmax: edadmax,
            sueldo: sueldo,
            genero: genero,
            disponibilidad: disponibilidad,
            buscador: buscador,
        },
        success: (data) => {
            $(".div-datos").empty();
            let disponibilidad = "";
            let classAvailable = "";
            let gender = "";
            let tipoModalidad = "";
            const busqueda = JSON.parse(data)
            if (busqueda) {
                busqueda.forEach((user) => {
                    if (user.situacionlab && user.situacionlab === "1") {
                        disponibilidad = "Disponible";
                        classAvailable = "tag-purple";
                    } else {
                        disponibilidad = "No Disponible";
                        classNoAvailable = "tag-red";
                    }
                    if (user.logo) {
                        foto = '../db/images/' + user.logo;
                        console.log(foto);
                    } else {
                        foto = '../assets/logo.jpg';
                        console.log(foto);
                    }
                    if (user.genero === "1") {
                        gender = "Hombre";
                    } else if (user.genero === "2") {
                        gender = "Mujer";
                    } else if (user.genero === "3") {
                        gender = "No Binarix";
                    } else {
                        gender = "Otro";
                    }

                    user.disponibilidad === "1"
                            ? (tipoModalidad = "Full-Time")
                            : tipoModalidad;

                    user.disponibilidad === "2"
                            ? (tipoModalidad = "Part-Time")
                            : tipoModalidad;

                    user.disponibilidad === "3" ? (tipoModalidad = "Trainee") : tipoModalidad;

                    user.disponibilidad === "4"
                            ? (tipoModalidad = "Pasantías")
                            : tipoModalidad;

                    $(".div-datos").append(
                            `<a="_blank" class="card">
                                <div class="card-header">
                                   <img src="${foto}" alt="logo"/>
                                </div>
                                <div class="card-body">
                                    <span class="tag ${classAvailable}">${user.carrera}</span>
                                    <h4 class="nombreCompleto">
                                      ${user.empresa}  ${user.idsucursal} <small>(Sueldo: ${user.sueldo})</small>
                                    </h4>
                                    <p class="modalidadParrafo">
                                      Entre ${user.edadmin} y ${user.edadmax} años
                                    </p>
                                    <div class="user">
                                      <div class="user-info">
                                        <p>Genero: ${gender}</p>
                                        <p>Requisitos: ${user.requisitos} </p>
                                      </div>
                                    </div>
                                    <div class="user-info">
                                      <p>Disponibilidad: ${tipoModalidad}</p><button class="btn" onclick="confimaciondel(${user.idbusqueda})">Eliminar</button><p></>
                                    </div>
                                </div>
                            </a>`
                            );
                    classAvailable = "";
                });
            } else {
                $(".div-datos").empty();
                $(".div-datos").append(`
          <div class="errorMessage">No se encontraron Resultados</div>
        `);
            }
        },
        error: (err) => {
            console.log("err");
        },
    });
}
// Funcion para enviar Datos
const sendRequest = () => {
    $(".div-datos").empty();
    const empresa = parseInt($("#empresa").val());
    const sucursal = parseInt($("#sucursal").val());
    const carrera = parseInt($("#carrera").val());
    const sueldomin = parseInt($("#sueldomin").val());
    const sueldomax = parseInt($("#sueldomax").val());
    let edadmin = $("#edadmin").val();
    let edadmax = $("#edadmax").val();
    const genero = parseInt($("#genero").val());
    const disponibilidad = parseInt($("#disponibilidad").val());

    let buscador = $("#buscador").val(); // Es "" si no se pone nada

    $.ajax({
        url: "../db/busf2.php",
        type: "POST",
        datatype: "json",
        data: {
            empresa: empresa,
            sucursal: sucursal,
            carrera: carrera,
            sueldomin: sueldomin,
            sueldomax: sueldomax,
            edadmin: edadmin,
            edadmax: edadmax,
            genero: genero,
            disponibilidad: disponibilidad,
            buscador: buscador,
        },
        success: (data) => {
            $(".div-datos").empty();
            let disponibilidad = "";
            let classAvailable = "";
            let gender = "";
            let tipoModalidad = "";
            const busqueda = JSON.parse(data)
            if (busqueda) {
                busqueda.forEach((user) => {
                    if (user.situacionlab && user.situacionlab === "1") {
                        disponibilidad = "Disponible";
                        classAvailable = "tag-purple";
                    } else {
                        disponibilidad = "No Disponible";
                        classNoAvailable = "tag-red";
                    }
                    if (user.logo) {
                        foto = '../db/images/' + user.logo;
                        console.log(foto);
                    } else {
                        foto = '../assets/logo.jpg';
                        console.log(foto);
                    }
                    if (user.genero === "1") {
                        gender = "Hombre";
                    } else if (user.genero === "2") {
                        gender = "Mujer";
                    } else if (user.genero === "3") {
                        gender = "No Binarix";
                    } else {
                        gender = "Otro";
                    }
                    if (user.situacionlab && user.situacionlab === "1") {
                        disponibilidad = "Disponible";
                        classAvailable = "tag-purple";
                    } else {
                        disponibilidad = "No Disponible";
                        classNoAvailable = "tag-red";
                    }
                    user.disponibilidad === "1"
                            ? (tipoModalidad = "Full-Time")
                            : tipoModalidad;

                    user.disponibilidad === "2"
                            ? (tipoModalidad = "Part-Time")
                            : tipoModalidad;

                    user.disponibilidad === "3" ? (tipoModalidad = "Trainee") : tipoModalidad;

                    user.disponibilidad === "4"
                            ? (tipoModalidad = "Pasantías")
                            : tipoModalidad;

                    $(".div-datos").append(
                            `<a="_blank" class="card">
                                <div class="card-header">
                                   <img src="${foto}" alt="logo"/>
                                </div>
                                <div class="card-body">
                                    <span class="tag ${classAvailable}">${user.carrera}</span>
                                    <h4 class="nombreCompleto">
                                      ${user.empresa}  ${user.idsucursal} <small>(Sueldo: ${user.sueldo})</small>
                                    </h4>
                                    <p class="modalidadParrafo">
                                      Entre ${user.edadmin} y ${user.edadmax} años
                                    </p>
                                    <div class="user">
                                      <div class="user-info">
                                        <p>Genero: ${gender}</p>
                                        <p>Requisitos: ${user.requisitos} </p>
                                      </div>
                                    </div>
                                    <div class="user-info">
                                      <p>Disponibilidad: ${tipoModalidad}</p><button class="btn" onclick="confimaciondel(${user.idbusqueda})">Eliminar</button><p></>
                                    </div>
                                </div>
                            </a>`
                            );
                    classAvailable = "";
                });
            } else {
                $(".div-datos").empty();
                $(".div-datos").append(`
          <div class="errorMessage">No se encontraron Resultados</div>
        `);
            }
        },
        error: (err) => {
            console.log("err");
        },
    });
};

// Retorna el genero con la primera letra en Mayuscula
const capitalizarPrimeraLetra = (str) => {
    return str.charAt(0).toUpperCase() + str.slice(1);
};
$(document).ready(function () {
    let $empresa = document.querySelector('#empresa')
    let $carrera = document.querySelector('#carrera')
    let $sucursal = document.querySelector('#sucursal')
    cargaremp()
    cargacar()
    cargaremp()

    $("#reset").click(() => {
        cargaremp()
        sucursales()
        cargacar()
        $("#edadMin").val("");
        $("#edadMax").val("");
        $("#modalidad").val("");
        $("#genero").val("");
        $("#sueldo").val("");
        $("#disponible").val("");
        $("#buscador").val("");
        sendRequest();
    });

    function cargaremp() {
        $.ajax({
            url: "../db/emprebus.php",
            type: "GET",
            success: function (res) {
                const empresas = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                empresas.forEach(empresa => {
                    template += `<option value="${empresa.idempresa}">${empresa.empresa}</option>`
                })
                $empresa.innerHTML = template;
            }
        });
    }
    function sucursales() {
        $.ajax({
            url: "../db/sucbus.php",
            type: "GET",
            success: function (res) {
                const sucursales = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                sucursales.forEach(sucursal => {
                    template += `<option value="${sucursal.idsucursal}">${sucursal.direccion}</option>`
                })
                $sucursal.innerHTML = template;
            }
        });
    }
    function cargarsuc(senemp) {
        $.ajax({
            url: "../db/sucbus.php",
            type: "POST",
            data: senemp,
            success: function (res) {
                const sucursales = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                sucursales.forEach(sucursal => {
                    template += `<option value="${sucursal.idsucursal}">${sucursal.direccion}</option>`
                })
                $sucursal.innerHTML = template;
            }
        });
    }
    function cargacar() {
        $.ajax({
            url: "../db/carbus.php",
            type: "GET",
            success: function (res) {
                const carreras = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                carreras.forEach(carrera => {
                    template += `<option value="${carrera.idcar}">${carrera.carrera}</option>`
                })
                $carrera.innerHTML = template;
            }
        });
    }
    $empresa.addEventListener('change', function () {
        const codpais = $empresa.value
        const senemp = {
            'cemp': codpais
        }
        cargarsuc(senemp)
    })
})

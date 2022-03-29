function modificarloc() {
    idloc = $('#idloc').val();
    localidade = $('#localidade').val();
    if (localidade === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Falta Completar campo "Localidad"',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
        });
    } else {
        cadena = "idloc=" + idloc + "&localidade=" + localidade;
        $.ajax({
            type: "POST",
            url: "../db/localidadmod.php",
            data: cadena,
            success: function (r) {
                if (r === "1") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Modificacion Exitosa',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                } else {
                    Swal.fire({
                        icon: 'danger',
                        title: 'Fallo la Modificacion',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                }
            }
        });
    }
}
function modificarpro() {
    idpro = $('#idpro').val();
    provinciae = $('#provinciae').val();
    if (provinciae === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Falta Completar campo "Localidad"',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
        });
    } else {
        cadena = "idpro=" + idpro + "&provinciae=" + provinciae;
        $.ajax({
            type: "POST",
            url: "../db/promod.php",
            data: cadena,
            success: function (r) {
                if (r === "1") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Modificacion Exitosa',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                } else {
                    Swal.fire({
                        icon: 'danger',
                        title: 'Fallo la Modificacion',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                }
            }
        });
    }
}
function modificardep() {
    idep = $('#idep').val();
    departamentoe = $('#departamentoe').val();
    if (departamentoe === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Falta Completar campo "Localidad"',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
        });
    } else {
        cadena = "idep=" + idep + "&departamentoe=" + departamentoe;
        $.ajax({
            type: "POST",
            url: "../db/depmod.php",
            data: cadena,
            success: function (r) {
                if (r === "1") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Modificacion Exitosa',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                } else {
                    Swal.fire({
                        icon: 'danger',
                        title: 'Fallo la Modificacion',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                }
            }
        });
    }
}
function modificarpais() {
    idpais = $('#idpais').val();
    paise = $('#paise').val();
    if (paise === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Falta Completar campo "Localidad"',
            confirmButtonColor: '#ffa361',
            confirmButtonText: 'Ok',
        });
    } else {
        cadena = "idpais=" + idpais + "&paise=" + paise;
        $.ajax({
            type: "POST",
            url: "../db/paismod.php",
            data: cadena,
            success: function (r) {
                if (r === "1") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Modificacion Exitosa',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                } else {
                    Swal.fire({
                        icon: 'danger',
                        title: 'Fallo la Modificacion',
                        confirmButtonColor: '#ffa361',
                        confirmButtonText: 'Ok',
                    });
                }
            }
        });
    }
}
$(document).ready(function () {
    let $pais = document.querySelector('#pais')
    let $provincia = document.querySelector('#provincia')
    let $departamento = document.querySelector('#departamento')
    let $localidad = document.querySelector('#localidad')
    cargarpro()
    cargardep()
    cargarpais()
    cargarloc()
    function cargarpais() {
        $.ajax({
            url: "../db/paisbus.php",
            type: "GET",
            success: function (res) {
                const paises = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                paises.forEach(pais => {
                    template += `<option value="${pais.idpais}">${pais.pais}</option>`
                })
                $pais.innerHTML = template;
            }
        });
    }
    function cargarpro() {
        $.ajax({
            url: "../db/probus.php",
            type: "GET",
            success: function (res) {

                const provincias = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                provincias.forEach(provincia => {
                    template += `<option value="${provincia.idpro}">${provincia.provincia}</option>`
                })
                $provincia.innerHTML = template;
            }
        });
    }
    function cargarprovi(sendpa) {
        $.ajax({
            url: "../db/probus.php",
            type: "POST",
            data: sendpa,
            success: function (res) {

                const provincias = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                provincias.forEach(provincia => {
                    template += `<option value="${provincia.idpro}">${provincia.provincia}</option>`
                })
                $provincia.innerHTML = template;
            }
        });
    }
    function cargardep() {
        $.ajax({
            url: "../db/depbus.php",
            type: "GET",
            success: function (res) {

                const deparmentos = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                deparmentos.forEach(departamento => {
                    template += `<option value="${departamento.idep}">${departamento.departamento}</option>`
                })
                $departamento.innerHTML = template;
            }
        });
    }
    function cargarloc() {
        $.ajax({
            url: "../db/busdb.php",
            type: "GET",
            success: function (res) {

                const localidades = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                localidades.forEach(localidad => {
                    template += `<option value="${localidad.idloc}">${localidad.localidad}</option>`
                })
                $localidad.innerHTML = template;
            }
        });
    }
    function cargarlocalidades(senddep) {
        $.ajax({
            url: "../db/busdb.php",
            type: "POST",
            data: senddep,
            success: function (res) {
                const localidades = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                localidades.forEach(localidad => {
                    template += `<option value="${localidad.idloc}">${localidad.localidad}</option>`
                })
                $localidad.innerHTML = template;
            }
        });
    }
    function cargardep(sendpro) {
        $.ajax({
            url: "../db/depbus.php",
            type: "POST",
            data: sendpro,
            success: function (res) {

                const deparmentos = JSON.parse(res)
                let template = '<option class="from-control" selected disabled>---</option>'
                deparmentos.forEach(departamento => {
                    template += `<option value="${departamento.idep}">${departamento.departamento}</option>`
                })
                $departamento.innerHTML = template;
            }
        });
    }
    $pais.addEventListener('change', function () {
        const codpa = $pais.value
        const sendpa = {
            'cpais': codpa
        }
        cargarprovi(sendpa)
    })
    $departamento.addEventListener('change', function () {
        const codped = $departamento.value
        const senddep = {
            'cdep': codped
        }
        cargarlocalidades(senddep)
    })

    $provincia.addEventListener('change', function () {
        const codpro = $provincia.value
        console.log(codpro)
        cargarloc()
        const sendpro = {
            'cpro': codpro
        }
        cargardep(sendpro)
    })

})

$(document).ready(function () {
    b = 0;
    $("#pais").change(() => sendRequest());
    $("#provincia").change(() => sendRequest());
    $("#departamento").change(() => sendRequest());
    $("#localidad").change(() => sendRequest());
    $("#reset").click(() => {
        $("#pais").val("");
        $("#provincia").val("");
        $("#departamento").val("");
        $("#localidad").val("");
        sendRequest();
    });
    const sendRequest = () => {
        $(".div-datos").empty();
        const pais = parseInt($("#pais").val());
        const provincia = parseInt($("#provincia").val());
        const departamento = parseInt($("#departamento").val());
        const localidad = parseInt($("#localidad").val());
        $.ajax({
            url: "../db/fpa.php",
            type: "POST",
            datatype: "json",
            data: {
                pais: pais,
                provincia: provincia,
                departamento: departamento,
                localidad: localidad
            },
            success: (data) => {
                $(".div-datos").empty();
                const tabla = JSON.parse(data)
                if (tabla) {
                    tabla.forEach((ubi) => {
                        $(".div-datos").append(
                                `<table class="table table-bordered">
                            <tr>
                                <td></td>
                                <td>Pais</td>
                                <td>Provincia</td>
                                <td>Departamento</td>
                                <td>Localidad</td>                    
                            </tr>                        
                            <tr>
                                <td>Nombre</td>
                                <td>${ubi.pais}</td>
                                <td>${ubi.provincia}</td>
                                <td>${ubi.departamento}</td> 
                                <td>${ubi.localidad}</td>
                            </tr>
                            <tr>
                                <td>Opciones</td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modpais" onclick="agregarpais(${ubi.idpais})">Editar</button>
                                </td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modpro" onclick="agregarpro(${ubi.idpro})">Editar</button>
                                </td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#moddep" onclick="agregardep(${ubi.idep})">Editar</button>
                                </td> 
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modloc" onclick="agregarloc(${ubi.idloc})">Editar</button>
                                </td>         
                            </tr>

                        </table>`
                                );
                    })
                }
            },
        });
    }

})

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
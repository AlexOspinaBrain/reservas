/** Se agregan las funciones luego de tener ready el DOM */
document.addEventListener("DOMContentLoaded", function() {

    /**Valida la selección de socio y función */
    document.getElementById('sendForm').addEventListener('click',()=>{
        
        const funcion = document.getElementById('idfuncion').value;
        const socio = document.getElementById('idreserva').value;
        if (!funcion || !socio){
            alert('Debe seleccionar al menos el socio y la función.');
            return;
        }
        
        document.getElementById('reserva').submit();
    }, false);

    /** Busqueda Socio */
    const identificacion = document.getElementById('id-socio');
    identificacion.addEventListener('change',()=>{
        /** Endpoint consultar socio */
        fetch(`/socios/socio/${identificacion.value}`, {
            method: 'GET',
        }).then(res=>res.json())
        .then(res => {
            document.getElementById('nombre').innerText = '';
            document.getElementById('apellido').innerText = '';
            /** Si lo encuentra carga la data para la reserva */
            if (res.socio != null){
                document.getElementById('idreserva').value = res.socio.id;
                document.getElementById('nombre').innerHTML = `<p><b>Nombre:</b> ${res.socio.nombre}</p>`;
                document.getElementById('apellido').innerHTML = `<p><b>Apellido:</b> ${res.socio.apellido}</p>`;
            } else {
                /** Si no genera una alerta */
                identificacion.value = '';
                /**Limpia identificacion socio */
                document.getElementById('idreserva').value = null;
                document.getElementById('nombre').textContent = 'Socio Inexistente';
                /** limpia select de funciones */
                document.getElementById('funciones').value = 'seleccionar';
                document.querySelector('select[name="funciones"] option[value="seleccionar"]').selected = true;
            }
        })
        .catch(error =>  console.error('Error:', error))

    }, false);

    /** Al seleccionar una pelicula o funcion
     * Busca las reservas
     */
    const funciones = document.getElementById('funciones');
    funciones.addEventListener('change',(e)=>{
        
        const identificacion = document.getElementById('id-socio');
        
        /** Primero debería seleccionar un socio existente */
        if (identificacion  == '') {
            e.preventDefault();
            alert('Primero debe buscar el socio');
        } else {
            /** Endpoint Reservas para la funcion seleccionada */
            
            document.getElementById('idfuncion').value = funciones.value;
            fetch(`/funcion-reservas/${funciones.value}`, {
                method: 'GET',
            }).then(res=>res.json())
            .then(res => {
                if (res.reservas !== false){
                    /** Si encuentra sillas reservadas las marca no disponibles */
                    const sillasHtml = document.querySelectorAll('.silla');
                    const sillasReservadas = res.reservas;

                    const sllasMap = sillasReservadas.map(({ silla }) => silla);

                    sillasHtml.forEach((silla)=>{
                        
                        if (sllasMap.find(element => element === silla.id) !== undefined){
                            silla.checked = true;
                            silla.disabled = true;
                        }

                    });
                }


            })
            .catch(error =>  console.error('Error:', error))
        }
    }, false);


    const sillasDisponibles = document.querySelectorAll('.silla');
    const form = document.getElementById('bodyform');
    
    /**Al hacer click en una silla para reservar */
    sillasDisponibles.forEach(silla=>{
        silla.addEventListener('change',(e)=>{
            const identificacion = document.getElementById('id-socio');
            const selectE = document.getElementById('funciones');
            const funcionDisp = selectE.options[selectE.selectedIndex].value;
            /** Debería seleccionar primero socio y funcion o pelicula */
            if (funcionDisp !== 'seleccionar' && identificacion.value !== '') {
                /**Si hace check agrega la silla al formulario para reservar */
                if (e.currentTarget.checked === true){
                    let newField = `<tr id="td-${e.currentTarget.id}"><td>`;
                    newField += `<input type='hidden' name="silla-${e.currentTarget.id}" value='${e.currentTarget.id}' />`;
                    newField += `<div><span style="color:blue;"><b>${e.currentTarget.id.toUpperCase()}</b></span></div>`
                    newField += `</td></tr>`;
                    form.innerHTML += newField;
                } else {
                    /**Si la esta desmarcando la quita del formulario para reservar */
                    document.getElementById(`td-${e.currentTarget.id}`).remove();
                }
            } else {
                alert('Asegurese de seleccionar Socio y Función');
                e.currentTarget.checked = false;
            }
        },false)
    });
}, false);

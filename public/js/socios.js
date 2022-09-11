/**Prepara la info del socio en el form para editar */

function preparaSocioEditar(button){
    const value = button.value;
    const arrayValues = value.split('-');
    document.getElementById('idSocio').value = arrayValues[1];
    document.getElementById('identificacion').value = arrayValues[2];
    document.getElementById('nombre').value = arrayValues[3];
    document.getElementById('apellido').value = arrayValues[4];
}
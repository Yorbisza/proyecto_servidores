function NumerosyPuntos(event) {
    // Permitir números, punto, retroceso, tabulación y teclas de control
    const key = event.key;
    const isNumber = /^[0-9]$/.test(key);
    const isDot = key === '.';
    const isBackspace = event.keyCode === 8; // Retroceso
    const isTab = event.keyCode === 9; // Tabulación

    return isNumber || isDot || isBackspace || isTab;
}

    function validarFormulario(event) {
        const nombreServidor = document.getElementById('nombre_servidores').value.trim();
        const ipServidor = document.getElementById('ip_servidores').value.trim();
        const puerto = document.getElementById('puerto').value.trim();
        const nombreUsuario = document.getElementById('nombre_usuario').value.trim();
        const contrasena = document.getElementById('contrasenas').value.trim();
        const ambiente = document.getElementById('ambiente_id').value.trim();
        const status = document.getElementById('status_id').value.trim();


        let mensajesError = []; // Array para acumular mensajes de error

        if (nombreServidor === '' ) {
            mensajesError.push(" Por favor colocar nombre del servidor.");
        }


        if (ipServidor === '' ) {
            mensajesError.push(" Por favor colocar IP del servidor.");
        } else if (!ipServidor.includes('.')) { // Verifica si contiene un punto
            mensajesError.push(" La IP del servidor debe contener puntos (.)");
        }
        if (puerto === '') {
            mensajesError.push(" Por favor colocar Puerto.");
        }
        if (nombreUsuario === '') {
            mensajesError.push(" Por favor colocar Nombre de Usuario.");
        }
        if (contrasena === '') {
            mensajesError.push(" Por favor colocar Contraseña.");
        }
        if (ambiente === '') {
            mensajesError.push(" Debe Seleccionar un Ambiente.");
        }
        if (status === '') {
            mensajesError.push(" Debe Seleccionar un Status.");
        }


        if (mensajesError.length > 0) {
            event.preventDefault();

            Swal.fire({
                title: "Ups!",
                html: mensajesError.map(msg => `<div>-${msg}</div>`).join(''),

                icon: "error"
            });

            return false;
        }

        return true;
    }


